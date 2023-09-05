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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string("display_name")->nullable(false);
            $table->string("email")->nullable(false)->unique();;
            $table->integer('birthday')->nullable(false);;
            $table->string('hash_password')->nullable(false);;
            $table->text('profile_image');
            $table->text('header_image');
            $table->string('user_name')->nullable(false)->unique();
            $table->text('bio_text');
            $table->timestamps();
            $table->timestamp('last_login_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
};
