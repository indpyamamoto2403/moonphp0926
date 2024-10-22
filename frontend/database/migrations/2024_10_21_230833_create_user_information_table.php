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
        Schema::create('user_information', function (Blueprint $table) {
            $table->id(); // 自動増分のID
            $table->unsignedTinyInteger('user_id'); // ユーザーID
            $table->string('company_name'); // 会社名
            $table->string('name'); // 名前
            $table->string('company_zipcode'); // 郵便番号
            $table->string('company_address'); // 住所
            $table->unsignedTinyInteger('age_kubun'); // 年齢区分 (例: 1, 2, 3など)
            $table->unsignedTinyInteger('prefecture_kubun'); // 都道府県区分 (例: 1, 2, 3など)
            $table->string('department')->nullable(); // 部署 (nullを許可)
            $table->string('company_url')->nullable(); // 会社URL (nullを許可)
            $table->text('company_overview')->nullable(); // 会社概要 (nullを許可)
            $table->timestamps(); // created_at, updated_atのタイムスタンプ
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_information');
    }
};
