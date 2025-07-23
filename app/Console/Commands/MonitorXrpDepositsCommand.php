<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\WalletAddressHistory;
use App\Models\DepositeTransaction;

class MonitorXrpDepositsCommand extends Command
{
    protected $signature = 'xrp:monitor-deposits';
    protected $description = 'Monitor XRP deposits for all user wallet addresses';

    // API endpoints to try (in order)
    protected $apiEndpoints = [
        'https://api.xrpscan.com/api/v1/account/{address}/transactions',
        'https://data.xrplmeta.org/account/{address}/transactions',
        'https://xrplcluster.com/api/v1/account/{address}/transactions'
    ];

    public function handle()
    {
        $wallets = WalletAddressHistory::where([
            'currency_id' => 2,
            'coin_type' => 'XRP',
        ])->get();

        if ($wallets->isEmpty()) {
            $this->info('No XRP wallet addresses found.');
            return 0;
        }

        foreach ($wallets as $wallet) {
            $address = $wallet->address;
            $userId = $wallet->user_id;
            $coinId = $wallet->currency_id;

            // Skip if address is empty or invalid
            if (!$this->isValidXrpAddress($address)) {
                Log::error("Invalid XRP address: {$address}");
                continue;
            }

            $transactions = $this->fetchTransactions($address);
            
            if ($transactions === null) {
                Log::error("Failed to fetch transactions for address: {$address}");
                continue;
            }

            if (empty($transactions)) {
                $this->info("No transactions found for address: {$address}");
                continue;
            }

            $this->processTransactions($transactions, $wallet);
        }

        $this->info('XRP deposit check completed successfully.');
        return 0;
    }

    protected function isValidXrpAddress(string $address): bool
    {
        // Basic XRP address validation
        return preg_match('/^r[1-9A-HJ-NP-Za-km-z]{25,34}$/', $address) === 1;
    }

    protected function fetchTransactions(string $address): ?array
    {
        foreach ($this->apiEndpoints as $endpoint) {
            try {
                $url = str_replace('{address}', $address, $endpoint);
                $response = Http::timeout(15)->get($url);

                if ($response->successful()) {
                    $data = $response->json();
                    
                    // Handle different API response formats
                    if (isset($data['transactions'])) {
                        return $data['transactions'];
                    }
                    if (isset($data['result']) && isset($data['result']['transactions'])) {
                        return $data['result']['transactions'];
                    }
                    if (is_array($data)) {
                        return $data; // Some APIs return array directly
                    }
                }

                // Handle specific error responses
                if ($response->status() === 404) {
                    Log::warning("Address not found in ledger: {$address}");
                    return [];
                }
            } catch (\Exception $e) {
                Log::warning("Failed to fetch from {$endpoint}: " . $e->getMessage());
                continue;
            }
        }

        return null;
    }

    protected function processTransactions(array $transactions, WalletAddressHistory $wallet): void
    {
        foreach ($transactions as $tx) {
            try {
                // Skip if not a payment or not successful
                if (!isset($tx['tx']) || $tx['tx']['TransactionType'] !== 'Payment') {
                    continue;
                }
                if (!isset($tx['meta']) || $tx['meta']['TransactionResult'] !== 'tesSUCCESS') {
                    continue;
                }

                $txData = $tx['tx'];
                $destination = strtolower($txData['Destination'] ?? '');
                $address = strtolower($wallet->address);

                // Only consider incoming payments
                if ($destination !== $address) {
                    continue;
                }

                $hash = $txData['hash'];
                $amount = $txData['Amount'] ?? 0;
                
                // Skip if amount is not XRP (token payments)
                if (is_array($amount)) {
                    continue;
                }
                
                $amountXrp = bcdiv($amount, bcpow(10, 6), 6); // Convert drops to XRP

                // Check if transaction already exists
                if (DepositeTransaction::where('transaction_id', $hash)
                    ->where('network_id', 1)
                    ->where('coin_type', 'XRP')
                    ->where('coin_id', 2)
                    ->exists()) {
                    continue;
                }

                // Save deposit
                DepositeTransaction::create([
                    'user_id' => $wallet->user_id,
                    'wallet_id' => $wallet->wallet_id,
                    'coin_id' => $wallet->currency_id,
                    'network_id' => 1,
                    'transaction_id' => $hash,
                    'amount' => $amountXrp,
                    'address' => $wallet->address,
                    'is_admin_receive' => 0,
                    'status' => 1,
                    'confirmations' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->info("New XRP deposit: {$amountXrp} XRP to {$wallet->address} (tx: {$hash})");
                Log::info("XRP deposit recorded: {$amountXrp} XRP to {$wallet->address} (tx: {$hash})");
            } catch (\Exception $e) {
                Log::error("Error processing transaction: " . $e->getMessage());
                continue;
            }
        }
    }
}