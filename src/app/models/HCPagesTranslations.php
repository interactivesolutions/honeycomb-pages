<?php

namespace interactivesolutions\honeycombpages\app\models;

use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycomblanguages\app\models\HCLanguages;

class HCPagesTranslations extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_pages_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'record_id', 'language_code', 'title', 'slug', 'summary', 'content', 'cover_photo_id', 'author_id', 'publish_at', 'expires_at'];

    /**
     * Relation to model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(HCLanguages::class, 'language_code', 'iso_639_1');
    }
}