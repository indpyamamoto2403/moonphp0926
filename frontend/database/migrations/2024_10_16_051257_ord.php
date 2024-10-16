<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 'name' カラムを 'company_name' の前に移動
            $table->string('name')->after('company_name')->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // 必要に応じて元に戻す処理（ここでは順序に関する記述は任意）
            $table->string('name')->change();
        });
    }
};
