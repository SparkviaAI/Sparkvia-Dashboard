<?php

namespace App\Services;

use App\Models\XrpConversionRate;

class XrpConversionService
{
    public function convertXrpToSparks(float $xrpAmount): int
    {
        $rate = XrpConversionRate::where('status',1)->orderBy('id','DESC')->first();
        
        if (!$rate) {
            throw new \RuntimeException('No active conversion rate found');
        }
        
        // Calculate tokens (round down to nearest integer)
        $tokens = floor(($xrpAmount / $rate->xrp_amount) * $rate->sparks_amount);
        
        return (int) $tokens;
    }
    
    public function deductAiResponseToken(int $currentTokens): int
    {
        return max(0, $currentTokens - 1);
    }
}