<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['name','email','password',];

    protected $hidden = ['password','remember_token',];

    protected $casts = ['email_verified_at' => 'datetime', ];

    protected $dates = ['deleted_at'];

    /**
    * ユーザーのプロフィールを更新
    *
    * @param array $data
    */
    public function updateProfile($data)
    {
        // 空の 'email' を削除
        if (empty($data['email'])) {
            unset($data['email']);
        }

        $this->update($data);
    }

    /**
     * ユーザーアカウントを削除
     *
     */
    public function removeAccount()
    {
        $this->delete();
    }
}
