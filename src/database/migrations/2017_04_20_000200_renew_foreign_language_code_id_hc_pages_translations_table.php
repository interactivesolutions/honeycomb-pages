<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use interactivesolutions\honeycomblanguages\app\models\HCLanguages;
use interactivesolutions\honeycombpages\app\models\HCPagesTranslations;

/**
 * Class RenewForeignLanguageCodeIdHcPagesTranslationsTable
 */
class RenewForeignLanguageCodeIdHcPagesTranslationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $list = HCPagesTranslations::get();

        foreach ($list as $key => $value) {
            HCPagesTranslations::where('id', $value->id)
                ->update([
                    'language_code' => HCLanguages::find($value->language_code)->iso_639_1,
                ]);
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        $list = HCPagesTranslations::get();

        foreach ($list as $key => $value) {
            HCPagesTranslations::where('id', $value->id)->update([
                'language_code' => HCLanguages::where('iso_639_1', $value->language_code)->first()->id,
            ]);
        }
    }
}
