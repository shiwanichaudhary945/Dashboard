<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\HasApiTokens;


use Sparrow;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;




    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'number',
        'verify_code',
        'password',
        // 'device_id',
        // 'department',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'number_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function booted()
    {
        static::creating(function ($user) {

            $otp_code = rand(11111, 99999);
            $user->verify_code = $otp_code;

            // Sparrow API HTTP client

            $response = Http::post('https://api.sparrowsms.com/v2/sms', [
                'token' => 'v2_VBVeVE6WkskKT7FiQhCa78tCCJM.3PVy',
                'from' => 'TheAlert',
                'to' => $user->number,
                'text' => 'Your otp verification code is: ' . $otp_code,
            ]);

        });


    }
}
