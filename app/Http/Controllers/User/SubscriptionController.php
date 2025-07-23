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
use Illuminate\Support\Facades\Http;

class SubscriptionController extends Controller
{
    use ToolsTrait, ImageUpload;

    public function subscriptionIndex()
    {
        $getUserDetails = Auth::guard('user')->user();
        $getUserWallet = Wallet::where('user_id',$getUserDetails->id)->first();

        return view('users.subscription.index', compact('getUserDetails','getUserWallet'));
    }

    
    public function subscriptionGenerateAddress(Request $request){

        // CHECK FOR THE WALLET ADDRESS IN DATABASE
        $getUserDetails = Auth::guard('user')->user();
        $getWallet = Wallet::where([
            'user_id' => $getUserDetails->id,
            'currency_id' => 2, //STATIC FOR NOW
        ])->first();
        if(!$getWallet){
            Wallet::create([
                'user_id' => $getUserDetails->id,
                'currency_id' => 2, //STATIC FOR NOW
                'balance_in_wallet' => 0.00,
                'balance_in_order' => 0.00,
                'balance_in_withdraw' => 0.00,
            ]);
            $getWallet = Wallet::where([
                'user_id' => $getUserDetails->id,
                'currency_id' => 2, //STATIC FOR NOW
            ])->first();
        }
        $checkWalletAddress = WalletAddressHistory::where([   
            'user_id' => $getUserDetails->id,
            'currency_id' => 2,
            'wallet_id' => $getWallet->id,
        ])->first();
        if(empty($checkWalletAddress)){
            try {
                // HIT THE PYTHON API
        
                $data = ['user_id' => (string)$getUserDetails->id];
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->withOptions(['verify' => false])
                ->post('http://16.16.242.205:8000/create_real_deposit_address', $data);

                $getResponse = $response->json();
                // dd($getResponse);
                if(
                    ($getResponse['status'] == true) 
                    || 
                    (
                        ($getResponse['status'] == false) 
                        && 
                        ($getResponse['message'] == "Deposit address already exists for this user.")
                    )
                ){
                    // SAVE THE DATA IN THE DATABSE 
                    WalletAddressHistory::firstOrCreate([
                        'user_id' => $getUserDetails->id,
                        'currency_id' => 2,
                        'wallet_id' => $getWallet->id,
                        'address' => $response['deposit_address'],
                        'wallet_key' => $response['secret'],
                    ]);

                    return response()->json([
                        'success' => true,
                        'address' => $response['deposit_address'],
                        'qr_code' => 'data:image/png;base64,',
                    ]);
                }else{
                    return response()->json([
                        'success' => false,
                        'message' => $getResponse['message'],
                    ], 500);
                }
                
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            }
        }else{

            return response()->json([
                'success' => true,
                'address' => $checkWalletAddress->address,
                'qr_code' => 'data:image/png;base64,',
            ]);

        }
    }

}
