<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }
}

// "token": "1|8onuf05ESIWf8pOIihLKW7UcESQSophhZ9cVzxrv704782ed"
//  "name": "Retmix",
//    "email": "superstart8016@gmail.com",
//    "password": "Sk80160123"

/*{
    "name": "Zabelox",
    "email": "80160123@gmail.com",
    "password": "Ak7878488"
}*/

/*{
    "name": "HardDrive",
    "email": "harddrive@gmail.com",
    "password": "Vv80160123"
}*/

/*"name": "Keanu Reeves",
    "email": "johnwick@gmail.com",
    "password": "donttouchmydog"*/
