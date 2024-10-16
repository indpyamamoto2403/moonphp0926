<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // emailのユニークインデックスが存在するか確認
            $table->dropColumn('email');

            // name列を更新可能に
            $table->string('name')->change(); 
            // カラムの追加
            $table->string('name')->change();  // name列を更新可能に
            $table->string('company_name')->nullable();
            $table->string('company_zipcode')->nullable();
            $table->string('company_address')->nullable();
            $table->string('industry_kubun')->nullable();
            $table->string('yakushoku')->nullable();
            $table->string('deapartment')->nullable();
            $table->string('company_url')->nullable();
            $table->text('company_overview')->nullable();
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
            // email列を戻す
            $table->string('email')->nullable()->after('password');

            // 追加したカラムを削除
            $table->dropColumn([
                'company_name', 'company_zipcode', 'company_address', 
                'industry_kubun', 'yakushoku', 'deapartment', 
                'company_url', 'company_overview'
            ]);
        });
    }
}
