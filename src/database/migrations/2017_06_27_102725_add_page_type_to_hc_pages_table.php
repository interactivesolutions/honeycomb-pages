<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPageTypeToHcPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_pages', function(Blueprint $table) {
            $table->enum('type', ['PAGE', 'ARTICLE'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_pages', function(Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
