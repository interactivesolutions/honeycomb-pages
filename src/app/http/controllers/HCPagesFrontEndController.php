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
    public function showData(string $year = null, string $month = null, string $day = null, string $slug = null)
    {
        //URL -> pages/2017/03/23/page-name

        if (!is_numeric($year))
            return $this->showPage($year);

        if (!is_numeric($day))
            return $this->showByDay($day);

        if (!is_numeric($month))
            return $this->showByMonth($month);

        if (is_numeric($year))
                return $this->showByYear($slug);


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
        return view('HCPages::page.' . $slug, ['config' => $data]);
    }

    //TODO showByDay
    //TODO showByMonth
    //TODO fix showByYear, that sorts pages by full date

    private function showByYear(string $slug){
        return $this->showPage($slug);
    }
}
