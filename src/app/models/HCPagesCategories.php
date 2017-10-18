<?php

namespace interactivesolutions\honeycombpages\app\models;


use InteractiveSolutions\HoneycombCore\Models\HCMultiLanguageModel;

class HCPagesCategories extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_pages_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'parent_id', 'cover_photo_id'];

}
