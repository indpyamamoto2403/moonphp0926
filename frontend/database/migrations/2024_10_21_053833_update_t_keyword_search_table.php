<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('t_keyword_search', function (Blueprint $table) {
            // instant_news_idを削除
            $table->dropColumn('instant_news_id');
            
            // user_idを追加 (unsignedBigIntegerとしていますが、必要に応じて型を変更してください)
            $table->unsignedBigInteger('user_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_keyword_search', function (Blueprint $table) {
            // user_idを削除
            $table->dropColumn('user_id');

            // instant_news_idを追加 (元のデータ型に応じて型を変更してください)
            $table->unsignedBigInteger('instant_news_id')->nullable()->after('combined_keyword');
        });
    }
};
