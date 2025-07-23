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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->index();
            $table->string('symbol', 100)->index()->unique();
            $table->string('alt_symbol', 100)->index()->unique()->nullable();
            $table->string('icon', 255)->nullable();
            $table->string('type', 20)->index()->nullable();
            $table->boolean('status')->default('1');
            $table->boolean('deposit_status')->default(true);
            $table->boolean('withdraw_status')->default(true);
            $table->decimal('deposit_fee')->default(0);
            $table->decimal('withdraw_fee')->default(0);
            $table->decimal('min_deposit')->default(0);
            $table->decimal('max_deposit')->default(0);
            $table->decimal('min_withdraw')->default(0);
            $table->decimal('max_withdraw')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
