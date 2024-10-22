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
        Schema::table('m_news', function (Blueprint $table) {
            // summary の後に searched_by_keyword を追加
            $table->boolean('searched_by_keyword')->default(0)->after('summary');
        });
    }

    public function down()
    {
        Schema::table('m_news', function (Blueprint $table) {
            $table->dropColumn('searched_by_keyword');
        });
    }
};
