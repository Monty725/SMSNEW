<?php


namespace App\Http\Controllers\SMS\WeeklyReport;


use App\Http\Controllers\Controller;
use App\Http\Requests\SMS\Form1Request;
use App\Models\SMS\Form1\Form1Details;
use App\Models\SMS\SeriesNos;
use App\Models\SMS\WeeklyReportDetails;
use App\Models\SMS\WeeklyReports;
use App\Models\SMS\WeeklyReportSeriesPcs;
use App\SMS\Services\WeeklyReportService;
use App\Swep\Helpers\Arrays;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Form1Controller extends Controller
{
    protected  $weeklyReportService;
    public function __construct(WeeklyReportService $weeklyReportService)
    {
        $this->weeklyReportService = $weeklyReportService;
    }

    public function store(Request $request){
        $wr = $this->weeklyReportService->findWeeklyReportBySlug($request->wr);
        $lkgtc_gross = null;
        $lkgtc_net = null;
        $lkgtc_gross_syrup = null;
        if($request->gtcm != 0) {
            $lkgtc_gross = Helper::sanitizeAutonum($request->tdc) * 20 / Helper::sanitizeAutonum($request->gtcm);
        }

        //NTCM FORMULA 11-15-2024
        if($request->ntcm != 0) {
            $lkgtc_net = Helper::sanitizeAutonum($request->tdc) * 20 / Helper::sanitizeAutonum($request->ntcm);
        }

        if($request->egtcm != 0) {
            $lkgtc_gross_syrup = Helper::sanitizeAutonum($request->tds) * 20 / Helper::sanitizeAutonum($request->egtcm);
        }


        $toUpdate = [
            'manufactured' => Helper::sanitizeAutonum($request->manufactured),
            'transfers_to_refinery' => Helper::sanitizeAutonum($request->transfers_to_refinery),
            'prev_transfers_to_refinery' => Helper::sanitizeAutonum($request->prev_transfers_to_refinery),
            'form1_prev_unquedanned' => Helper::sanitizeAutonum($request->form1_prev_unquedanned),
            'form1_unquedanned' => Helper::sanitizeAutonum($request->form1_unquedanned),
            'prev_manufactured' => Helper::sanitizeAutonum($request->prev_manufactured),
            'tdc' => !empty($request->tdc) ? Helper::sanitizeAutonum($request->tdc) : null,
            'gtcm' => !empty($request->gtcm) ? Helper::sanitizeAutonum($request->gtcm) : null,
            'ntcm' => !empty($request->ntcm) ? Helper::sanitizeAutonum($request->ntcm) : null,
//                    'lkgtc_gross' => !empty($request->lkgtcGross) ? Helper::sanitizeAutonum($request->lkgtcGross) : null,

            //OLD LKGTC_GROSS FORMULA 11-15-2024
//                  'lkgtc_gross' => number_format($lkgtc_gross,2),

            //NEW LKGTC_GROSS AND NET FORMULA 11-15-2024
            'lkgtc_gross' => number_format($lkgtc_gross,3),
            'lkgtc_net' => number_format($lkgtc_net,3),

            'tds' => !empty($request->tds) ? Helper::sanitizeAutonum($request->tds) : null,
            'egtcm' => !empty($request->egtcm) ? Helper::sanitizeAutonum($request->egtcm) : null,
//                    'lkgtc_gross_syrup' => !empty($request->lkgtc_gross_syrup) ? Helper::sanitizeAutonum($request->lkgtc_gross_syrup) : null,
            'lkgtc_gross_syrup' => number_format($lkgtc_gross_syrup,2),
            'share_planter' => !empty($request->sharePlanter) ? Helper::sanitizeAutonum($request->sharePlanter) : null,
            'share_miller' => !empty($request->shareMiller) ? Helper::sanitizeAutonum($request->shareMiller) : null,
            'price_A' => !empty($request->priceA) ? Helper::sanitizeAutonum($request->priceA) : null,
            'price_B' => !empty($request->priceB) ? Helper::sanitizeAutonum($request->priceB) : null,
            'price_C' => !empty($request->priceC) ? Helper::sanitizeAutonum($request->priceC) : null,
            'price_C1' => !empty($request->priceC1) ? Helper::sanitizeAutonum($request->priceC1) : null,
            'price_D' => !empty($request->priceD) ? Helper::sanitizeAutonum($request->priceD) : null,
            'price_DX' => !empty($request->priceDX) ? Helper::sanitizeAutonum($request->priceDX) : null,
            'price_DE' => !empty($request->priceDE) ? Helper::sanitizeAutonum($request->priceDE) : null,
            'price_DR' => !empty($request->priceDR) ? Helper::sanitizeAutonum($request->priceDR) : null,
            'wholesale_raw' => !empty($request->wholesaleRaw) ? Helper::sanitizeAutonum($request->wholesaleRaw) : null,
            'wholesale_refined' => !empty($request->wholesaleRefined) ? Helper::sanitizeAutonum($request->wholesaleRefined) : null,
            'retail_raw' => !empty($request->retailRaw) ? Helper::sanitizeAutonum($request->retailRaw) : null,
            'retail_refined' => !empty($request->retailRefined) ? Helper::sanitizeAutonum($request->retailRefined) : null,
            'dist_factor' => !empty($request->distFactor) ? Helper::sanitizeAutonum($request->distFactor) : null,
            'remarks' => !empty($request->remarks) ? Helper::sanitizeAutonum($request->remarks) : null,

        ];

        foreach (Arrays::sugarClasses() as $sugarClass) {
            $toUpdate[$sugarClass] = null;
            $toUpdate['prev_'.$sugarClass] = null;
        }
        $arr = [];
        if(!empty($request->seriesNos)){
            foreach ($request->seriesNos['sugarClass'] as $key => $value){
                if($value != null){
                    array_push($arr,[
                        'slug' => Str::random(),
                        'weekly_report_slug' => $request->wr,
                        'sugarClass' => $value,
                        'seriesFrom' => $request->seriesNos['seriesFrom'][$key],
                        'seriesTo' => $request->seriesNos['seriesTo'][$key],
                        'noOfPcs' => $request->seriesNos['seriesTo'][$key] - $request->seriesNos['seriesFrom'][$key] + 1,
                        'type' => 'RAW',
                    ]);
                }
            }
        }
        $wr->rawSeriesNos()->delete();
        if(count($arr) > 0){
            SeriesNos::insert($arr);
        }

        if(!empty($request->issuances)){
            foreach ($request->issuances['sugarClasses'] as $key => $value){
                if(!empty($value)){
                    $toUpdate[$value] = !empty($request->issuances['currentValues'][$key]) ? Helper::sanitizeAutonum($request->issuances['currentValues'][$key]) : null;
                    $toUpdate['prev_'.$value] = !empty($request->issuances['prevValues'][$key]) ? Helper::sanitizeAutonum($request->issuances['prevValues'][$key]) : null;
                }
            }
        }
        Form1Details::updateOrCreate(
            ['weekly_report_slug' => $request->wr],
            $toUpdate
        );

        return true;

        if($request->type != 'updateOnly'){
            $wr = $this->weeklyReportService->findWeeklyReportBySlug($request->wr);
            $lkgtc_gross = null;
            $lkgtc_net = null;
            $lkgtc_gross_syrup = null;
            if($request->gtcm != 0) {
                $lkgtc_gross = Helper::sanitizeAutonum($request->tdc) * 20 / Helper::sanitizeAutonum($request->gtcm);
            }

            //NTCM FORMULA 11-15-2024
            if($request->ntcm != 0) {
                $lkgtc_net = Helper::sanitizeAutonum($request->tdc) * 20 / Helper::sanitizeAutonum($request->ntcm);
            }

            if($request->egtcm != 0) {
                $lkgtc_gross_syrup = Helper::sanitizeAutonum($request->tds) * 20 / Helper::sanitizeAutonum($request->egtcm);
            }


            $toUpdate = [
                'manufactured' => Helper::sanitizeAutonum($request->manufactured),
                'transfers_to_refinery' => Helper::sanitizeAutonum($request->transfers_to_refinery),
                'prev_transfers_to_refinery' => Helper::sanitizeAutonum($request->prev_transfers_to_refinery),
                'prev_manufactured' => Helper::sanitizeAutonum($request->prev_manufactured),
                    'tdc' => !empty($request->tdc) ? Helper::sanitizeAutonum($request->tdc) : null,
                    'gtcm' => !empty($request->gtcm) ? Helper::sanitizeAutonum($request->gtcm) : null,
                    'ntcm' => !empty($request->ntcm) ? Helper::sanitizeAutonum($request->ntcm) : null,
//                    'lkgtc_gross' => !empty($request->lkgtcGross) ? Helper::sanitizeAutonum($request->lkgtcGross) : null,

                    //OLD LKGTC_GROSS FORMULA 11-15-2024
//                  'lkgtc_gross' => number_format($lkgtc_gross,2),

                    //NEW LKGTC_GROSS AND NET FORMULA 11-15-2024
                    'lkgtc_gross' => number_format($lkgtc_gross,3),
                    'lkgtc_net' => number_format($lkgtc_net,3),

                    'tds' => !empty($request->tds) ? Helper::sanitizeAutonum($request->tds) : null,
                    'egtcm' => !empty($request->egtcm) ? Helper::sanitizeAutonum($request->egtcm) : null,
//                    'lkgtc_gross_syrup' => !empty($request->lkgtc_gross_syrup) ? Helper::sanitizeAutonum($request->lkgtc_gross_syrup) : null,
                    'lkgtc_gross_syrup' => number_format($lkgtc_gross_syrup,2),
                    'share_planter' => !empty($request->sharePlanter) ? Helper::sanitizeAutonum($request->sharePlanter) : null,
                    'share_miller' => !empty($request->shareMiller) ? Helper::sanitizeAutonum($request->shareMiller) : null,
                    'price_A' => !empty($request->priceA) ? Helper::sanitizeAutonum($request->priceA) : null,
                    'price_B' => !empty($request->priceB) ? Helper::sanitizeAutonum($request->priceB) : null,
                    'price_C' => !empty($request->priceC) ? Helper::sanitizeAutonum($request->priceC) : null,
                    'price_C1' => !empty($request->priceC1) ? Helper::sanitizeAutonum($request->priceC1) : null,
                    'price_D' => !empty($request->priceD) ? Helper::sanitizeAutonum($request->priceD) : null,
                    'price_DX' => !empty($request->priceDX) ? Helper::sanitizeAutonum($request->priceDX) : null,
                    'price_DE' => !empty($request->priceDE) ? Helper::sanitizeAutonum($request->priceDE) : null,
                    'price_DR' => !empty($request->priceDR) ? Helper::sanitizeAutonum($request->priceDR) : null,
                    'wholesale_raw' => !empty($request->wholesaleRaw) ? Helper::sanitizeAutonum($request->wholesaleRaw) : null,
                    'wholesale_refined' => !empty($request->wholesaleRefined) ? Helper::sanitizeAutonum($request->wholesaleRefined) : null,
                    'retail_raw' => !empty($request->retailRaw) ? Helper::sanitizeAutonum($request->retailRaw) : null,
                    'retail_refined' => !empty($request->retailRefined) ? Helper::sanitizeAutonum($request->retailRefined) : null,
                    'dist_factor' => !empty($request->distFactor) ? Helper::sanitizeAutonum($request->distFactor) : null,
                    'remarks' => !empty($request->remarks) ? Helper::sanitizeAutonum($request->remarks) : null,

            ];

            foreach (Arrays::sugarClasses() as $sugarClass) {
                $toUpdate[$sugarClass] = null;
                $toUpdate['prev_'.$sugarClass] = null;
            }
            $arr = [];
            if(!empty($request->seriesNos)){
                foreach ($request->seriesNos['sugarClass'] as $key => $value){
                    if($value != null){
                        array_push($arr,[
                            'slug' => Str::random(),
                            'weekly_report_slug' => $request->wr,
                            'sugarClass' => $value,
                            'seriesFrom' => $request->seriesNos['seriesFrom'][$key],
                            'seriesTo' => $request->seriesNos['seriesTo'][$key],
                            'noOfPcs' => $request->seriesNos['seriesTo'][$key] - $request->seriesNos['seriesFrom'][$key] + 1,
                            'type' => 'RAW',
                        ]);
                    }
                }
            }
            $wr->rawSeriesNos()->delete();
            if(count($arr) > 0){
                SeriesNos::insert($arr);
            }

            if(!empty($request->issuances)){
                foreach ($request->issuances['sugarClasses'] as $key => $value){
                    if(!empty($value)){
                        $toUpdate[$value] = !empty($request->issuances['currentValues'][$key]) ? Helper::sanitizeAutonum($request->issuances['currentValues'][$key]) : null;
                        $toUpdate['prev_'.$value] = !empty($request->issuances['prevValues'][$key]) ? Helper::sanitizeAutonum($request->issuances['prevValues'][$key]) : null;
                    }
                }
            }
            Form1Details::updateOrCreate(
                ['weekly_report_slug' => $request->wr],
                $toUpdate
            );
        }
        return $this->weeklyReportService->computation($request->wr);
    }
    public function findWeeklyReportBySlug($slug){
        $wr = WeeklyReports::query()->where('slug','=',$slug)->first();
        if(empty($wr)){
            abort(503,'Weekly Report not found.');
        }
        return $wr;
    }
}