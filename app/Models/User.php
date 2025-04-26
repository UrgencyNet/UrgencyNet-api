<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Foundation\Auth\User as Authenticatable;  
use Illuminate\Notifications\Notifiable;  
use Laravel\Sanctum\HasApiTokens;  

/**  
 * App\Models\User  
 *  
 * Represents an authenticated user of the application.  
 *  
 * @property int $id  
 * @property string $name The user's full name  
 * @property string $email The user's email address (unique)  
 * @property string|null $phone The user's phone number  
 * @property string $password The hashed password for authentication  
 * @property string|null $wallet_address User's wallet address (e.g., crypto wallet)  
 * @property string|null $encrypted_private_key Encrypted private key associated with wallet_address  
 * @property string|null $fcm_token Firebase Cloud Messaging token for push notifications  
 * @property string|null $emergency_contact Emergency contact details  
 * @property string|null $blood_type User's blood type (e.g., A+, O-)  
 * @property string|null $medical_info Additional medical information  
 * @property array|null $location User's last known location as an associative array ['lat' => float, 'lng' => float]  
 * @property \Illuminate\Support\Carbon|null $email_verified_at Timestamp when email was verified  
 * @property string|null $remember_token Token used for "remember me" sessions  
 * @property \Illuminate\Support\Carbon|null $created_at Timestamp when user was created  
 * @property \Illuminate\Support\Carbon|null $updated_at Timestamp when user was last updated  
 *  
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()  
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()  
 * @method static \Illuminate\Database\Eloquent\Builder|User query()  
 *  
 * @mixin \Eloquent  
 */  
class User extends Authenticatable  
{  
    use HasApiTokens, HasFactory, Notifiable;  

    /**  
     * The attributes that are mass assignable.  
     *  
     * @var string[]  
     */  
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
        'location', // Stored as JSON: {"lat": 0.0, "lng": 0.0}  
    ];  

    /**  
     * The attributes that should be hidden for arrays and JSON serialization.  
     *  
     * @var string[]  
     */  
    protected $hidden = [  
        'password',  
        'remember_token',  
        'encrypted_private_key',  
    ];  

    /**  
     * The attributes that should be cast to native types.  
     *  
     * @var array<string, string>  
     */  
    protected $casts = [  
        'email_verified_at' => 'datetime',  
        'location' => 'array',  
    ];  
} 