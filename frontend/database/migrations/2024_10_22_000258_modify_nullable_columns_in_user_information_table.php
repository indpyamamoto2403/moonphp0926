<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
        {
            Schema::table('user_information', function (Blueprint $table) {
                $table->string('name')->nullable()->change();
                $table->string('company_zipcode')->nullable()->change();
                $table->string('company_address')->nullable()->change();
                $table->unsignedTinyInteger('age_kubun')->nullable()->change();
                $table->unsignedTinyInteger('prefecture_kubun')->nullable()->change();
            });
        }
    
        /**
         * Reverse the migrations.
         *
         * @return void
         */
    public function down()
        {
            Schema::table('user_information', function (Blueprint $table) {
                $table->string('name')->nullable(false)->change();
                $table->string('company_zipcode')->nullable(false)->change();
                $table->string('company_address')->nullable(false)->change();
                $table->unsignedTinyInteger('age_kubun')->nullable(false)->change();
                $table->unsignedTinyInteger('prefecture_kubun')->nullable(false)->change();
            });
        }
};
    

