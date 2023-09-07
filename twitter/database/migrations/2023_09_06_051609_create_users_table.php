<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('ユーザーID');
            $table->string("display_name")->comment('表示名');
            $table->string("email")->comment('メールアドレス')->unique();
            $table->date('birthday')->comment('誕生日');
            $table->string('hash_password')->comment('ハッシュパスワード');
            $table->text('profile_image')->comment('プロフィール画像')->nullable();
            $table->text('header_image')->comment('ヘッダー画像')->nullable();
            $table->string('user_name')->comment('ユーザー名')->unique();
            $table->text('bio_text')->comment('自己紹介文')->nullable();
            $table->timestamps();
            $table->timestamp('last_login_date')->comment('ログイン日時')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};