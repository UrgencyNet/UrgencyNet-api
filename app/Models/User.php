<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'wallet_address',
        'encrypted_private_key',
        'fcm_token',
        'emergency_contact',
        'blood_type',
        'medical_info',
        'location', // Will store as JSON: {"lat": 0.0, "lng": 0.0}
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'encrypted_private_key',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'location' => 'array',
    ];
}
