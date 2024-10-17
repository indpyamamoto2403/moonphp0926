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
        Schema::create('m_cluster', function (Blueprint $table) {
            $table->id(); // int 型の自動インクリメントの id カラム
            $table->string('industry_name'); // string 型の industry_name カラム
            $table->timestamps(); // created_at と updated_at のタイムスタンプ
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_cluster');
    }
};
