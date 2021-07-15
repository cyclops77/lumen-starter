<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    protected $fillable = [
        'first_name',
        'privileges',
        'last_name',
        'email',
        'username',
        'password',
        'token_auth'
    ];
    protected $hidden = [
        'password','token_auth'
    ];
    public function jadwal()
    {
    	return $this->hasMany('App\Models\Jadwal','user_id');
    }
    public function survey()
    {
        return $this->hasMany('App\Models\Survey','user_id');
    }
    public function getFirstNameAttribute()
    {
        return ucwords($this->attributes['first_name']);
    }
    public function getLastNameAttribute()
    {
        return ucwords($this->attributes['last_name']);
    }
}
