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
        Schema::create('vouchers_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable();
            $table->foreignId('voucher_id');
            $table->foreignId('member_id');
            $table->date('date');
            $table->enum('status',['proses','done']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers_histories');
    }
};
