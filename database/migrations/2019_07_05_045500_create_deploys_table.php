<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeploysTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deploys', function (Blueprint $table) {
			$table->bigIncrements('id');

			$table->string('billing_period');
			$table->unsignedInteger('cost_per_period');

            $table->unsignedInteger('cpu');
            $table->unsignedInteger('ram');
            $table->unsignedInteger('disk');
            $table->unsignedInteger('io');
            $table->unsignedInteger('databases');

			$table->uuid('transaction_id')->nullable();
			$table->foreign('transaction_id')->references('id')->on('transactions');

			$table->unsignedBigInteger('server_id')->nullable();
			$table->foreign('server_id')->references('id')->on('servers');

			$table->string('termination_reason')->nullable();
            $table->dateTime('terminated_at')->nullable();

			$table->unsignedBigInteger('terminated_by')->nullable();
			$table->foreign('terminated_by')->references('id')->on('users');

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
		Schema::dropIfExists('deploys');
	}
}
