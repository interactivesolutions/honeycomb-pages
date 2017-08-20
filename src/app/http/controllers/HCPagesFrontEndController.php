<?php namespace interactivesolutions\honeycombpages\app\http\controllers;

use Carbon\Carbon;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombpages\app\models\HCPages;
use interactivesolutions\honeycombpages\app\models\HCPagesTranslations;

class HCPagesFrontEndController extends HCBaseController
{
    /**
     * Based on provided data showing content
     *
     * @param string $lang
     * @param string|null $year
     * @param string|null $month
     * @param string|null $day
     * @param string|null $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showArticle (string $lang, string $year = null, string $month = null, string $day = null, string $slug = null)
    {
        //URL -> articles/2017/03/23/page-name
        if ($slug)
            return $this->showPage(null, $slug);

        if ($day)
            return $this->showByDate((new Carbon($year . '-' . $month . '-' . $day))->startOfDay(), (new Carbon($year . '-' . $month . '-' . $day))->endOfDay());

        if ($month)
            return $this->showByDate((new Carbon($year . '-' . $month))->startOfMonth(), (new Carbon($year . '-' . $month))->endOfMonth());

        if ($year)
            return $this->showByDate((new Carbon($year))->startOfYear(), (new Carbon($year))->endOfYear());

        abort(404, 'Page not found');
    }

    /**
     * @param string $lang
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showPage(string $lang, string $slug)
    {
        $data = HCPagesTranslations::where('slug', $slug)
            ->where('language_code', app()->getLocale())
            ->with('record')->first();

        //TODO make new SQL call where `publish_at` in the HCPages table will be included
        //TODO make new SQL call where `type` in the HCPages table will be included

        if (!$data)
            abort(404, 'Page not found');

        return hcview('HCPages::page.single', ['data' => ['page' => $data->toArray()]]);
    }

    /**
     * Showing list of pages by date
     *
     * @param Carbon $startAt
     * @param Carbon $endAt
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showByDate (Carbon $startAt, Carbon $endAt)
    {
        $data = HCPages::with('translation')
            ->where('publish_at', '>=', $startAt)
            ->where('publish_at', '<=', $endAt)
            ->where('publish_at', '<', Carbon::now())
            ->paginate(20)->toArray();

        $data['data'] = removeRecordsWithNoTranslation($data['data']);

        return hcview('HCPages::page.list', ['data' => ['list' => $data]]);
    }
}
