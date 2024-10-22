<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_news', function (Blueprint $table) {
            $table->id();
            $table->string('url', 2048);
            $table->string('title', 255)->nullable();
            $table->longText('origin')->nullable();
            $table->text('summary');
            $table->integer('category_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_news');
    }
};
