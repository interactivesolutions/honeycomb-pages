<?php namespace interactivesolutions\honeycombpages\app\http\controllers\frontend;

use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombpages\app\models\HCPages;
use interactivesolutions\honeycombpages\app\models\HCPagesCategories;

class HCPagesCategoriesController extends HCBaseController
{
    /**
     * Showing list of categories
     */
    public function showCategoriesList ()
    {
        $list = removeRecordsWithNoTranslation(HCPagesCategories::with('translation')->get()->toArray());

        return hcview('HCPages::page.categories-list', ['data' => ['list' => $list]]);
    }

    /**
     * Showing all pages related to categories
     * @param string $lang
     * @param string $slug
     */
    public function showCategoriesPages (string $lang, string $slug)
    {
        //TODO make request to retrieve list of pages based on category id
        return hcview('HCPages::page.list', ['data' => []]);
    }
}
