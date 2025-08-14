<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Answer;
use App\Models\Content;
use App\Models\Wallet;
use App\Models\Prompt;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Traits\ToolsTrait;
use App\Traits\ImageUpload;
use App\Models\Files;
use App\Models\WalletAddressHistory;
use App\Models\AdminWalletKey;
use App\Models\DepositeTransaction;
use App\Models\XrpConversionRate;
use Illuminate\Support\Facades\Http;

class SubscriptionController extends Controller
{
    use ToolsTrait, ImageUpload;

    public function subscriptionIndex()
    {
        $getUserDetails = Auth::guard('user')->user();
        $getUserWallet = Wallet::where('user_id',$getUserDetails->id)->first();
        $getUserXRPWallet = Wallet::where(['user_id' => $getUserDetails->id, 'currency_id' => 2])->first();

        if(!empty($getUserXRPWallet)){
            $getDepsoitTransactions = DepositeTransaction::with('receiverWallet')
                                    ->where([
                                        'receiver_wallet_id' => $getUserXRPWallet->id,
                                        'coin_type' => 'XRP'
                                    ])
                                    ->orderBy('id','DESC')
                                    ->get();
        }else{
            $getDepsoitTransactions = [];
            $getUserXRPWallet = [];
        }

        $getConvertData = XrpConversionRate::where('status',1)->orderBy('id','DESC')->first();

        return view('users.subscription.index', compact('getUserDetails','getUserWallet','getUserXRPWallet','getDepsoitTransactions','getConvertData'));
    }

    
    // public function subscriptionGenerateAddress(Request $request){

    //     // CHECK FOR THE WALLET ADDRESS IN DATABASE
    //     $getUserDetails = Auth::guard('user')->user();
    //     $getWallet = Wallet::where([
    //         'user_id' => $getUserDetails->id,
    //         'currency_id' => 2, //STATIC FOR NOW
    //     ])->first();
    //     if(!$getWallet){
    //         Wallet::create([
    //             'user_id' => $getUserDetails->id,
    //             'currency_id' => 2, //STATIC FOR NOW
    //             'balance_in_wallet' => 0.00,
    //             'balance_in_order' => 0.00,
    //             'balance_in_withdraw' => 0.00,
    //         ]);
    //         $getWallet = Wallet::where([
    //             'user_id' => $getUserDetails->id,
    //             'currency_id' => 2, //STATIC FOR NOW
    //         ])->first();
    //     }
    //     $checkWalletAddress = WalletAddressHistory::where([   
    //         'user_id' => $getUserDetails->id,
    //         'currency_id' => 2,
    //         'wallet_id' => $getWallet->id,
    //     ])->first();
    //     if(empty($checkWalletAddress)){
    //         try {
    //             // HIT THE PYTHON API
        
    //             $data = ['user_id' => (string)$getUserDetails->id];
    //             $response = Http::withHeaders([
    //                 'Content-Type' => 'application/json',
    //             ])
    //             ->withOptions(['verify' => false])
    //             ->post('http://16.16.242.205:8000/create_real_deposit_address', $data);

    //             $getResponse = $response->json();
    //             // dd($getResponse);
    //             if(
    //                 ($getResponse['status'] == true) 
    //                 || 
    //                 (
    //                     ($getResponse['status'] == false) 
    //                     && 
    //                     ($getResponse['message'] == "Deposit address already exists for this user.")
    //                 )
    //             ){
    //                 // SAVE THE DATA IN THE DATABSE 
    //                 WalletAddressHistory::firstOrCreate([
    //                     'user_id' => $getUserDetails->id,
    //                     'currency_id' => 2,
    //                     'wallet_id' => $getWallet->id,
    //                     'address' => $response['deposit_address'],
    //                     'wallet_key' => $response['secret'],
    //                 ]);

    //                 return response()->json([
    //                     'success' => true,
    //                     'address' => $response['deposit_address'],
    //                     'qr_code' => 'data:image/png;base64,',
    //                 ]);
    //             }else{
    //                 return response()->json([
    //                     'success' => false,
    //                     'message' => $getResponse['message'],
    //                 ], 500);
    //             }
                
    //         } catch (\Exception $e) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => $e->getMessage()
    //             ], 500);
    //         }
    //     }else{

    //         return response()->json([
    //             'success' => true,
    //             'address' => $checkWalletAddress->address,
    //             'qr_code' => 'data:image/png;base64,',
    //         ]);

    //     }
    // }

