<?php

namespace App\Http\Controllers\SMS\Admin;

use App\Http\Controllers\GetForms\GetForm1Controller;
use App\Http\Controllers\GetForms\GetForm2Controller;
use App\Http\Controllers\GetForms\GetForm3Controller;
use App\Models\SMS\SugarMills;
use App\Models\SMS\WeeklyReports;
use App\SMS\Services\WeeklyReportService;
use Illuminate\Http\Request;

class RecapController
{
    protected $weeklyReportService;

    public function __construct(WeeklyReportService $weeklyReportService)
    {
        $this->weeklyReportService = $weeklyReportService;
    }

    /**
     * Mills that should appear in recaps.
     */
    private const GROUP_ORDER = ['Luzon', 'Negros', 'Panay', 'E. Visayas', "Mindanao"];

    private function recapMills()
    {
        $placeholders = implode(',', array_fill(0, count(self::GROUP_ORDER), '?'));

        return SugarMills::query()
            ->where('for_recap', '=', 1)
            ->orderByRaw("FIELD(`group`, {$placeholders}) = 0")   // groups not in the list go last
            ->orderByRaw("FIELD(`group`, {$placeholders})", array_merge(self::GROUP_ORDER, self::GROUP_ORDER))
            ->orderBy('group', 'asc')                              // alphabetical among unlisted groups
            ->orderBy('ordering', 'asc');
    }

    /**
     * Submitted reports for the report no. / crop year, limited to recap mills.
     */
    private function recapReports($report_no, $crop_year)
    {
        return WeeklyReports::query()
            ->where('status', '=', 1)
            ->where('report_no', '=', $report_no)
            ->where('crop_year', '=', $crop_year)
            ->whereHas('sugarMill', function ($query) {
                $query->where('for_recap', '=', 1);
            });
    }

    /**
     * Week ending of the submitted reports (recap mills only).
     * max() so one mill with a different date can't make the result arbitrary.
     */
    private function getWeekEnding($report_no, $crop_year)
    {
        return $this->recapReports($report_no, $crop_year)->max('week_ending');
    }

    public function comparativeGtcm(Request $request)
    {
        $report_no = $request->report_no * 1;
        $crop_year = $request->crop_year;
        $comparativeGtcmArray = [];

        $wrs = $this->recapReports($report_no, $crop_year)
            ->with(['sugarMill', 'form1'])
            ->get();

        foreach ($this->recapMills()->get() as $mill) {
            $comparativeGtcmArray[$mill->group][$mill->slug] = [];
        }

        foreach ($wrs as $wr) {
            $comparativeGtcmArray[$wr->sugarMill->group ?? ''][$wr->sugarMill->slug ?? ''] = [
                'gtcm'               => $wr->form1->gtcm ?? null,
                'lkgtcGross'         => $wr->form1->lkgtc_gross ?? null,
                'rawSugarProduction' => $wr->form1->manufactured ?? null,
            ];
        }

        return view('sms.printables.comparative.comparativeGtcm')->with([
            'current'    => $comparativeGtcmArray,
            'weekEnding' => $this->getWeekEnding($report_no, $crop_year),
            'reportNo'   => $report_no,
            'cropYear'   => $crop_year,
        ]);
    }

    public function raw1(Request $request, GetForm1Controller $getForm1Controller)
    {
        $report_no = $request->report_no * 1;
        $crop_year = $request->crop_year;

        $comparativeArray = [];
        foreach ($this->recapMills()->get() as $mill) {
            $comparativeArray[$mill->group][$mill->slug] = [
                'weeklyReportSlug' => null,
                'form1'            => [],
            ];
        }

        $wrs = $this->recapReports($report_no, $crop_year)
            ->with('sugarMill')
            ->select('slug', 'mill_code')
            ->get();

        foreach ($wrs as $wr) {
            $mill = $wr->sugarMill;
            if (!$mill) {
                continue;
            }

            $form1 = $getForm1Controller->getForm1($wr->slug, false);

            $comparativeArray[$mill->group][$mill->slug]['weeklyReportSlug'] = $wr->slug;
            $comparativeArray[$mill->group][$mill->slug]['form1'] = $form1['values'];
            $comparativeArray[$mill->group][$mill->slug]['rows']  = $form1['rows'];
        }

        return view('sms.printables.comparative.raw1')->with([
            'comparativeArray' => $comparativeArray,
            'weekEnding'       => $this->getWeekEnding($report_no, $crop_year),
            'reportNo'         => $report_no,
            'cropYear'         => $crop_year,
        ]);
    }

