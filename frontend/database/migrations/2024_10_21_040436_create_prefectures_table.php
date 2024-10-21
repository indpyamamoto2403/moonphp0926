<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('m_prefecture', function (Blueprint $table) {
            $table->id(); // プライマリキー
            $table->string('name', 50); // 都道府県名
            $table->string('code', 10)->unique(); // 都道府県コード（例: "01", "02"）
            $table->timestamps(); // 作成・更新日時
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_prefecture');
    }
};
