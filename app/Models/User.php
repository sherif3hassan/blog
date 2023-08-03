<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject 
 
{
    use Notifiable;
    
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
        
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
