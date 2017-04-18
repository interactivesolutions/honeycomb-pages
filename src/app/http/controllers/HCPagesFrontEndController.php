<?php namespace interactivesolutions\honeycombpages\app\http\controllers;

use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombpages\app\models\HCPages;
use interactivesolutions\honeycombpages\app\models\HCPagesTranslations;

class HCPagesFrontEndController extends HCBaseController
{
    /**
     * Based on provided data showing content
     *
     * @param string|null $year
     * @param string|null $month
     * @param string|null $day
     * @param string|null $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showData (string $year = null, string $month = null, string $day = null, string $slug = null)
    {
        //URL -> pages/2017/03/23/page-name
        if ($slug)
            return $this->showPage($slug);

        if ($day)
            return $this->showByDay();
    }

    protected function showPage(string $slug)
    {
        $r = HCPages::getTableName();
        $t = HCPagesTranslations::getTableName();

        $list = HCPages::select(HCPages::getFillableFields(true))->with('translation');
        $list = $list->join($t, "$r.id", "=", "$t.record_id")
            ->where("$t.slug", $slug)
            ->where("$t.language_code", 'eng');

        $data = $list->first()->toArray();

        //TODO move to environment
        return view('HCPages::page.single', ['config' => $data]);
    }
}
