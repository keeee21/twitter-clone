<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users'; //テーブル名
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'display_name',
        'email',
        'birthday',
        'hash_password',
        'profile_image',
        'header_image',
        'user_name',
        'bio_text',
        'last_login_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'hash_password',
        'remember_token',
    ];
}
