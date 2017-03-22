<?php namespace interactivesolutions\honeycombpages\app\http\controllers;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombpages\app\models\HCCategories;
use interactivesolutions\honeycombpages\app\validators\HCCategoriesValidator;
use interactivesolutions\honeycombpages\app\validators\HCCategoriesTranslationsValidator;

class HCCategoriesController extends HCBaseController
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
            'title'       => trans('HCPages::categories.page_title'),
            'listURL'     => route('admin.api.categories'),
            'newFormUrl'  => route('admin.api.form-manager', ['categories-new']),
            'editFormUrl' => route('admin.api.form-manager', ['categories-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if ($this->user()->can('interactivesolutions_honeycomb_pages_categories_create'))
            $config['actions'][] = 'new';

        if ($this->user()->can('interactivesolutions_honeycomb_pages_categories_update'))
        {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if ($this->user()->can('interactivesolutions_honeycomb_pages_categories_delete'))
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
            'parent_id'     => [
    "type"  => "text",
    "label" => trans('HCPages::categories.parent_id'),
],
'cover_photo_id'     => [
    "type"  => "text",
    "label" => trans('HCPages::categories.cover_photo_id'),
],
'translations.{lang}.title'     => [
    "type"  => "text",
    "label" => trans('HCPages::categories.title'),
],
'translations.{lang}.slug'     => [
    "type"  => "text",
    "label" => trans('HCPages::categories.slug'),
],
'translations.{lang}.content'     => [
    "type"  => "text",
    "label" => trans('HCPages::categories.content'),
],
'translations.{lang}.cover_photo_id'     => [
    "type"  => "text",
    "label" => trans('HCPages::categories.cover_photo_id'),
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

        $record = HCCategories::create(array_get($data, 'record'));
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
        $record = HCCategories::findOrFail($id);

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
        HCCategories::where('id', $id)->update(request()->all());

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
        HCCategories::destroy($list);
    }

    /**
    * Delete records table
    *
    * @param $list
    * @return mixed|void
    */
    protected function __forceDelete(array $list)
    {
        HCCategories::onlyTrashed()->whereIn('id', $list)->forceDelete();
    }

    /**
    * Restore multiple records
    *
    * @param $list
    * @return mixed|void
    */
    protected function __restore(array $list)
    {
        HCCategories::whereIn('id', $list)->restore();
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
            $select = HCCategories::getFillableFields();

        $list = HCCategories::with($with)->select($select)
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
                $query->where('parent_id', 'LIKE', '%' . $parameter . '%')
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
        (new HCCategoriesValidator())->validateForm();
        (new HCCategoriesTranslationsValidator())->validateForm();

        $_data = request()->all();

        array_set($data, 'record.parent_id', array_get($_data, 'parent_id'));
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

        $select = HCCategories::getFillableFields();

        $record = HCCategories::with($with)
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
