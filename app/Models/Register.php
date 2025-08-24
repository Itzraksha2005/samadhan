<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Register extends Authenticatable implements JWTSubject
{
    protected $table='register';
    
    public $fillable=[
        'avatar',
        'name',
        'phone',
        'email',
        'location',
        'password',
        'approval_status',
        'admin_message',
        
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
