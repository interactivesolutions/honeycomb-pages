<?php namespace interactivesolutions\honeycombpages\app\http\controllers\frontend;

use Carbon\Carbon;
use InteractiveSolutions\HoneycombCore\Http\Controllers\HCBaseController;
use interactivesolutions\honeycombpages\app\models\HCPages;
use interactivesolutions\honeycombpages\app\models\HCPagesCategories;
use interactivesolutions\honeycombpages\app\models\HCPagesCategoriesConnections;
use interactivesolutions\honeycombpages\app\models\HCPagesCategoriesTranslations;

class HCPagesCategoriesController extends HCBaseController
{
    /**
     * Showing list of categories
     */
    public function showCategoriesList()
    {
        $list = removeRecordsWithNoTranslation(HCPagesCategories::with('translation')->get()->toArray());

        return hcview('HCPages::category.list', ['data' => ['list' => $list]]);
    }

    /**
     * Showing all pages related to categories
     *
     * @param string $lang
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCategoriesPages(string $lang, string $slug)
    {
        return $this->showData($lang, $slug, 'PAGE');
    }

    /**
     * Showing all articles related to categories
     *
     * @param string $lang
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCategoriesArticles(string $lang, string $slug)
    {
        return $this->showData($lang, $slug, 'ARTICLE');
    }

    /**
     * @param string $lang
     * @param string $slug
     * @param string $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function showData(string $lang, string $slug, string $type)
    {
        $category = HCPagesCategoriesTranslations::where('slug', $slug)
            ->where('language_code', $lang)
            ->first();

        if (!$category) {
            abort(404, 'Page not found');
        }

        $r = HCPages::getTableName();
        $c = HCPagesCategoriesConnections::getTableName();

        $query = HCPages::with(['translation', 'categories', 'author'])->select(HCPages::getFillableFields(true));

        $query->join($c, "$r.id", "=", "$c.page_id")
            ->where("$c.category_id", $category->record_id)
            ->where("$r.type", $type)
            ->where("$r.publish_at", '<', Carbon::now());

        $data = $query->get();

        //TODO make request to retrieve list of pages based on category id
        return hcview('HCPages::category.pages', ['data' => ['list' => $data->toArray()]]);
    }
}
