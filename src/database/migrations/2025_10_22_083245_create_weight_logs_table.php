<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightLogsTable extends Migration
{

    public function up(): void
    {
        Schema::create('weight_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');                     // 日付
            $table->decimal('weight', 4, 1);           // 体重
            $table->integer('calories')->nullable();  // 摂取カロリー
            $table->time('exercise_time')->nullable(); // 運動時間
            $table->text('exercise_content')->nullable(); // 運動内容
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('weight_logs');
    }
}
