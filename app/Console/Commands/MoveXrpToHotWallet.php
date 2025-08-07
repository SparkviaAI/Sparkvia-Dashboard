<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\DepositeTransaction;
use App\Models\AdminWalletKey;
use App\Models\Wallet;
use App\Services\XrpConversionService;

class MoveXrpToHotWallet extends Command
{
    protected $signature = 'xrp:move-to-hotwallet';
    
    protected $description = 'Move XRP tokens to hot wallet';


    public function handle()
    {
        Log::info("XRP deposit processing started at: " . now());

        // Get unprocessed XRP deposits
        $deposits = DepositeTransaction::where([
                'is_admin_receive' => 0,
                'coin_type' => 'XRP',
                'status' => 1, // Successful deposits only
            ])
            ->orderBy('id', 'DESC')
            ->get();

        if ($deposits->isEmpty()) {
            $this->info('No unprocessed XRP deposits found.');
            return 0;
        }

        $conversionService = new XrpConversionService();

        foreach ($deposits as $deposit) {
            try {
                // $this->creditUserWallet($deposit);
                $this->creditUserWallet($deposit, $conversionService);
            } catch (\Exception $e) {
                Log::error("Deposit ID {$deposit->id} failed: " . $e->getMessage());
                continue;
            }
        }

        $this->info('XRP deposit processing completed.');
        return 0;
    }

    // protected function creditUserWallet($deposit)
    protected function creditUserWallet($deposit, XrpConversionService $conversionService)
    {

        \DB::beginTransaction();
        try {

            // 1. Convert XRP to Sparks tokens
            $sparksTokens = $conversionService->convertXrpToSparks($deposit->amount);
            
            Log::info("Converting {$deposit->amount} XRP to {$sparksTokens} Sparks tokens for user {$deposit->user_id}");

            // 2. Update deposit record
            $deposit->update([
                'is_admin_receive' => 1,
                'converted_xrp_tokens' => $sparksTokens, // Store the converted amount
                // 'admin_receive_date' => now(),
            ]);

            // 3. Credit user's xrp wallet (adjust based on your Wallet model)
            $wallet = Wallet::where(
                [
                    'id' => $deposit->receiver_wallet_id,
                ]
            )->first();

            if(!empty($wallet)){
                $wallet->increment('balance_in_wallet', $deposit->amount);
                Log::info("Credited {$deposit->amount} XRP to user {$deposit->user_id} (Deposit ID: {$deposit->id})");
                $this->info("Credited {$deposit->amount} XRP to user {$deposit->user_id}");

                // 4. Credit user's sparks token wallet
                $sparkWallet = Wallet::where(
                    [
                        'currency_id' => 1,
                        'user_id' => $wallet->user_id,
                    ]
                )->first();
                if(!empty($sparkWallet)){
                    $sparkWallet->increment('balance_in_wallet', $sparksTokens);
                    Log::info("Credited {$sparksTokens} Sparks token to user {} (Deposit ID: {$deposit->id})");
                    $this->info("Credited {$sparksTokens} Sparks token to user {$sparkWallet->user_id}");
                }else{
                    Log::error("Sparks Wallet not found");
                }
            }else{
                Log::error("Wallet not found");
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            Log::error($e->getMessage());
            Log::error("Error Crediting {$deposit->amount} XRP to user {$deposit->user_id} (Deposit ID: {$deposit->id})");
            throw $e; // Re-throw to maintain the error in the outer loop
        }
       
    }

    // // Custom API endpoint for moving XRP funds
    // protected $transferApiEndpoint = 'http://16.16.242.205:8000/send_to_admin';

    // public function handle()
    // {
    //     Log::info("Hot wallet process started at: " . date('Y-m-d h:i:s'));

    //     // Get all XRP deposits that haven't been processed by admin
    //     $deposits = DepositeTransaction::where('is_admin_receive', 0)
    //         ->where('coin_type', 'XRP')
    //         ->where('status', 1) // Only successful deposits
    //         ->orderBy('created_at', 'asc') // Process oldest first
    //         ->get();

    //     if ($deposits->isEmpty()) {
    //         $this->info('No unprocessed XRP deposits found.');
    //         Log::info('No unprocessed XRP deposits found.');
    //         return 0;
    //     }

    //     // Get admin wallet address once at the start
    //     $adminAddress = $this->getAdminWalletAddress();
    //     if (!$adminAddress) {
    //         Log::error('No valid admin wallet address found');
    //         return 0;
    //     }

    //     foreach ($deposits as $deposit) {
    //         try {
    //             $this->processXrpTransfer($deposit, $adminAddress);
    //         } catch (\Exception $e) {
    //             Log::error("Error processing deposit ID {$deposit->id}: " . $e->getMessage());
    //             continue;
    //         }
    //     }

    //     $this->info('Hot wallet processing completed.');
    //     return 0;
    // }

    // protected function processXrpTransfer($deposit, $adminAddress)
    // {
    //     Log::info("Processing XRP transfer for deposit ID: {$deposit->id}");

    //     try {
    //         // Call your Python API to move funds
    //         $response = Http::timeout(60)->post($this->transferApiEndpoint, [
    //             'user_id' => (string)$deposit->user_id,
    //             'amount_xrp' => $deposit->amount, // Send the actual amount
    //             // 'from_address' => $deposit->address, // User's wallet address
    //             'admin_address' => $adminAddress, // Admin hot wallet address
    //             // 'transaction_id' => $deposit->transaction_id, // Original transaction ID
    //         ]);

    //         $responseData = $response->json();
    //         Log::info("Response from the Python API: " . json_encode($responseData));

    //         if ($response->successful() && ($responseData['success'] ?? false)) {
    //             // Update the deposit record
    //             $deposit->update([
    //                 'is_admin_receive' => 1,
    //                 'admin_transaction_id' => $responseData['tx_hash'] ?? null,
    //                 'admin_receive_date' => now(),
    //             ]);

    //             Log::info("Successfully moved XRP to hot wallet for deposit ID: {$deposit->id}");
    //             $this->info("Successfully moved XRP to hot wallet for deposit ID: {$deposit->id}");
    //         } else {
    //             $errorMessage = $responseData['message'] ?? 'HTTP status: ' . $response->status();
    //             Log::error("Failed to move XRP for deposit ID: {$deposit->id}. Error: {$errorMessage}");
    //         }
    //     } catch (\Exception $e) {
    //         Log::error("Exception while processing XRP transfer for deposit ID: {$deposit->id}. Error: " . $e->getMessage());
    //         throw $e;
    //     }
    // }

    // protected function getAdminWalletAddress()
    // {
    //     Log::info("Getting admin wallet address");
    //     $getAdminWallet = AdminWalletKey::where(['network_id' => 1, 'status' => 1])->first();
        
    //     if (!empty($getAdminWallet)) {
    //         $adminAddress = $getAdminWallet->address;
    //         Log::info("Successfully retrieved admin wallet address: {$adminAddress}");
    //         return $adminAddress;
    //     }
        
    //     Log::error("Failed to get admin wallet address");
    //     return null;
    // }
}