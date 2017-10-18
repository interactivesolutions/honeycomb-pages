<?php

namespace interactivesolutions\honeycombpages\app\models;


use InteractiveSolutions\HoneycombCore\Models\HCUuidModel;

class HCPagesCategoriesConnections extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_pages_categories_connections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['page_id', 'category_id'];
}