    // public function subscriptionGenerateAddress(Request $request)
    // {
    //     // CHECK FOR THE WALLET ADDRESS IN DATABASE
    //     $getUserDetails = Auth::guard('user')->user();
    //     $getAdminWallet = AdminWalletKey::where([
    //         'status' => 1,
    //         'network_id' => 1,
    //     ])->first();
    //     if(!$getAdminWallet){
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Unable to create wallet address at the moment',
    //         ], 500);
    //     }
    //     $adminWalletAddress = $getAdminWallet->address;

    //     // Get or create wallet
    //     $getWallet = Wallet::firstOrCreate(
    //         [
    //             'user_id' => $getUserDetails->id,
    //             'currency_id' => 2, // STATIC FOR XRP
    //         ],
    //         [
    //             'balance_in_wallet' => 0.00,
    //             'balance_in_order' => 0.00,
    //             'balance_in_withdraw' => 0.00,
    //         ]
    //     );

    //     // Generate a unique destination tag (9-digit number)
    //     // $destinationTag = str_pad($getUserDetails->id, 9, '0', STR_PAD_LEFT);

    //     $secret = config('app.key');
    //     $hash = hash_hmac('sha256', $getUserDetails->id, $secret);
    //     $destinationTag = strtoupper(substr($hash, 0, 10)); // 10 hex chars (5 bytes)

    //     // Generate multiple URI formats
    //     // $uriFormats = [
    //     //     'xumm' => "https://xumm.app/detect/network/ripple:{$xrpAddress->value}?dt={$destinationTag}",
    //     //     'xrpl_link' => "https://xrpl.link/?to={$xrpAddress->value}&dt={$destinationTag}",
    //     //     'legacy' => "ripple:{$xrpAddress->value}?dt={$destinationTag}",
    //     // ];

    //     // Check if we already have this address-tag combo for the user
    //     $checkWalletAddress = WalletAddressHistory::where([
    //         'user_id' => $getUserDetails->id,
    //         'currency_id' => 2,
    //         'wallet_id' => $getWallet->id,
    //     ])->first();

    //     if (empty($checkWalletAddress)) {
    //         // Save the address with destination tag
    //         WalletAddressHistory::create([
    //             'user_id' => $getUserDetails->id,
    //             'currency_id' => 2,
    //             'wallet_id' => $getWallet->id,
    //             'address' => $adminWalletAddress,
    //             'wallet_key' => $destinationTag,
    //         ]);
    //     } else {
    //         $destinationTag = $checkWalletAddress->wallet_key;
    //     }
        
    //     // Format the XRP payment URI (for QR code)
    //     // $xrpUri = "ripple:{$adminWalletAddress}?dt={$destinationTag}";
    //     $xrpUri = "xrp:$adminWalletAddress?dt=$destinationTag";

    //     // Change the XRP URI format to:
    //     // $xrpUri = "https://xumm.app/detect/network/ripple:{$adminWalletAddress}?dt={$destinationTag}";
    //     // OR alternatively:
    //     // $xrpUri = "https://xrpl.link/?to={$adminWalletAddress}&dt={$destinationTag}";

    //     // $uriFormats = [
    //     //     'universal' => "https://xrpayments.co/send?to={$adminWalletAddress}&dt={$destinationTag}",
    //     //     'trust' => "https://trustwallet.com/xrp?address={$adminWalletAddress}&tag={$destinationTag}",
    //     //     'xumm' => "https://xumm.app/detect/ripple:{$adminWalletAddress}?dt={$destinationTag}",
    //     //     'raw' => "{$adminWalletAddress}?dt={$destinationTag}"
    //     // ];

       
                
    //     return response()->json([
    //         'success' => true,
    //         'address' => $adminWalletAddress,
    //         'wallet_key' => $destinationTag,
    //         'xrp_uri' => $xrpUri,
    //         'qr_code_data' => $xrpUri, // This will be used to generate QR code
    //         // 'xrp_uri' => $uriFormats['universal'], // Default to universal format
    //         // 'qr_code_data' => $uriFormats['universal'],
    //         // 'alt_uri_formats' => $uriFormats
    //     ]);

    //     // if(empty($checkWalletAddress)){
    //     //     try {
    //     //         // Generate a unique destination tag (9-digit number)
    //     //         $destinationTag = str_pad($getUserDetails->id, 9, '0', STR_PAD_LEFT);
                
