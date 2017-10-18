<?php

namespace interactivesolutions\honeycombpages\app\models;

use Carbon\Carbon;
use InteractiveSolutions\HoneycombAcl\Models\HCUsers;
use InteractiveSolutions\HoneycombCore\Models\HCMultiLanguageModel;
use InteractiveSolutions\HoneycombCore\Models\Traits\CustomAppends;
use interactivesolutions\honeycombmenu\app\helpers\MenuHelper;
use interactivesolutions\honeycombmenu\app\models\HCMenu;
use interactivesolutions\honeycombresources\app\models\HCResources;

class HCPages extends HCMultiLanguageModel
{
    use CustomAppends;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'author_id', 'publish_at', 'cover_photo_id', 'type'];


    /**
     * Relation to record
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(HCUsers::class, 'author_id', 'id');
    }

    /**
     * Relation to resource
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function resource()
    {
        return $this->hasOne(HCResources::class, 'id', 'cover_photo_id');
    }

    /**
     * Get articles
     *
     * @param $query
     * @return mixed
     */
    public function scopeArticles($query)
    {
        return $query->where(function($query) {
            $query->where('type', 'ARTICLE')
                ->where('created_at', '<=', new Carbon());
        });
    }

    /**
     * Get records by given year
     *
     * @param $query
     * @param $year
     * @return mixed
     */
    public function scopeYear($query, $year)
    {
        return $query->whereYear('created_at', '=', $year);
    }

    /**
     * Get records by given month
     *
     * @param $query
     * @param $month
     * @return mixed
     */
    public function scopeMonth($query, $month)
    {
        return $query->whereMonth('created_at', '=', $month);
    }

    /**
     * Get records by given day
     *
     * @param $query
     * @param $day
     * @return mixed
     */
    public function scopeDay($query, $day)
    {
        return $query->whereDay('created_at', '=', $day);
    }
//
//    /**
//     * Get article url
//     *
//     * @return string
//     */
//    public function getArticleUrlAttribute()
//    {
//        return route('articles.page', [app()->getLocale(), $this->created_at->year, $this->created_at->month, $this->created_at->day, $this->slug]);
//    }

//    /**
//     * Filter by language code
//     *
//     * @param $query
//     * @param $languageCode
//     * @return mixed
//     */
//    public function scopeLang($query, $languageCode)
//    {
//        return $query->where('language_code', '=', $languageCode);
//    }

    /**
     * Get pages
     *
     * @param $query
     * @return mixed
     */
    public function scopePages($query)
    {
        return $query->where('type', 'PAGE');
    }

    /**
     * Get page url
     *
     * @return string
     */
    public function getPageUrlAttribute()
    {
        return route('page',
            [app()->getLocale(), get_translation_name('slug', app()->getLocale(), $this->translations->toArray())]);
    }

    /**
     * Relation to menu items
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menu_items()
    {
        return $this->hasMany(HCMenu::class, 'page_id', 'id');
    }

    /**
     * Remove cached menu
     */
    public function removeCachedMenu()
    {
        $menuTypeIds = $this->menu_items()->pluck('menu_type_id')->unique()->all();

        foreach ($menuTypeIds as $menuTypeId) {
            MenuHelper::clearCache($menuTypeId, app()->getLocale());
        }
    }

    public function categories()
    {
        return $this->belongsToMany(HCPagesCategories::class, HCPagesCategoriesConnections::getTableName(), 'page_id',
            'category_id')->with('translation');
    }
}
