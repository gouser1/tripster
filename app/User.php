<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\SocialIdentity;


class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public function identities() {
        return $this->hasMany('App\SocialIdentity');
     }



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // Fillable properties 
    protected $fillable = [
        'name', 'email', 'password', 'bio', 'photo', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
