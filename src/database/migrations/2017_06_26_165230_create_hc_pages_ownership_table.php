<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHcPagesOwnershipTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hc_pages_ownership', function(Blueprint $table)
		{
			$table->integer('count', true);
			$table->timestamps();
			$table->string('record_id', 36)->index('fk_hc_pages_ownership_hc_pages1_idx');
			$table->string('owner_type');
			$table->string('owner_id', 36);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hc_pages_ownership');
	}

}
