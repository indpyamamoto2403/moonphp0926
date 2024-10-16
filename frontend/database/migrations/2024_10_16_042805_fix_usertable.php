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
        //ユーザーテーブルがdeapartmentになっているため、departmentに修正
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('deapartment', 'department');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 取消処理
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('department', 'deapartment');
        });
    }
};
