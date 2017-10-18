<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeNullableAuthorIdInHcPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_pages', function(Blueprint $table) {
            $table->string('author_id', 36)->nullable()->change();
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
            $table->string('author_id', 36)->nullable(false)->change();
        });
    }
}
