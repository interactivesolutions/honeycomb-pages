<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateHcPagesGalleriesConnectionsTable
 */
class CreateHcPagesGalleriesConnectionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('hc_pages_galleries_connections', function (Blueprint $table) {
            $table->integer('count', true);
            $table->timestamps();
            $table->string('page_id', 36)->index('fk_hc_pages_galleries_connections_hc_pages1_idx');
            $table->string('gallery_id', 36)->index('fk_hc_pages_galleries_connections_hc_galleries1_idx');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('hc_pages_galleries_connections');
    }

}
