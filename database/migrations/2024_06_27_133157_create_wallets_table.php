<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->index()
                  ->name('wallets_user_id_foreign');
            $table->foreignId('currency_id')
                  ->constrained('currencies')
                  ->onDelete('cascade')
                  ->index()
                  ->name('wallets_currency_id_foreign');
            $table->decimal('balance_in_wallet', 15, 2)->default(0);
            $table->decimal('balance_in_order', 15, 2)->default(0);
            $table->decimal('balance_in_withdraw', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
