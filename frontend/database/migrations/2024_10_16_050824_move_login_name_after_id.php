<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 'login_name' カラムを 'id' カラムの後ろに移動
            $table->string('login_name')->after('id')->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // 'login_name' カラムを元に戻す（順序が必要ならば調整）
            $table->string('login_name')->change();
        });
    }
};
