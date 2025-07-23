<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        Currency::create([
            'id' => 1,
            'name' => 'CARDANO',
            'symbol' => 'CARDANO',	
            'icon' => 'cardanoicon.png',
            'type' => 'coin',
        ]);
    }
}