    public function molPWS(Request $request, GetForm3Controller $getForm3Controller)
    {
        $report_no = $request->report_no * 1;
        $crop_year = $request->crop_year;

        $comparativeArray = [];
        foreach ($this->recapMills()->get() as $mill) {
            $comparativeArray[$mill->group][$mill->slug] = [
                'weeklyReportSlug' => null,
                'form3'            => [],
            ];
        }

        $wrs = $this->recapReports($report_no, $crop_year)
            ->with('sugarMill')
            ->select('slug', 'mill_code')
            ->get();

        foreach ($wrs as $wr) {
            $mill = $wr->sugarMill;
            if (!$mill) {
                continue;
            }

            $form3 = $getForm3Controller->getForm3($wr->slug, false);

            $comparativeArray[$mill->group][$mill->slug]['weeklyReportSlug'] = $wr->slug;
            $comparativeArray[$mill->group][$mill->slug]['form3'] = $form3['values'];
        }

        return view('sms.printables.comparative.molPWS')->with([
            'millsArray' => $comparativeArray,
            'weekEnding' => $this->getWeekEnding($report_no, $crop_year),
            'reportNo'   => $report_no,
            'cropYear'   => $crop_year,
        ]);
    }

    public function refPWS(Request $request, GetForm2Controller $getForm2Controller)
    {
        $report_no = $request->report_no * 1;
        $crop_year = $request->crop_year;

        $comparativeArray = [];
        $mills = $this->recapMills()
            ->where('has_refinery', '=', 1)
            ->get();

        foreach ($mills as $mill) {
            $comparativeArray[$mill->group][$mill->slug] = [
                'weeklyReportSlug' => null,
                'form2'            => [],
            ];
        }

        $wrs = $this->recapReports($report_no, $crop_year)
            ->with('sugarMill')
            ->select('slug', 'mill_code')
            ->whereHas('sugarMill', function ($query) {
                $query->where('has_refinery', '=', 1);
            })
            ->get();

        foreach ($wrs as $wr) {
            $mill = $wr->sugarMill;
            if (!$mill) {
                continue;
            }

            $form2 = $getForm2Controller->getForm2($wr->slug, false);

            $comparativeArray[$mill->group][$mill->slug]['weeklyReportSlug'] = $wr->slug;
            $comparativeArray[$mill->group][$mill->slug]['form2'] = $form2['values'];
        }

        return view('sms.printables.comparative.refPWS')->with([
            'millsArray' => $comparativeArray,
            'weekEnding' => $this->getWeekEnding($report_no, $crop_year),
            'reportNo'   => $report_no,
            'cropYear'   => $crop_year,
        ]);
    }

    public function gtcm(Request $request, GetForm1Controller $getForm1Controller)
    {
        $report_no = $request->report_no * 1;
        $crop_year = $request->crop_year;

        $comparativeArray = [];
        foreach ($this->recapMills()->get() as $mill) {
            $comparativeArray[$mill->group][$mill->slug] = [
                'weeklyReportSlug' => null,
                'form1'            => [],
            ];
        }

        $wrs = $this->recapReports($report_no, $crop_year)
            ->with('sugarMill')
            ->select('slug', 'mill_code')
            ->get();

        foreach ($wrs as $wr) {
            $mill = $wr->sugarMill;
            if (!$mill) {
                continue;
            }

            $form1 = $getForm1Controller->getForm1($wr->slug, false);

            $comparativeArray[$mill->group][$mill->slug]['weeklyReportSlug'] = $wr->slug;
            $comparativeArray[$mill->group][$mill->slug]['form1'] = $form1['values'];
        }

        return view('sms.printables.comparative.gtcm')->with([
            'millsArray' => $comparativeArray,
            'weekEnding' => $this->getWeekEnding($report_no, $crop_year),
            'reportNo'   => $report_no,
            'cropYear'   => $crop_year,
        ]);
    }
}