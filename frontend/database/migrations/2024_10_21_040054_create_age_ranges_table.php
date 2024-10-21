<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
    
class CreateAgeRangesTable extends Migration
    {

        public function up()
        {
            Schema::create('m_ages', function (Blueprint $table) {
                $table->id(); // プライマリキー
                $table->string('age_range', 10); // 年齢区分
                $table->integer('min_age'); // 最小年齢
                $table->integer('max_age')->nullable(); // 最大年齢（NULLを許可）
                $table->timestamps(); // 作成・更新日時
            });
        }
    
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('m_ages');
        }
};
