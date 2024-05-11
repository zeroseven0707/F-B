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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('subdistrict');
            $table->text('address');
            $table->text('url_web')->nullable();
            $table->text('api_key')->unique();
            $table->enum('level',['superadmin','bisnis','hallo-beauty'])->default('bisnis');
            $table->enum('status',['off','on'])->default('on');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
