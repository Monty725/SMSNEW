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

    public function comparativeGtcm(Request $request){
        $report_no = $request->report_no;
        $crop_year = $request->crop_year;
        $comparativeGtcmArray = [];
        $millsArray = [];
        $wrs = WeeklyReports::query()
            ->where('status','=',1)
            ->where('report_no','=',$report_no)
            ->where('crop_year','=',$crop_year)
            ->get();
        $mills = SugarMills::query()->get();
        if(!empty($mills)){
            foreach ($mills as $mill){
                $comparativeGtcmArray[$mill->group][$mill->slug] = [];
            }
        }

        if(!empty($wrs)){
            foreach ($wrs as $wr){
                $comparativeGtcmArray[$wr->sugarMill->group ?? ''][$wr->sugarMill->slug ?? ''] = [
                    'gtcm' => $wr->form1->gtcm ?? null,
                    'lkgtcGross' => $wr->form1->lkgtc_gross ?? null,
                    'rawSugarProduction' => $wr->form1->manufactured ?? null,
                ];
            }
        }
        return view('sms.printables.comparative.comparativeGtcm')->with([
            'current' => $comparativeGtcmArray,
        ]);
    }

//    INJECT ON FUNCTION ------------------
    public function raw1(Request $request, GetForm1Controller $getForm1Controller){
//        dd($getform1Controller);
        $weeklyreports = WeeklyReports::query()
            ->where("report_no","=", 4)
            ->where("status","=", 1)
            ->get();


//        CODE START RECAP ------------------
        $submittedReports = $weeklyreports->mapWithKeys(function ($weeklyreport){
            return [
                $weeklyreport->mill_code=>$weeklyreport
            ];
        });
        $weeklyReportsArray = [];
        foreach($submittedReports as $mill_code=>$submittedReport)
        {
            $weeklyReportsArray[$mill_code] = $getForm1Controller->getForm1($submittedReport->slug, false);
        }
//        dd($submittedReports);
//        CODE END --------------------------

//        dd($getForm1Controller->getForm1($weeklyreports->first()->slug, false));
        $report_no = $request->report_no * 1;
        $crop_year = $request->crop_year;

        $comparativeArray = [];
        $mills = SugarMills::query()->get();
        if(!empty($mills)){
            foreach ($mills as $mill){
                $comparativeArray[$mill->group][$mill->slug] = [
                    'weeklyReportSlug' => null,
                    'newform1' => [],
                ];
            }
        }

        //populate slugs
        $wrs = WeeklyReports::query()
            ->with('sugarMill')
            ->select('slug','mill_code')
            ->where('status','=',1)
            ->where('report_no','=',$report_no)
            ->where('crop_year','=',$crop_year)
            ->get();
        if(!empty($wrs)){
            foreach ($wrs as $wr){
                $comparativeArray[$wr->sugarMill->group][$wr->sugarMill->slug]['weeklyReportSlug'] = $wr->slug;
                $comparativeArray[$wr->sugarMill->group][$wr->sugarMill->slug]['newform1'] = [
                    'thisWeek' => $this->weeklyReportService->computation($wr->slug,'',$report_no),
                    'prevToDate' => $this->weeklyReportService->computation($wr->slug,'toDate',$report_no - 1),
                    'toDate' => $this->weeklyReportService->computation($wr->slug,'toDate',$report_no),
                ];
            }
        }
//        dd($weeklyReportsArray);
        return view('sms.printables.comparative.raw1')->with([
            'comparativeArray' => $comparativeArray,
//            ADD HERE RECAP ---------------
            'weeklyReportsArray' => $weeklyReportsArray
//            ADD END ------------------
        ]);

    }

    public function molPWS(Request $request, GetForm3Controller $getForm3Controller){
        $report_no = $request->report_no * 1;
        $crop_year = $request->crop_year;

        $comparativeArray = [];

        //        CODE START RECAP ------------------
        $weeklyreports = WeeklyReports::query()
            ->where("report_no","=", 4)
            ->where("status","=", 1)
            ->get();

        $submittedReports = $weeklyreports->mapWithKeys(function ($weeklyreport){
            return [
                $weeklyreport->mill_code=>$weeklyreport
            ];
        });
        $weeklyReportsArray = [];
        foreach($submittedReports as $mill_code=>$submittedReport)
        {
            $weeklyReportsArray[$mill_code] = $getForm3Controller->getForm3($submittedReport->slug, false);
        }
//        dd($submittedReports);
//        CODE END --------------------------

        $mills = SugarMills::query()->get();
        if(!empty($mills)){
            foreach ($mills as $mill){
                $comparativeArray[$mill->group][$mill->slug] = [
                    'weeklyReportSlug' => null,
                    'form3' => [],
                ];
            }
        }
        //populate slugs
        $wrs = WeeklyReports::query()
            ->with('sugarMill')
            ->select('slug','mill_code')
            ->where('status','=',1)
            ->where('report_no','=',$report_no)
            ->where('crop_year','=',$crop_year)
            ->get();
        if(!empty($wrs)){
            foreach ($wrs as $wr){
                $comparativeArray[$wr->sugarMill->group][$wr->sugarMill->slug]['weeklyReportSlug'] = $wr->slug;
                $comparativeArray[$wr->sugarMill->group][$wr->sugarMill->slug]['form3'] = [
                    'thisWeek' => $this->weeklyReportService->form3Computation($wr->slug,'',$report_no),
                    'prevToDate' => $this->weeklyReportService->form3Computation($wr->slug,'toDate',$report_no - 1),
                    'toDate' => $this->weeklyReportService->form3Computation($wr->slug,'toDate',$report_no),
                ];
            }
        }
//                dd($weeklyReportsArray["TEST"]);
        return view(    'sms.printables.comparative.molPWS')->with([
            'millsArray' => $comparativeArray,
            'weeklyReportsArray' => $weeklyReportsArray
        ]);
    }

    public function refPWS(Request $request, GetForm2Controller $getForm2Controller){
        $report_no = $request->report_no * 1;
        $crop_year = $request->crop_year;

        $comparativeArray = [];


        //        CODE START RECAP ------------------
//        $weeklyreports = WeeklyReports::query()
//            ->where("report_no","=", 4)
//            ->where("status","=", 1)
//            ->get();

        $weeklyreports = WeeklyReports::query()
            ->join("sugar_mills", "weekly_reports.mill_code", "=", "sugar_mills.slug")
            ->where("weekly_reports.report_no", 4)
            ->where("weekly_reports.status", 1)
            ->where("sugar_mills.has_refinery", 1)
            ->select("weekly_reports.*") // make sure to select correct columns
            ->get();


        $submittedReports = $weeklyreports->mapWithKeys(function ($weeklyreport){
            return [
                $weeklyreport->mill_code=>$weeklyreport
            ];
        });
        $weeklyReportsArray = [];
        foreach($submittedReports as $mill_code=>$submittedReport)
        {
            $weeklyReportsArray[$mill_code] = $getForm2Controller->getForm2($submittedReport->slug, false);
        }
//        dd($submittedReports);
//        CODE END --------------------------

        $mills = SugarMills::query()
            ->where('has_refinery','=',1)
            ->get();
        if(!empty($mills)){
            foreach ($mills as $mill){
                $comparativeArray[$mill->group][$mill->slug] = [
                    'weeklyReportSlug' => null,
                    'form2' => [],
                ];
            }
        }

        //populate slugs
        $wrs = WeeklyReports::query()
            ->with('sugarMill')
            ->select('slug','mill_code')
            ->where('status','=',1)
            ->where('report_no','=',$report_no)
            ->where('crop_year','=',$crop_year)
            ->whereHas('sugarMill',function ($query){
                return $query->where('has_refinery','=',1);
            })
            ->get();
        if(!empty($wrs)){
            foreach ($wrs as $wr){
                $comparativeArray[$wr->sugarMill->group][$wr->sugarMill->slug]['weeklyReportSlug'] = $wr->slug;
                $comparativeArray[$wr->sugarMill->group][$wr->sugarMill->slug]['form2'] = [
                    'thisWeek' => $this->weeklyReportService->form2Computation($wr->slug,'',$report_no),
                    'prevToDate' => $this->weeklyReportService->form2Computation($wr->slug,'toDate',$report_no - 1),
                    'toDate' => $this->weeklyReportService->form2Computation($wr->slug,'toDate',$report_no),
                ];
            }
        }

//        dd($weeklyReportsArray);
        return view('sms.printables.comparative.refPWS')->with([
            'millsArray' => $comparativeArray,
            //ADD HERE RECAP ---------------
            'weeklyReportsArray' => $weeklyReportsArray
            //ADD END ------------------
        ]);
    }

    public function gtcm(Request $request, GetForm1Controller $getForm1Controller){
        $report_no = $request->report_no * 1;
        $crop_year = $request->crop_year;

        $comparativeArray = [];

        //        CODE START RECAP ------------------
        $weeklyreports = WeeklyReports::query()
            ->where("report_no","=", 4)
            ->where("status","=", 1)
            ->get();

        $submittedReports = $weeklyreports->mapWithKeys(function ($weeklyreport){
            return [
                $weeklyreport->mill_code=>$weeklyreport
            ];
        });
        $weeklyReportsArray = [];
        foreach($submittedReports as $mill_code=>$submittedReport)
        {
            $weeklyReportsArray[$mill_code] = $getForm1Controller->getForm1($submittedReport->slug, false);
        }
//        dd($submittedReports);
//        CODE END --------------------------

        $mills = SugarMills::query()
            ->get();
        if(!empty($mills)){
            foreach ($mills as $mill){
                $comparativeArray[$mill->group][$mill->slug] = [
                    'weeklyReportSlug' => null,
                    'form1' => [],
                ];
            }
        }

        //populate slugs
        $wrs = WeeklyReports::query()
            ->with('sugarMill')
            ->select('slug','mill_code')
            ->where('status','=',1)
            ->where('report_no','=',$report_no)
            ->where('crop_year','=',$crop_year)
            ->get();
        if(!empty($wrs)){
            foreach ($wrs as $wr){
                $comparativeArray[$wr->sugarMill->group][$wr->sugarMill->slug]['weeklyReportSlug'] = $wr->slug;
                $comparativeArray[$wr->sugarMill->group][$wr->sugarMill->slug]['form1'] = [
                    'thisWeek' => $this->weeklyReportService->computation($wr->slug,'',$report_no),
                    'prevToDate' => $this->weeklyReportService->computation($wr->slug,'toDate',$report_no - 1),
                    'toDate' => $this->weeklyReportService->computation($wr->slug,'toDate',$report_no),
                ];
            }
        }

//        dd($weeklyReportsArray);
        return view('sms.printables.comparative.gtcm')->with([
            'millsArray' => $comparativeArray,
            'weeklyReportsArray' => $weeklyReportsArray
        ]);
    }
}