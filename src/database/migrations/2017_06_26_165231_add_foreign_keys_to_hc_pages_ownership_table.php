<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHcPagesOwnershipTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hc_pages_ownership', function(Blueprint $table)
		{
			$table->foreign('record_id', 'fk_hc_pages_ownership_hc_pages1')->references('id')->on('hc_pages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hc_pages_ownership', function(Blueprint $table)
		{
			$table->dropForeign('fk_hc_pages_ownership_hc_pages1');
		});
	}

}
