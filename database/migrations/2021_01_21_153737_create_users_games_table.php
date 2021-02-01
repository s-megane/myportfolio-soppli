<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('at_bat')->nullable();//打席数
            $table->unsignedBigInteger('hits')->nullable();//ヒット
            $table->unsignedBigInteger('hr')->nullable();//ホームラン数
            $table->unsignedBigInteger('rbi')->nullable();//打点
            $table->unsignedBigInteger('steal')->nullable();//盗塁
            $table->string('winlose')->nullable();//勝敗
            $table->unsignedBigInteger('innings')->nullable();//投球回
            $table->unsignedBigInteger('conceded')->nullable();//失点
            $table->unsignedBigInteger('strikeout')->nullable();//奪三振
            $table->timestamps();
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            // evaluation_idとtarget_idの組み合わせの重複を許さない
            $table->unique(['user_id', 'game_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_games');
    }
}
