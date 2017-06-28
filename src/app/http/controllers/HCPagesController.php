<?php namespace interactivesolutions\honeycombpages\app\http\controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombpages\app\models\HCPages;
use interactivesolutions\honeycombpages\app\models\HCPagesTranslations;
use interactivesolutions\honeycombpages\app\validators\HCPagesValidator;
use interactivesolutions\honeycombpages\app\validators\HCPagesTranslationsValidator;

class HCPagesController extends HCBaseController
{

    //TODO recordsPerPage setting

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex()
    {
        $config = [
            'title'       => trans('HCPages::pages.page_title'),
            'listURL'     => route('admin.api.pages'),
            'newFormUrl'  => route('admin.api.form-manager', ['pages-new']),
            'editFormUrl' => route('admin.api.form-manager', ['pages-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if (auth()->user()->can('interactivesolutions_honeycomb_pages_pages_create'))
            $config['actions'][] = 'new';

        if (auth()->user()->can('interactivesolutions_honeycomb_pages_pages_update')) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if (auth()->user()->can('interactivesolutions_honeycomb_pages_pages_delete'))
            $config['actions'][] = 'delete';

        $config['actions'][] = 'search';
        $config['filters'] = $this->getFilters();

        return hcview('HCCoreUI::admin.content.list', ['config' => $config]);
    }

    /**
     * Creating Admin List Header based on Main Table
     *
     * @return array
     */
    public function getAdminListHeader()
    {
        return [
            'type'                          => [
                "type"  => "text",
                "label" => trans('HCPages::pages.type'),
            ],
            'author_id'                          => [
                "type"  => "text",
                "label" => trans('HCPages::pages.author_id'),
            ],
            'publish_at'                         => [
                "type"  => "text",
                "label" => trans('HCPages::pages.publish_at'),
            ],
            'expires_at'                         => [
                "type"  => "text",
                "label" => trans('HCPages::pages.expires_at'),
            ],
            'cover_photo_id'                     => [
                "type"  => "text",
                "label" => trans('HCPages::pages.cover_photo_id'),
            ],
            'translations.{lang}.title'          => [
                "type"  => "text",
                "label" => trans('HCPages::pages.title'),
            ],
            'translations.{lang}.slug'           => [
                "type"  => "text",
                "label" => trans('HCPages::pages.slug'),
            ],
            'translations.{lang}.summary'        => [
                "type"  => "text",
                "label" => trans('HCPages::pages.summary'),
            ],
            'translations.{lang}.content'        => [
                "type"  => "text",
                "label" => trans('HCPages::pages.content'),
            ],
            'translations.{lang}.cover_photo_id' => [
                "type"  => "text",
                "label" => trans('HCPages::pages.cover_photo_id'),
            ],
            'translations.{lang}.author_id'      => [
                "type"  => "text",
                "label" => trans('HCPages::pages.author_id'),
            ],
            'translations.{lang}.publish_at'     => [
                "type"  => "text",
                "label" => trans('HCPages::pages.publish_at'),
            ],
            'translations.{lang}.expires_at'     => [
                "type"  => "text",
                "label" => trans('HCPages::pages.expires_at'),
            ],

        ];
    }

    /**
     * Create item
     *
     * @param array|null $data
     * @return mixed
     */
    protected function __apiStore(array $data = null)
    {
        if (is_null($data))
            $data = $this->getInputData();

        $record = HCPages::create(array_get($data, 'record'));
        $record->updateTranslations(array_get($data, 'translations'));

        return $this->apiShow($record->id);
    }

    /**
     * Updates existing item based on ID
     *
     * @param $id
     * @return mixed
     */
    protected function __apiUpdate(string $id)
    {
        $record = HCPages::findOrFail($id);

        $data = $this->getInputData();

        $record->update(array_get($data, 'record'));
        $record->updateTranslations(array_get($data, 'translations'));
        $record->removeCachedMenu();

        return $this->apiShow($record->id);
    }

    /**
     * Updates existing specific items based on ID
     *
     * @param string $id
     * @return mixed
     */
    protected function __apiUpdateStrict(string $id)
    {
        HCPages::where('id', $id)->update(request()->all());

        return $this->apiShow($id);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiDestroy(array $list)
    {
        HCPagesTranslations::destroy (HCPagesTranslations::whereIn ('record_id', $list)->pluck ('id')->toArray ());
        $pages = HCPages::findMany($list);

        foreach ( $pages as $page ) {
            $page->removeCachedMenu();
            $page->delete();
        }

        return hcSuccess();
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiForceDelete(array $list)
    {
        HCPagesTranslations::onlyTrashed ()->whereIn ('record_id', $list)->forceDelete ();
        HCPages::onlyTrashed()->whereIn('id', $list)->forceDelete();

        return hcSuccess();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed
     */
    protected function __apiRestore(array $list)
    {
        HCPagesTranslations::onlyTrashed ()->whereIn ('record_id', $list)->restore ();
        $pages = HCPages::onlyTrashed ()->whereIn('id', $list)->get();

        foreach ( $pages as $page ) {
            $page->restore();
            $page->removeCachedMenu();
        }

        return hcSuccess();
    }

    /**
     * Creating data query
     *
     * @param array $select
     * @return mixed
     */
    protected function createQuery(array $select = null)
    {
        $with = ['translations'];

        if ($select == null)
            $select = HCPages::getFillableFields(true);

        $list = HCPages::with($with)->select($select)
            // add filters
            ->where(function ($query) use ($select) {
                $query = $this->getRequestParameters($query, $select);
            });

        // enabling check for deleted
        $list = $this->checkForDeleted($list);

        // add search items
        $list = $this->search($list);

        // ordering data
        $list = $this->orderData($list, $select);

        return $list;
    }

    /**
     * List search elements
     * @param Builder $query
     * @param string $phrase
     * @return Builder
     */
    protected function searchQuery(Builder $query, string $phrase)
    {
        $r = HCPages::getTableName();
        $t = HCPagesTranslations::getTableName();

        return $query->join($t, "$r.id", "=", "$t.record_id")
                       ->orWhere("$t.title", 'LIKE', '%' . $phrase . '%')
                       ->orWhere("$t.slug", 'LIKE', '%' . $phrase . '%')
                       ->orWhere("$t.content", 'LIKE', '%' . $phrase . '%');
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new HCPagesValidator())->validateForm();
        (new HCPagesTranslationsValidator())->validateForm();

        $_data = request()->all();

        if (array_has($_data, 'id'))
            array_set ($data, 'record.id', array_get ($_data, 'id'));

        $user = Auth::user() ? Auth::user()->id : null;

        array_set($data, 'record.author_id', $user);
        array_set($data, 'record.publish_at', array_get($_data, 'publish_at'));
        array_set($data, 'record.expires_at', array_get($_data, 'expires_at'));
        array_set($data, 'record.cover_photo_id', array_get($_data, 'cover_photo_id'));
        array_set($data, 'record.type', array_get($_data, 'type'));

        $translations = array_get($_data, 'translations');

        foreach ($translations as &$value)
        {
            if (!isset($value['slug']) || $value['slug'] == "")
                $value['slug'] = generateHCSlug(HCPagesTranslations::getTableName() . '_' . $value['language_code'], $value['title']);
        }

        array_set($data, 'translations', $translations);

        array_set($data, 'users', array_get($_data, 'users', []));
        array_set($data, 'userGroups', array_get($_data, 'userGroups', []));

        return makeEmptyNullable($data);
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */
    public function apiShow(string $id)
    {
        $with = ['translations'];

        $select = HCPages::getFillableFields();

        $record = HCPages::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        return $record;
    }

    /**
     * Generating filters required for admin view
     *
     * @return array
     */
    public function getFilters()
    {
        $filters = [];

        return $filters;
    }

    /**
     * Get options by request data
     *
     * @return array
     */
    public function options()
    {
        if( request()->has('language') ) {
            $pages = HCPagesTranslations::select('record_id as id', 'title', 'language_code')
                ->where('language_code', request('language'));

            if( request()->has('type') ) {
                $pages->whereHas('record', function($query) {
                    $query->where('type', strtoupper(request('type')));
                });
            }

            if( request()->has('q') ) {
                $pages->where('title', 'LIKE', '%' . request('q') . '%');
            }

            return $pages->get();
        }

        return [];
    }
}
