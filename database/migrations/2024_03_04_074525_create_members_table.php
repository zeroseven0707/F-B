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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->unique();
            $table->string('name',40);
            $table->string('email',40);
            $table->string('noHp',13);
            $table->text('alamat');
            // $table->text('transactions');
            $table->enum('level',['basic','starter','premium']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
