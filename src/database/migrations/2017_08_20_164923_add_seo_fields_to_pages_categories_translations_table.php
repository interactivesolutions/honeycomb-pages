<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoFieldsToPagesCategoriesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_pages_categories_translations', function(Blueprint $table) {
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_pages_categories_translations', function(Blueprint $table) {
            $table->dropColumn('seo_title');
            $table->dropColumn('seo_description');
            $table->dropColumn('seo_keywords');
        });
    }
}
