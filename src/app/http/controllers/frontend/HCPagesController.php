<?php namespace interactivesolutions\honeycombpages\app\http\controllers\frontend;

use Carbon\Carbon;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombpages\app\models\HCPages;
use interactivesolutions\honeycombpages\app\models\HCPagesTranslations;

class HCPagesController extends HCBaseController
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
    public function showArticles (string $lang, string $year = null, string $month = null, string $day = null, string $slug = null)
    {
        //URL -> articles/2017/03/23/page-name
        if ($slug)
            return $this->showArticle($lang, $year, $month, $day, $slug);

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
        $r = HCPages::getTableName();
        $t = HCPagesTranslations::getTableName();

        $query = HCPages::with(['translation', 'categories', 'author'])->select(HCPages::getFillableFields(true));

        $query->join($t, "$r.id", "=", "$t.record_id")
            ->where("$t.slug", $slug)
            ->where("$t.language_code", $lang)
            ->where("$r.type", 'PAGE')
            ->where("$r.publish_at", '<', Carbon::now());

        $data = $query->first();

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
            ->where('type', 'ARTICLE')
            ->where('publish_at', '>=', $startAt)
            ->where('publish_at', '<=', $endAt)
            ->where('publish_at', '<', Carbon::now())
            ->paginate(20)->toArray();

        $data['data'] = removeRecordsWithNoTranslation($data['data']);

        return hcview('HCPages::article.list', ['data' => ['list' => $data]]);
    }

    /**
     * Returning single article view
     *
     * @param string $lang
     * @param string $year
     * @param string $month
     * @param string $day
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function showArticle (string $lang, string $year, string $month, string $day, string $slug)
    {
        $r = HCPages::getTableName();
        $t = HCPagesTranslations::getTableName();

        $query = HCPages::with(['translation', 'categories', 'author'])->select(HCPages::getFillableFields(true));

        $query->join($t, "$r.id", "=", "$t.record_id")
            ->where("$t.slug", $slug)
            ->where("$t.language_code", $lang)
            ->where("$r.type", 'ARTICLE')
            ->where('publish_at', '>=', (new Carbon($year . '-' . $month . '-' . $day))->startOfDay())
            ->where('publish_at', '<=', (new Carbon($year . '-' . $month . '-' . $day))->endOfDay())
            ->where('publish_at', '<', Carbon::now());

        $data = $query->first();

        if (!$data)
            abort(404, 'Page not found');

        return hcview('HCPages::article.single', ['data' => ['article' => $data->toArray()]]);
    }
}
