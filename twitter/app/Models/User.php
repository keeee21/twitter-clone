<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users'; //テーブル名

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
}
