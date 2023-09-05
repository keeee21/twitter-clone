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
            $table->string("display_name")->comment('表示名')->nullable(false);
            $table->string("email")->comment('メールアドレス')->nullable(false)->unique();;
            $table->integer('birthday')->comment('誕生日')->nullable(false);;
            $table->string('hash_password')->comment('ハッシュパスワード')->nullable(false);;
            $table->text('profile_image')->comment('プロフィール画像');
            $table->text('header_image')->comment('ヘッダー画像');
            $table->string('user_name')->comment('ユーザー名')->nullable(false)->unique();
            $table->text('bio_text')->comment('自己紹介文');
            $table->timestamps();
            $table->timestamp('last_login_date')->comment('ログイン日時');
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
