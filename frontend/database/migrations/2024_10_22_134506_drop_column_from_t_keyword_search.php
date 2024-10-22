<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('t_keyword_search', function (Blueprint $table) {
            // カラムが存在する場合に削除
            if (Schema::hasColumn('t_keyword_search', 'instant_news_url')) {
                $table->dropColumn('instant_news_url');
            }
            if (Schema::hasColumn('t_keyword_search', 'instant_news_title')) {
                $table->dropColumn('instant_news_title');
            }
            if (Schema::hasColumn('t_keyword_search', 'instant_news_origin')) {
                $table->dropColumn('instant_news_origin');
            }
            if (Schema::hasColumn('t_keyword_search', 'instant_news_summary')) {
                $table->dropColumn('instant_news_summary');
            }
        });
    }

    public function down(): void
    {
        Schema::table('t_keyword_search', function (Blueprint $table) {
            // カラムが存在しなければ追加
            if (!Schema::hasColumn('t_keyword_search', 'instant_news_url')) {
                $table->string('instant_news_url')->nullable();
            }
            if (!Schema::hasColumn('t_keyword_search', 'instant_news_title')) {
                $table->string('instant_news_title')->nullable();
            }
            if (!Schema::hasColumn('t_keyword_search', 'instant_news_origin')) {
                $table->string('instant_news_origin')->nullable();
            }
            if (!Schema::hasColumn('t_keyword_search', 'instant_news_summary')) {
                $table->text('instant_news_summary')->nullable();
            }
        });
    }
};
