<?php

namespace interactivesolutions\honeycombpages\app\models;

use Carbon\Carbon;
use InteractiveSolutions\HoneycombCore\Models\HCUuidModel;
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
    protected $fillable = [
        'id',
        'record_id',
        'language_code',
        'title',
        'slug',
        'summary',
        'content',
        'cover_photo_id',
        'author_id',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    /**
     * Relation to model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(HCLanguages::class, 'language_code', 'iso_639_1');
    }

    /**
     * Relation to parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function record()
    {
        return $this->belongsTo(str_replace('Translations', '', get_class($this)), 'record_id',
            'id')->where('publish_at', '<', Carbon::now());
    }
}