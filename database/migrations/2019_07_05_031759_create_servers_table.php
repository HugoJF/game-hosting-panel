<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');

            $table->unsignedInteger('game_id')->references('id')->on('games');
			$table->unsignedInteger('node_id')->references('id')->on('nodes');
			$table->unsignedInteger('user_id')->references('id')->on('users');

			$table->unsignedBigInteger('panel_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
