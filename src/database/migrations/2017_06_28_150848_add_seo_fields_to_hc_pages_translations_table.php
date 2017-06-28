<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoFieldsToHcPagesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_pages_translations', function (Blueprint $table) {
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->unique(['record_id','language_code'], 'fk_hc_pages_translations_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_pages_translations', function (Blueprint $table) {
            $table->dropColumn('seo_title');
            $table->dropColumn('seo_description');
            $table->dropColumn('seo_keywords');
            $table->dropUnique('fk_hc_pages_translations_unique');
        });
    }
}
