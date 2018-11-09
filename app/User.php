<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [ 'firstname', 'email', 'password', 'lastname', 'middlename', 'address', 'city',
        'state_of_origin', 'lga', 'passport', 'dob', 'gender', 'role_id'
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
