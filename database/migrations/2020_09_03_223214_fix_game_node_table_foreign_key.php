<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixGameNodeTableForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_node', function (Blueprint $table) {
            $table->dropForeign('game_node_node_id_foreign');

            $table->foreign('node_id')->references('id')->on('nodes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_node', function (Blueprint $table) {
            $table->dropForeign('game_node_node_id_foreign');

            $table->foreign('node_id')->references('id')->on('games');
        });
    }
}
