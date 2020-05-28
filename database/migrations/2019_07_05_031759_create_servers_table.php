<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('hash');
            $table->string('ip');

            $table->string('billing_period');

            $table->unsignedInteger('cpu');
            $table->unsignedInteger('memory');
            $table->unsignedInteger('disk');
            $table->unsignedInteger('io');
            $table->unsignedInteger('databases');

            $table->unsignedInteger('game_id')->references('id')->on('games');
            $table->unsignedInteger('node_id')->references('id')->on('nodes');
            $table->unsignedInteger('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('panel_id')->nullable();
            $table->string('panel_hash')->nullable();

            $table->timestamp('installed_at')->nullable();

            $table->softDeletes();
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
