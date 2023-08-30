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
    Schema::table('users', function (Blueprint $table) {
        $table->softDeletes(); // deleted_atカラムを追加
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropSoftDeletes(); // deleted_atカラムを削除
    });
}

};
