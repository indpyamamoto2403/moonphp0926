<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTKeywordSearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_keyword_search', function (Blueprint $table) {
            $table->id(); // 自動増分のプライマリキー
            $table->string('keyword1', 255); // キーワード1（NOT NULL）
            $table->string('keyword2', 255)->nullable(); // キーワード2（NULL許可）
            $table->string('keyword3', 255)->nullable(); // キーワード3（NULL許可）
            $table->string('combined_keyword', 255); // 結合されたキーワード（NOT NULL）
            $table->unsignedBigInteger('instant_news_id'); // ニュースID（NOT NULL）
            $table->string('instant_news_url', 2048); // ニュースURL（NOT NULL）
            $table->string('instant_news_title', 255); // ニュースタイトル（NOT NULL）
            $table->longText('instant_news_origin'); // ニュース元の内容（NOT NULL）
            $table->text('instant_news_summary'); // ニュースの要約（NOT NULL）
            $table->boolean('is_favorite')->default(false); // お気に入りフラグ
            $table->timestamps(); // created_at, updated_at の自動生成
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_keyword_search');
    }
}
