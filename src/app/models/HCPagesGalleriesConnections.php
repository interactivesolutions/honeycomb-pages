<?php

namespace interactivesolutions\honeycombpages\app\models;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCPagesGalleriesConnections extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_pages_galleries_connections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['page_id', 'gallery_id'];
}