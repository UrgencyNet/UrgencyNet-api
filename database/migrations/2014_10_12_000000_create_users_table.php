<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('wallet_address')->unique();
            $table->text('encrypted_private_key');
            $table->string('fcm_token')->nullable();
            $table->json('location')->nullable(); // For storing lat/lng
            $table->string('emergency_contact')->nullable();
            $table->string('blood_type', 10)->nullable();
            $table->text('medical_info')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
