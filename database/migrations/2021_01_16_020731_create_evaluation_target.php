<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationTarget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_target', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evaluation_id'); //評価する人
            $table->unsignedBigInteger('target_id'); //評価される人
            $table->unsignedBigInteger('meet');
            $table->unsignedBigInteger('power');
            $table->unsignedBigInteger('run');
            $table->unsignedBigInteger('defense');
            $table->unsignedBigInteger('shoulder');
            $table->timestamps();
            // 外部キー制約
            $table->foreign('evaluation_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('target_id')->references('id')->on('users')->onDelete('cascade');
            // evaluation_idとtarget_idの組み合わせの重複を許さない
            $table->unique(['evaluation_id', 'target_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluation_target');
    }
}
