<?php

namespace interactivesolutions\honeycombpages\app\models;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCPagesCategoriesTranslations extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_pages_categories_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'record_id', 'language_code', 'title', 'slug', 'content', 'cover_photo_id', 'seo_title', 'seo_description', 'seo_keywords'];
}