<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // favorite_news テーブルの作成
        Schema::create('favorite_news', function (Blueprint $table) {
            $table->id(); // 自動インクリメントのid
            $table->unsignedBigInteger('user_id'); // usersテーブルの外部キー
            $table->unsignedBigInteger('news_id'); // newsテーブルの外部キー
            $table->timestamps(); // created_at と updated_at

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('news_id')->references('id')->on('m_news')->onDelete('cascade');
        });

        // viewed_news テーブルの作成
        Schema::create('viewed_news', function (Blueprint $table) {
            $table->id(); // 自動インクリメントのid
            $table->unsignedBigInteger('user_id'); // usersテーブルの外部キー
            $table->unsignedBigInteger('news_id'); // newsテーブルの外部キー
            $table->timestamps(); // created_at と updated_at

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('news_id')->references('id')->on('m_news')->onDelete('cascade');
        });

        // unfavorite_news テーブルの作成
        Schema::create('unfavorite_news', function (Blueprint $table) {
            $table->id(); // 自動インクリメントのid
            $table->unsignedBigInteger('user_id'); // usersテーブルの外部キー
            $table->unsignedBigInteger('news_id'); // newsテーブルの外部キー
            $table->timestamps(); // created_at と updated_at

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('news_id')->references('id')->on('m_news')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // テーブルの削除
        Schema::dropIfExists('favorite_news');
        Schema::dropIfExists('viewed_news');
        Schema::dropIfExists('unfavorite_news');
    }
};
