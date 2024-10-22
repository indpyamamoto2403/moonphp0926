<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'company_name',
                'name',
                'company_zipcode',
                'company_address',
                'industry_kubun',
                'yakushoku',
                'department',
                'company_url',
                'company_overview',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_name')->nullable();
            $table->string('name')->nullable();
            $table->string('company_zipcode')->nullable();
            $table->string('company_address')->nullable();
            $table->unsignedTinyInteger('industry_kubun')->nullable();
            $table->string('yakushoku')->nullable();
            $table->string('department')->nullable();
            $table->string('company_url')->nullable();
            $table->text('company_overview')->nullable();
        });
    }
};
