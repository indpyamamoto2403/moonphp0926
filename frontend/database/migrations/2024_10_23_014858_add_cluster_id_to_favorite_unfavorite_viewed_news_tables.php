<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('favorite_news', function (Blueprint $table) {
            $table->unsignedBigInteger('cluster_id')->after('user_id')->nullable();
        });

        Schema::table('unfavorite_news', function (Blueprint $table) {
            $table->unsignedBigInteger('cluster_id')->after('user_id')->nullable();
        });

        Schema::table('viewed_news', function (Blueprint $table) {
            $table->unsignedBigInteger('cluster_id')->after('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('favorite_news', function (Blueprint $table) {
            $table->dropColumn('cluster_id');
        });

        Schema::table('unfavorite_news', function (Blueprint $table) {
            $table->dropColumn('cluster_id');
        });

        Schema::table('viewed_news', function (Blueprint $table) {
            $table->dropColumn('cluster_id');
        });
    }
};