    //     //         $data = ['user_id' => (string)$getUserDetails->id];
    //     //         $response = Http::withHeaders([
    //     //             'Content-Type' => 'application/json',
    //     //         ])
    //     //         ->withOptions(['verify' => false])
    //     //         ->post('http://16.16.242.205:8000/create_real_deposit_address', $data);

    //     //         $getResponse = $response->json();
    //     //         // dd($getResponse);
    //     //         if(
    //     //             ($getResponse['status'] == true) 
    //     //             || 
    //     //             (
    //     //                 ($getResponse['status'] == false) 
    //     //                 && 
    //     //                 ($getResponse['message'] == "Deposit address already exists for this user.")
    //     //             )
    //     //         ){
    //     //             // SAVE THE DATA IN THE DATABSE 
    //     //             WalletAddressHistory::firstOrCreate([
    //     //                 'user_id' => $getUserDetails->id,
    //     //                 'currency_id' => 2,
    //     //                 'wallet_id' => $getWallet->id,
    //     //                 'address' => $response['deposit_address'],
    //     //                 'wallet_key' => $response['secret'],
    //     //             ]);

    //     //             return response()->json([
    //     //                 'success' => true,
    //     //                 'address' => $response['deposit_address'],
    //     //                 'qr_code' => 'data:image/png;base64,',
    //     //             ]);
    //     //         }else{
    //     //             return response()->json([
    //     //                 'success' => false,
    //     //                 'message' => $getResponse['message'],
    //     //             ], 500);
    //     //         }
                
    //     //     } catch (\Exception $e) {
    //     //         return response()->json([
    //     //             'success' => false,
    //     //             'message' => $e->getMessage()
    //     //         ], 500);
    //     //     }
    //     // }else{

    //     //     return response()->json([
    //     //         'success' => false,
    //     //         'message' => 'Unable to create wallet address at the moment',
    //     //     ], 500);

    //     // }
    // }


    public function subscriptionGenerateAddress(Request $request)
    {
        // CHECK FOR THE WALLET ADDRESS IN DATABASE
        $getUserDetails = Auth::guard('user')->user();
        $getAdminWallet = AdminWalletKey::where([
            'status' => 1,
            'network_id' => 1,
        ])->first();
        
        if(!$getAdminWallet){
            return response()->json([
                'success' => false,
                'message' => 'Unable to create wallet address at the moment',
            ], 500);
        }
        $adminWalletAddress = $getAdminWallet->address;

        // Get or create wallet
        $getWallet = Wallet::firstOrCreate(
            [
                'user_id' => $getUserDetails->id,
                'currency_id' => 2, // STATIC FOR XRP
            ],
            [
                'balance_in_wallet' => 0.00,
                'balance_in_order' => 0.00,
                'balance_in_withdraw' => 0.00,
            ]
        );

        // Check if we already have an address-tag combo for the user
        $checkWalletAddress = WalletAddressHistory::where([
            'user_id' => $getUserDetails->id,
            'currency_id' => 2,
            'wallet_id' => $getWallet->id,
        ])->first();

        if (empty($checkWalletAddress)) {
            // Generate a unique numeric destination tag that includes user ID
            $timestamp = time(); // Current timestamp for uniqueness
            $randomNumber = mt_rand(1000, 9999); // Additional randomness
            
            // Combine user ID, timestamp, and random number to create a unique numeric tag
            $baseTag = $getUserDetails->id . substr($timestamp, -5) . $randomNumber;
            
            // Ensure the tag is numeric and not too long (XRP destination tags are uint32)
            $destinationTag = (int)substr($baseTag, 0, 9); // Limit to 9 digits
            
            // Make sure it's not zero (invalid for XRP)
            if ($destinationTag == 0) {
                $destinationTag = 100000000 + $getUserDetails->id; // Fallback
            }

            // Save the address with destination tag
            WalletAddressHistory::create([
                'user_id' => $getUserDetails->id,
                'currency_id' => 2,
                'wallet_id' => $getWallet->id,
                'address' => $adminWalletAddress,
                'wallet_key' => $destinationTag,
            ]);
        } else {
            $destinationTag = $checkWalletAddress->wallet_key;
        }
        
        // $xrpUri = "xrp:$adminWalletAddress?dt=$destinationTag";
        // $xrpUri = "xrp:$adminWalletAddress";
        $xrpUri = "$adminWalletAddress";

        return response()->json([
            'success' => true,
            'address' => $adminWalletAddress,
            'wallet_key' => $destinationTag,
            'xrp_uri' => $xrpUri,
            'qr_code_data' => $xrpUri, // This will be used to generate QR code
        ]);
    }

}
