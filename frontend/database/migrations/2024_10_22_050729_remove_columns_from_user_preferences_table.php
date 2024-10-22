<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            $table->dropColumn(['foreign_interest', 'environmental_concern']);
        });
    }
    
    public function down()
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            $table->string('foreign_interest')->nullable();
            $table->string('environmental_concern')->nullable();
        });
    }
};
