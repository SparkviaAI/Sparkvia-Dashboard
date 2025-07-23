<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'cardanogpt admin',
            'email' => 'admin@demo.com',
            'username'=>'cardanogpt_admin',
            'remember_token' => Str::random(10),
            'password' => Hash::make('qwer1234'),
            'created_at'=>Carbon::now()
        ]);

        DB::table('wallets')->insert([
            'id'=> 1,
            'user_id' => 1,
            'currency_id'=> 1,
            'created_at'=>Carbon::now()
        ]);
    }
}
