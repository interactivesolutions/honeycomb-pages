<?php namespace interactivesolutions\honeycombpages\app\http\controllers;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombpages\app\models\HCPages;
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
    public function adminView()
    {
        $config = [
            'title'       => trans('HCPages::pages.page_title'),
            'listURL'     => route('admin.api.pages'),
            'newFormUrl'  => route('admin.api.form-manager', ['pages-new']),
            'editFormUrl' => route('admin.api.form-manager', ['pages-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if ($this->user()->can('interactivesolutions_honeycomb_pages_pages_create'))
            $config['actions'][] = 'new';

        if ($this->user()->can('interactivesolutions_honeycomb_pages_pages_update'))
        {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if ($this->user()->can('interactivesolutions_honeycomb_pages_pages_delete'))
            $config['actions'][] = 'delete';

        $config['actions'][] = 'search';
        $config['filters'] = $this->getFilters ();

        return view('HCCoreUI::admin.content.list', ['config' => $config]);
    }

    /**
     * Creating Admin List Header based on Main Table
     *
     * @return array
     */
    public function getAdminListHeader()
    {
        return [
            'author_id'     => [
    "type"  => "text",
    "label" => trans('HCPages::pages.author_id'),
],
'publish_at'     => [
    "type"  => "text",
    "label" => trans('HCPages::pages.publish_at'),
],
'expires_at'     => [
    "type"  => "text",
    "label" => trans('HCPages::pages.expires_at'),
],
'cover_photo_id'     => [
    "type"  => "text",
    "label" => trans('HCPages::pages.cover_photo_id'),
],
'translations.{lang}.title'     => [
    "type"  => "text",
    "label" => trans('HCPages::pages.title'),
],
'translations.{lang}.slug'     => [
    "type"  => "text",
    "label" => trans('HCPages::pages.slug'),
],
'translations.{lang}.summary'     => [
    "type"  => "text",
    "label" => trans('HCPages::pages.summary'),
],
'translations.{lang}.content'     => [
    "type"  => "text",
    "label" => trans('HCPages::pages.content'),
],
'translations.{lang}.cover_photo_id'     => [
    "type"  => "text",
    "label" => trans('HCPages::pages.cover_photo_id'),
],
'translations.{lang}.author_id'     => [
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
    protected function __create(array $data = null)
    {
        if(is_null($data))
            $data = $this->getInputData();

        $record = HCPages::create(array_get($data, 'record'));
        $record->updateTranslations(array_get($data, 'translations'));

        return $this->getSingleRecord($record->id);
    }

    /**
    * Updates existing item based on ID
    *
    * @param $id
    * @return mixed
    */
    protected function __update(string $id)
    {
        $record = HCPages::findOrFail($id);

        $data = $this->getInputData();

        $record->update(array_get($data, 'record'));
        $record->updateTranslations(array_get($data, 'translations'));

        return $this->getSingleRecord($record->id);
    }

    /**
    * Updates existing specific items based on ID
    *
    * @param string $id
    * @return mixed
    */
    protected function __updateStrict(string $id)
    {
        HCPages::where('id', $id)->update(request()->all());

        return $this->getSingleRecord($id);
    }

    /**
    * Delete records table
    *
    * @param $list
    * @return mixed|void
    */
    protected function __delete(array $list)
    {
        HCPages::destroy($list);
    }

    /**
    * Delete records table
    *
    * @param $list
    * @return mixed|void
    */
    protected function __forceDelete(array $list)
    {
        HCPages::onlyTrashed()->whereIn('id', $list)->forceDelete();
    }

    /**
    * Restore multiple records
    *
    * @param $list
    * @return mixed|void
    */
    protected function __restore(array $list)
    {
        HCPages::whereIn('id', $list)->restore();
    }

    /**
     * Creating data query
     *
     * @param array $select
     * @return mixed
     */
    public function createQuery(array $select = null)
    {
        $with = ['translations'];

        if ($select == null)
            $select = HCPages::getFillableFields();

        $list = HCPages::with($with)->select($select)
        // add filters
        ->where(function ($query) use ($select) {
            $query = $this->getRequestParameters($query, $select);
        });

        // enabling check for deleted
        $list = $this->checkForDeleted($list);

        // add search items
        $list = $this->listSearch($list);

        // ordering data
        $list = $this->orderData($list, $select);

        return $list;
    }

     /**
     * List search elements

     * @param $list
     * @return mixed
     */
     protected function listSearch(Builder $list)
     {
         if(request()->has('q'))
         {
             $parameter = request()->input('q');

             $list = $list->where(function ($query) use ($parameter)
             {
                $query->where('author_id', 'LIKE', '%' . $parameter . '%')
->orWhere('publish_at', 'LIKE', '%' . $parameter . '%')
->orWhere('expires_at', 'LIKE', '%' . $parameter . '%')
->orWhere('cover_photo_id', 'LIKE', '%' . $parameter . '%')
;
             });
         }

         return $list;
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

        array_set($data, 'record.author_id', array_get($_data, 'author_id'));
array_set($data, 'record.publish_at', array_get($_data, 'publish_at'));
array_set($data, 'record.expires_at', array_get($_data, 'expires_at'));
array_set($data, 'record.cover_photo_id', array_get($_data, 'cover_photo_id'));

        array_set ($data, 'translations', array_get ($_data, 'translations'));

        return $data;
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */
    public function getSingleRecord(string $id)
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
}
