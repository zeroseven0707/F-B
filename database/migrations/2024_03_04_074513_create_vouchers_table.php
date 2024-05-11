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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code',40);
            $table->text('image')->nullable();
            $table->enum('type',['public','private']);
            $table->integer('usage_limits');
            $table->integer('qty');
            $table->double('min_spend');
            $table->date('start_date');
            $table->date('exp_date');
            $table->foreignId('web_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
