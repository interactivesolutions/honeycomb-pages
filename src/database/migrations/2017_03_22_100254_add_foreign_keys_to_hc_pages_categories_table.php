<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddForeignKeysToHcPagesCategoriesTable
 */
class AddForeignKeysToHcPagesCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('hc_pages_categories', function (Blueprint $table) {
            $table->foreign('parent_id', 'fk_hc_pages_categories_hc_pages_categories1')
                ->references('id')
                ->on('hc_pages_categories')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('hc_pages_categories', function (Blueprint $table) {
            $table->dropForeign('fk_hc_pages_categories_hc_pages_categories1');
        });
    }

}
