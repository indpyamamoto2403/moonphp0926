<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {


        // 2. emailの値を全てnullにする
        DB::table('users')->update(['email' => null]);

        // 3. emailカラムを削除
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // カラムを元に戻す（リバース処理）
        Schema::table('users', function (Blueprint $table) {
            // emailカラムを復元（ユニーク制約も再適用）
            $table->string('email')->unique();

        });
    }
};
