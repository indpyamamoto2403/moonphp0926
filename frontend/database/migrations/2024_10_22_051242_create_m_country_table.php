<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('m_country', function (Blueprint $table) {
            // idを自動インクリメントではなく、手動設定できるように変更
            $table->unsignedInteger('id')->primary();
            $table->string('name');
            $table->timestamps();
        });

        // 初期データを挿入
        DB::table('m_country')->insert([
            ['id' => 0, 'name' => '日本'],
            ['id' => 1, 'name' => 'アメリカ'],
            ['id' => 2, 'name' => '中国'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('m_country');
    }
};
