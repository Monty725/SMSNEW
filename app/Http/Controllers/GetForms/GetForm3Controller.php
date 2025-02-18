<?php

namespace App\Http\Controllers\GetForms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SMS\Form3b\IssuancesOfMro;
use App\Models\SMS\Form3b\Deliveries;

class GetForm3Controller extends Controller
{
    public function getForm3($slug){
        $weeklyReport = \App\Models\SMS\WeeklyReports::query()->where("slug","=",$slug)->first();
        $currentReportNo = $weeklyReport->report_no * 1;
        $arr=[];
        $arrayContent = [
            "currentCrop"=>[
                "thisWeek"=>[],
                "prevWeek"=>[],
                "toDate"=>[],
            ],
            "prevCrop"=>[
                "thisWeek"=>[],
                "prevWeek"=>[],
                "toDate"=>[],
            ],
        ];

        $thisWeek = $weeklyReport->form3;
        $prevWeek = $weeklyReport->form3ToDateAsOf($currentReportNo-1);
        $toDate = $weeklyReport->form3ToDateAsOf($currentReportNo);

        $withRawDomCTotalThisWeek = 0.000;
        $withRawDomPTotalThisWeek = 0.000;
        $withRawOtherCTotalThisWeek = 0.000;
        $withRawOtherPTotalThisWeek = 0.000;
        $withRawExportCTotalThisWeek = 0.000;
        $withRawExportPTotalThisWeek = 0.000;
        $withRawDistCTotalThisWeek = 0.000;
        $withRawDistPTotalThisWeek = 0.000;
        $withRefinedDomCTotalThisWeek = 0.000;
        $withRefinedDomPTotalThisWeek = 0.000;
        $withRefinedDistCTotalThisWeek = 0.000;
        $withRefinedDistPTotalThisWeek = 0.000;
        $withRefinedOtherCTotalThisWeek = number_format(0.000, 3, '.', ',');
        $withRefinedOtherPTotalThisWeek = number_format(0.000, 3, '.', ',');
        $withRefinedExportCTotalThisWeek = number_format(0.000, 3, '.', ',');
        $withRefinedExportPTotalThisWeek = number_format(0.000, 3, '.', ',');

        $withRawDomCTotalprevWeek = number_format(0.000, 3, '.', ',');
        $withRawDomPTotalprevWeek = 0.000;
        $withRawDistCTotalprevWeek = 0.000;
        $withRawDistPTotalprevWeek = 0.000;
        $withRawOtherCTotalprevWeek = 0.000;
        $withRawOtherPTotalprevWeek = 0.000;
        $withRawExportCTotalprevWeek = 0.000;
        $withRawExportPTotalprevWeek = 0.000;
        $withRefinedDomCTotalprevWeek = 0.000;
        $withRefinedDomPTotalprevWeek = 0.000;
        $withRefinedDistCTotalprevWeek = 0.000;
        $withRefinedDistPTotalprevWeek = 0.000;
        $withRefinedOtherCTotalprevWeek = number_format(0.000, 3, '.', ',');
        $withRefinedOtherPTotalprevWeek = number_format(0.000, 3, '.', ',');
        $withRefinedExportCTotalprevWeek = number_format(0.000, 3, '.', ',');
        $withRefinedExportPTotalprevWeek = number_format(0.000, 3, '.', ',');

        $withRawDomCTotaltoDate = 0.000;
        $withRawDomPTotaltoDate = 0.000;
        $withRawDistCTotaltoDate = 0.000;
        $withRawDistPTotaltoDate = 0.000;
        $withRawOtherCTotaltoDate = 0.000;
        $withRawOtherPTotaltoDate = 0.000;
        $withRawExportCTotaltoDate = 0.000;
        $withRawExportPTotaltoDate = 0.000;
        $withRefinedDomCTotaltoDate = 0.000;
        $withRefinedDomPTotaltoDate = 0.000;
        $withRefinedDistCTotaltoDate = 0.000;
        $withRefinedDistPTotaltoDate = 0.000;
        $withRefinedOtherCTotaltoDate = number_format(0.000, 3, '.', ',');
        $withRefinedOtherPTotaltoDate = number_format(0.000, 3, '.', ',');
        $withRefinedExportCTotaltoDate = number_format(0.000, 3, '.', ',');
        $withRefinedExportPTotaltoDate = number_format(0.000, 3, '.', ',');

        $arr["withRefinedDomestic"]["currentCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDomestic"]["prevCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDistillery"]["currentCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDistillery"]["prevCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedOthers"]["currentCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedOthers"]["prevCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedExport"]["currentCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedExport"]["prevCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');

        $arr["withRefinedDomestic"]["currentCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDomestic"]["prevCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDistillery"]["currentCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDistillery"]["prevCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedOthers"]["currentCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedOthers"]["prevCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedExport"]["currentCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedExport"]["prevCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');

        $arr["withRefinedDomestic"]["currentCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDomestic"]["prevCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDistillery"]["currentCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDistillery"]["prevCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedOthers"]["currentCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedOthers"]["prevCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedExport"]["currentCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedExport"]["prevCrop"]["toDate"] = number_format(0.000, 3, '.', ',');

        $arr["withRawDomestic"]["currentCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRawDomestic"]["prevCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRawDistillery"]["currentCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRawDistillery"]["prevCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRawOthers"]["currentCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRawOthers"]["prevCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRawExport"]["currentCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRawExport"]["prevCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');

        $arr["withRawDomestic"]["currentCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRawDomestic"]["prevCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRawDistillery"]["currentCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRawDistillery"]["prevCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRawOthers"]["currentCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRawOthers"]["prevCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRawExport"]["currentCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRawExport"]["prevCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');

        $arr["withRawDomestic"]["currentCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRawDomestic"]["prevCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRawDistillery"]["currentCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRawDistillery"]["prevCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRawOthers"]["currentCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRawOthers"]["prevCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRawExport"]["currentCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRawExport"]["prevCrop"]["toDate"] = number_format(0.000, 3, '.', ',');

//        number_format($thisWeek->manufacturedRaw, 3, '.', ',')
        //WITHDRAWALS COMPUTATION --------------------------------------------------------- START
        //GET THIS WEEK VALUES FOR WITHDRAWALS
        $deliveries = $weeklyReport->form3bDeliveries()
            ->selectRaw('sugar_type, withdrawal_type, sum(qty_current) as currentTotal, sum(qty_prev) as prevTotal')
            ->groupBy('sugar_type', 'withdrawal_type')
            ->get();

        //WITHDRAWALS THIS WEEK
        foreach ($deliveries as $delivery){
            if($delivery->sugar_type == "RAW"){
                    if ($delivery->withdrawal_type == "DOMESTIC") {
                        $arr["withRawDomestic"]["currentCrop"]["thisWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                        $arr["withRawDomestic"]["prevCrop"]["thisWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                        $withRawDomCTotalThisWeek += floatval(str_replace(',', '', $arr["withRawDomestic"]["currentCrop"]["thisWeek"]));
                        $withRawDomPTotalThisWeek += floatval(str_replace(',', '', $arr["withRawDomestic"]["prevCrop"]["thisWeek"]));
                    } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                        $arr["withRawDistillery"]["currentCrop"]["thisWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                        $arr["withRawDistillery"]["prevCrop"]["thisWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                        $withRawDistCTotalThisWeek += floatval(str_replace(',', '', $arr["withRawDistillery"]["currentCrop"]["thisWeek"]));
                        $withRawDistPTotalThisWeek += floatval(str_replace(',', '', $arr["withRawDistillery"]["prevCrop"]["thisWeek"]));
                    }
                    if ($delivery->withdrawal_type == "OTHERS") {
                        $arr["withRawOthers"]["currentCrop"]["thisWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                        $arr["withRawOthers"]["prevCrop"]["thisWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                        $withRawOtherCTotalThisWeek += floatval(str_replace(',', '', $arr["withRawOthers"]["currentCrop"]["thisWeek"]));
                        $withRawOtherPTotalThisWeek += floatval(str_replace(',', '', $arr["withRawOthers"]["prevCrop"]["thisWeek"]));
                    } elseif ($delivery->withdrawal_type == "EXPORT") {
                        $arr["withRawExport"]["currentCrop"]["thisWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                        $arr["withRawExport"]["prevCrop"]["thisWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                        $withRawExportCTotalThisWeek += floatval(str_replace(',', '', $arr["withRawExport"]["currentCrop"]["thisWeek"]));
                        $withRawExportPTotalThisWeek += floatval(str_replace(',', '', $arr["withRawExport"]["prevCrop"]["thisWeek"]));
                    }
            }elseif($delivery->sugar_type == "REFINED"){
                    if ($delivery->withdrawal_type == "DOMESTIC") {
                        $arr["withRefinedDomestic"]["currentCrop"]["thisWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                        $arr["withRefinedDomestic"]["prevCrop"]["thisWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                        $withRefinedDomCTotalThisWeek += floatval(str_replace(',', '', $arr["withRefinedDomestic"]["currentCrop"]["thisWeek"]));
                        $withRefinedDomPTotalThisWeek += floatval(str_replace(',', '', $arr["withRefinedDomestic"]["prevCrop"]["thisWeek"]));
                    } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                        $arr["withRefinedDistillery"]["currentCrop"]["thisWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                        $arr["withRefinedDistillery"]["prevCrop"]["thisWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                        $withRefinedDistCTotalThisWeek += floatval(str_replace(',', '', $arr["withRefinedDistillery"]["currentCrop"]["thisWeek"]));
                        $withRefinedDistPTotalThisWeek += floatval(str_replace(',', '', $arr["withRefinedDistillery"]["prevCrop"]["thisWeek"]));
                    }
                    if ($delivery->withdrawal_type == "OTHERS") {
                        $arr["withRefinedOthers"]["currentCrop"]["thisWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                        $arr["withRefinedOthers"]["prevCrop"]["thisWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                        $withRefinedOtherCTotalThisWeek += floatval(str_replace(',', '', $arr["withRefinedOthers"]["currentCrop"]["thisWeek"]));
                        $withRefinedOtherPTotalThisWeek += floatval(str_replace(',', '', $arr["withRefinedOthers"]["prevCrop"]["thisWeek"]));
                    } elseif ($delivery->withdrawal_type == "EXPORT") {
                        $arr["withRefinedExport"]["currentCrop"]["thisWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                        $arr["withRefinedExport"]["prevCrop"]["thisWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                        $withRefinedExportCTotalThisWeek += floatval(str_replace(',', '', $arr["withRefinedExport"]["currentCrop"]["thisWeek"]));
                        $withRefinedExportPTotalThisWeek += floatval(str_replace(',', '', $arr["withRefinedExport"]["prevCrop"]["thisWeek"]));
                    }
            }
        }

        //WITHDRAWAL PREVIOUS
        //GET PREVIOUS WEEK VALUES FOR WITHDRAWALS
        $deliveries = $this->getDeliveriesAsOf($currentReportNo * 1 - 1,$weeklyReport);
        foreach ($deliveries as $delivery){
            if($delivery->sugar_type == "RAW"){
                if ($delivery->withdrawal_type == "DOMESTIC") {
                    $arr["withRawDomestic"]["currentCrop"]["prevWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRawDomestic"]["prevCrop"]["prevWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRawDomCTotalprevWeek += floatval(str_replace(',', '', $arr["withRawDomestic"]["currentCrop"]["prevWeek"]));
                    $withRawDomPTotalprevWeek += floatval(str_replace(',', '', $arr["withRawDomestic"]["prevCrop"]["prevWeek"]));
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRawDistillery"]["currentCrop"]["prevWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRawDistillery"]["prevCrop"]["prevWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRawDistCTotalprevWeek += floatval(str_replace(',', '', $arr["withRawDistillery"]["currentCrop"]["prevWeek"]));
                    $withRawDistPTotalprevWeek += floatval(str_replace(',', '', $arr["withRawDistillery"]["prevCrop"]["prevWeek"]));
                }
                if ($delivery->withdrawal_type == "OTHERS") {
                    $arr["withRawOthers"]["currentCrop"]["prevWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRawOthers"]["prevCrop"]["prevWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRawOtherCTotalprevWeek += floatval(str_replace(',', '', $arr["withRawOthers"]["currentCrop"]["prevWeek"]));
                    $withRawOtherPTotalprevWeek += floatval(str_replace(',', '', $arr["withRawOthers"]["prevCrop"]["prevWeek"]));
                } elseif ($delivery->withdrawal_type == "EXPORT") {
                    $arr["withRawExport"]["currentCrop"]["prevWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRawExport"]["prevCrop"]["prevWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRawExportCTotalprevWeek += floatval(str_replace(',', '', $arr["withRawExport"]["currentCrop"]["prevWeek"]));
                    $withRawExportPTotalprevWeek += floatval(str_replace(',', '', $arr["withRawExport"]["prevCrop"]["prevWeek"]));
                }
            }elseif($delivery->sugar_type == "REFINED"){
                if ($delivery->withdrawal_type == "DOMESTIC") {
                    $arr["withRefinedDomestic"]["currentCrop"]["prevWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRefinedDomestic"]["prevCrop"]["prevWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRefinedDomCTotalprevWeek += floatval(str_replace(',', '', $arr["withRefinedDomestic"]["currentCrop"]["prevWeek"]));
                    $withRefinedDomPTotalprevWeek += floatval(str_replace(',', '', $arr["withRefinedDomestic"]["prevCrop"]["prevWeek"]));
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRefinedDistillery"]["currentCrop"]["prevWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRefinedDistillery"]["prevCrop"]["prevWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRefinedDistCTotalprevWeek += floatval(str_replace(',', '', $arr["withRefinedDistillery"]["currentCrop"]["prevWeek"]));
                    $withRefinedDistPTotalprevWeek += floatval(str_replace(',', '', $arr["withRefinedDistillery"]["prevCrop"]["prevWeek"]));
                }
                if ($delivery->withdrawal_type == "OTHERS") {
                    $arr["withRefinedOthers"]["currentCrop"]["prevWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRefinedOthers"]["prevCrop"]["prevWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRefinedOtherCTotalprevWeek += floatval(str_replace(',', '', $arr["withRefinedOthers"]["currentCrop"]["prevWeek"]));
                    $withRefinedOtherPTotalprevWeek += floatval(str_replace(',', '', $arr["withRefinedOthers"]["prevCrop"]["prevWeek"]));
                } elseif ($delivery->withdrawal_type == "EXPORT") {
                    $arr["withRefinedExport"]["currentCrop"]["prevWeek"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRefinedExport"]["prevCrop"]["prevWeek"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRefinedExportCTotalprevWeek += floatval(str_replace(',', '', $arr["withRefinedExport"]["currentCrop"]["prevWeek"]));
                    $withRefinedExportPTotalprevWeek += floatval(str_replace(',', '', $arr["withRefinedExport"]["prevCrop"]["prevWeek"]));
                }
            }
        }

        //WITHDRAWAL TO DATE
        //GET TO DATE VALUES FOR WITHDRAWALS
        $deliveries = $this->getDeliveriesAsOf($currentReportNo,$weeklyReport);
        foreach ($deliveries as $delivery){
            if($delivery->sugar_type == "RAW"){
                if ($delivery->withdrawal_type == "DOMESTIC") {
                    $arr["withRawDomestic"]["currentCrop"]["toDate"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRawDomestic"]["prevCrop"]["toDate"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRawDomCTotaltoDate += floatval(str_replace(',', '', $arr["withRawDomestic"]["currentCrop"]["toDate"]));
                    $withRawDomPTotaltoDate += floatval(str_replace(',', '', $arr["withRawDomestic"]["prevCrop"]["toDate"]));
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRawDistillery"]["currentCrop"]["toDate"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRawDistillery"]["prevCrop"]["toDate"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRawDistCTotaltoDate += floatval(str_replace(',', '', $arr["withRawDistillery"]["currentCrop"]["toDate"]));
                    $withRawDistPTotaltoDate += floatval(str_replace(',', '', $arr["withRawDistillery"]["prevCrop"]["toDate"]));
                }
                if ($delivery->withdrawal_type == "OTHERS") {
                    $arr["withRawOthers"]["currentCrop"]["toDate"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRawOthers"]["prevCrop"]["toDate"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRawOtherCTotaltoDate += floatval(str_replace(',', '', $arr["withRawOthers"]["currentCrop"]["toDate"]));
                    $withRawOtherPTotaltoDate += floatval(str_replace(',', '', $arr["withRawOthers"]["prevCrop"]["toDate"]));
                } elseif ($delivery->withdrawal_type == "EXPORT") {
                    $arr["withRawExport"]["currentCrop"]["toDate"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRawExport"]["prevCrop"]["toDate"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRawExportCTotaltoDate += floatval(str_replace(',', '', $arr["withRawExport"]["currentCrop"]["toDate"]));
                    $withRawExportPTotaltoDate += floatval(str_replace(',', '', $arr["withRawExport"]["prevCrop"]["toDate"]));
                }
            }elseif($delivery->sugar_type == "REFINED"){
                if ($delivery->withdrawal_type == "DOMESTIC") {
                    $arr["withRefinedDomestic"]["currentCrop"]["toDate"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRefinedDomestic"]["prevCrop"]["toDate"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRefinedDomCTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedDomestic"]["currentCrop"]["toDate"]));
                    $withRefinedDomPTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedDomestic"]["prevCrop"]["toDate"]));
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRefinedDistillery"]["currentCrop"]["toDate"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRefinedDistillery"]["prevCrop"]["toDate"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRefinedDistCTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedDistillery"]["currentCrop"]["toDate"]));
                    $withRefinedDistPTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedDistillery"]["prevCrop"]["toDate"]));
                }
                if ($delivery->withdrawal_type == "OTHERS") {
                    $arr["withRefinedOthers"]["currentCrop"]["toDate"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRefinedOthers"]["prevCrop"]["toDate"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRefinedOtherCTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedOthers"]["currentCrop"]["toDate"]));
                    $withRefinedOtherPTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedOthers"]["prevCrop"]["toDate"]));
                } elseif ($delivery->withdrawal_type == "EXPORT") {
                    $arr["withRefinedExport"]["currentCrop"]["toDate"] = number_format($delivery->currentTotal ?? 0.000, 3, '.', ',');
                    $arr["withRefinedExport"]["prevCrop"]["toDate"] = number_format($delivery->prevTotal ?? 0.000, 3, '.', ',');
                    $withRefinedExportCTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedExport"]["currentCrop"]["toDate"]));
                    $withRefinedExportPTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedExport"]["prevCrop"]["toDate"]));
                }
            }
        }

        //RAW WITHDRAWALS TOTAL
        $arr["totalRawWith"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format(($withRawDomCTotalThisWeek) + ($withRawDistCTotalThisWeek) + ($withRawOtherCTotalThisWeek) + ($withRawExportCTotalThisWeek), 3, '.', ','),
                "prevWeek"=>number_format(($withRawDomCTotalprevWeek) + ($withRawDistCTotalprevWeek) + ($withRawOtherCTotalprevWeek) + ($withRawExportCTotalprevWeek), 3, '.', ','),
                "toDate"=>number_format(($withRawDomCTotaltoDate) + ($withRawDistCTotaltoDate) + ($withRawOtherCTotaltoDate) + ($withRawExportCTotaltoDate), 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format(($withRawDomPTotalThisWeek) + ($withRawDistPTotalThisWeek) + ($withRawOtherPTotalThisWeek) + ($withRawExportPTotalThisWeek), 3, '.', ','),
                "prevWeek"=>number_format(($withRawDomPTotalprevWeek) + ($withRawDistPTotalprevWeek) + ($withRawOtherPTotalprevWeek) + ($withRawExportPTotalprevWeek), 3, '.', ','),
                "toDate"=>number_format(($withRawDomPTotaltoDate) + ($withRawDistPTotaltoDate) + ($withRawOtherPTotaltoDate) + ($withRawExportPTotaltoDate), 3, '.', ','),
            ],
        ];

        //REFINED WITHDRAWALS TOTAL
        $arr["totalRefinedWith"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format(($withRefinedDomCTotalThisWeek) + ($withRefinedDistCTotalThisWeek) + ($withRefinedOtherCTotalThisWeek) + ($withRefinedExportCTotalThisWeek), 3, '.', ','),
                "prevWeek"=>number_format(($withRefinedDomCTotalprevWeek) + ($withRefinedDistCTotalprevWeek) + ($withRefinedOtherCTotalprevWeek) + ($withRefinedExportCTotalprevWeek), 3, '.', ','),
                "toDate"=>number_format(($withRefinedDomCTotaltoDate) + ($withRefinedDistCTotaltoDate) + ($withRefinedOtherCTotaltoDate) + ($withRefinedExportCTotaltoDate), 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format(($withRefinedDomPTotalThisWeek) + ($withRefinedDistPTotalThisWeek) + ($withRefinedOtherPTotalThisWeek) + ($withRefinedExportPTotalThisWeek), 3, '.', ','),
                "prevWeek"=>number_format(($withRefinedDomPTotalprevWeek) + ($withRefinedDistPTotalprevWeek) + ($withRefinedOtherPTotalprevWeek) + ($withRefinedExportPTotalprevWeek), 3, '.', ','),
                "toDate"=>number_format(($withRefinedDomPTotaltoDate) + ($withRefinedDistPTotaltoDate) + ($withRefinedOtherPTotaltoDate) + ($withRefinedExportPTotaltoDate), 3, '.', ','),
            ],
        ];

        //OVERALL WITHDRAWALS TOTAL
        $arr["totalOverallWith"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format(($withRawDomCTotalThisWeek) + ($withRawDistCTotalThisWeek) + ($withRefinedDomCTotalThisWeek) + ($withRefinedDistCTotalThisWeek) + ($withRawOtherCTotalThisWeek) + ($withRawExportCTotalThisWeek) + ($withRefinedOtherCTotalThisWeek) + ($withRefinedExportCTotalThisWeek), 3, '.', ','),
                "prevWeek"=>number_format(($withRawDomCTotalprevWeek) + ($withRawDistCTotalprevWeek) + ($withRefinedDomCTotalprevWeek) + ($withRefinedDistCTotalprevWeek) + ($withRawOtherCTotalprevWeek) + ($withRawExportCTotalprevWeek) + ($withRefinedOtherCTotalprevWeek) + ($withRefinedExportCTotalprevWeek), 3, '.', ','),
                "toDate"=>number_format(($withRawDomCTotaltoDate) + ($withRawDistCTotaltoDate) + ($withRefinedDomCTotaltoDate) + ($withRefinedDistCTotaltoDate) + ($withRawOtherCTotaltoDate) + ($withRawExportCTotaltoDate) + ($withRefinedOtherCTotaltoDate) + ($withRefinedExportCTotaltoDate), 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format(($withRawDomPTotalThisWeek) + ($withRawDistPTotalThisWeek) + ($withRefinedDomPTotalThisWeek) + ($withRefinedDistPTotalThisWeek) + ($withRawOtherPTotalThisWeek) + ($withRawExportPTotalThisWeek) + ($withRefinedOtherPTotalThisWeek) + ($withRefinedExportPTotalThisWeek), 3, '.', ','),
                "prevWeek"=>number_format(($withRawDomPTotalprevWeek) + ($withRawDistPTotalprevWeek) + ($withRefinedDomPTotalprevWeek) + ($withRefinedDistPTotalprevWeek) + ($withRawOtherPTotalprevWeek) + ($withRawExportPTotalprevWeek) + ($withRefinedOtherPTotalprevWeek) + ($withRefinedExportPTotalprevWeek), 3, '.', ','),
                "toDate"=>number_format(($withRawDomPTotaltoDate) + ($withRawDistPTotaltoDate) + ($withRefinedDomPTotaltoDate) + ($withRefinedDistPTotaltoDate) + ($withRawOtherPTotaltoDate) + ($withRawExportPTotaltoDate) + ($withRefinedOtherPTotaltoDate) + ($withRefinedExportPTotaltoDate), 3, '.', ','),
            ],
        ];
        //WITHDRAWALS COMPUTATION --------------------------------------------------------- END

        //PRODUCTION MANUFACTURED RAW
        $arr["manufacturedRaw"]["currentCrop"]["thisWeek"]=number_format($thisWeek->manufacturedRaw, 3, '.', ',');
        $arr["manufacturedRaw"]["currentCrop"]["prevWeek"]=number_format($prevWeek->manufacturedRaw, 3, '.', ',');
        $arr["manufacturedRaw"]["currentCrop"]["toDate"]=number_format($toDate->manufacturedRaw, 3, '.', ',');
        $arr["manufacturedRaw"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_manufacturedRaw, 3, '.', ',');
        $arr["manufacturedRaw"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_manufacturedRaw, 3, '.', ',');
        $arr["manufacturedRaw"]["prevCrop"]["toDate"]=number_format($toDate->prev_manufacturedRaw, 3, '.', ',');

        //PRODUCTION RETENTION, ADJ, OVERAGES (RAO)
        $arr["rao"]["currentCrop"]["thisWeek"]=number_format($thisWeek->rao, 3, '.', ',');
        $arr["rao"]["currentCrop"]["prevWeek"]=number_format($prevWeek->rao, 3, '.', ',');
        $arr["rao"]["currentCrop"]["toDate"]=number_format($toDate->rao, 3, '.', ',');
        $arr["rao"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_rao, 3, '.', ',');
        $arr["rao"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_rao, 3, '.', ',');
        $arr["rao"]["prevCrop"]["toDate"]=number_format($toDate->prev_rao, 3, '.', ',');

        //PRODUCTION MANUFACTURED REFINED
        $arr["manufacturedRefined"]["currentCrop"]["thisWeek"]=number_format($thisWeek->manufacturedRefined, 3, '.', ',');
        $arr["manufacturedRefined"]["currentCrop"]["prevWeek"]=number_format($prevWeek->manufacturedRefined, 3, '.', ',');
        $arr["manufacturedRefined"]["currentCrop"]["toDate"]=number_format($toDate->manufacturedRefined, 3, '.', ',');
        $arr["manufacturedRefined"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_manufacturedRefined, 3, '.', ',');
        $arr["manufacturedRefined"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_manufacturedRefined, 3, '.', ',');
        $arr["manufacturedRefined"]["prevCrop"]["toDate"]=number_format($toDate->prev_manufacturedRefined, 3, '.', ',');

        //PRODUCTION RETENTION, ADJ, OVERAGES - REFINED (RAO)
        $arr["raoRefined"]["currentCrop"]["thisWeek"]=number_format($thisWeek->raoRefined, 3, '.', ',');
        $arr["raoRefined"]["currentCrop"]["prevWeek"]=number_format($prevWeek->raoRefined, 3, '.', ',');
        $arr["raoRefined"]["currentCrop"]["toDate"]=number_format($toDate->raoRefined, 3, '.', ',');
        $arr["raoRefined"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_raoRefined, 3, '.', ',');
        $arr["raoRefined"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_raoRefined, 3, '.', ',');
        $arr["raoRefined"]["prevCrop"]["toDate"]=number_format($toDate->prev_raoRefined, 3, '.', ',');

        //ISSUANCES PLANTERS SHARE
        $arr["sharePlanter"]["currentCrop"]["thisWeek"]=number_format($thisWeek->sharePlanter, 3, '.', ',');
        $arr["sharePlanter"]["currentCrop"]["prevWeek"]=number_format($prevWeek->sharePlanter, 3, '.', ',');
        $arr["sharePlanter"]["currentCrop"]["toDate"]=number_format($toDate->sharePlanter, 3, '.', ',');
        $arr["sharePlanter"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_sharePlanter, 3, '.', ',');
        $arr["sharePlanter"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_sharePlanter, 3, '.', ',');
        $arr["sharePlanter"]["prevCrop"]["toDate"]=number_format($toDate->prev_sharePlanter, 3, '.', ',');

        //ISSUANCES MILL SHARE
        $arr["shareMiller"]["currentCrop"]["thisWeek"]=number_format($thisWeek->shareMiller, 3, '.', ',');
        $arr["shareMiller"]["currentCrop"]["prevWeek"]=number_format($prevWeek->shareMiller, 3, '.', ',');
        $arr["shareMiller"]["currentCrop"]["toDate"]=number_format($toDate->shareMiller, 3, '.', ',');
        $arr["shareMiller"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_shareMiller, 3, '.', ',');
        $arr["shareMiller"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_shareMiller, 3, '.', ',');
        $arr["shareMiller"]["prevCrop"]["toDate"]=number_format($toDate->prev_shareMiller, 3, '.', ',');

        //ISSUANCES REFINERY MOLASSES
        $arr["refineryMolasses"]["currentCrop"]["thisWeek"]=number_format($thisWeek->refineryMolasses, 3, '.', ',');
        $arr["refineryMolasses"]["currentCrop"]["prevWeek"]=number_format($prevWeek->refineryMolasses, 3, '.', ',');
        $arr["refineryMolasses"]["currentCrop"]["toDate"]=number_format($toDate->refineryMolasses, 3, '.', ',');
        $arr["refineryMolasses"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_refineryMolasses, 3, '.', ',');
        $arr["refineryMolasses"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_refineryMolasses, 3, '.', ',');
        $arr["refineryMolasses"]["prevCrop"]["toDate"]=number_format($toDate->prev_refineryMolasses, 3, '.', ',');

//        $arr["notCoveredByMsc"]["currentCrop"]["thisWeek"]=$thisWeek->prev_notCoveredByMsc
        //PRODUCTION TOTAL
        $arr["totalProduction"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format(($thisWeek->manufacturedRaw) + ($thisWeek->rao) + ($thisWeek->manufacturedRefined) + ($thisWeek->raoRefined), 3, '.', ','),
                "prevWeek"=>number_format(($prevWeek->manufacturedRaw) + ($prevWeek->rao) + ($prevWeek->manufacturedRefined) + ($prevWeek->raoRefined), 3, '.', ','),
                "toDate"=>number_format(($toDate->manufacturedRaw) + ($toDate->rao) + ($toDate->manufacturedRefined) + ($toDate->raoRefined), 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format(($thisWeek->prev_manufacturedRaw) + ($thisWeek->prev_rao) + ($thisWeek->prev_manufacturedRefined) + ($thisWeek->prev_raoRefined), 3, '.', ','),
                "prevWeek"=>number_format(($prevWeek->prev_manufacturedRaw) + ($prevWeek->prev_rao) + ($prevWeek->prev_manufacturedRefined) + ($prevWeek->prev_raoRefined), 3, '.', ','),
                "toDate"=>number_format(($toDate->prev_manufacturedRaw) + ($toDate->prev_rao) + ($toDate->prev_manufacturedRefined) + ($toDate->prev_raoRefined), 3, '.', ','),
            ],
        ];

        //ISSUANCES TOTAL
        $arr["totalIssuance"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format(($thisWeek->sharePlanter) + ($thisWeek->shareMiller) + ($thisWeek->refineryMolasses), 3, '.', ','),
                "prevWeek"=>number_format(($prevWeek->sharePlanter) + ($prevWeek->shareMiller) + ($prevWeek->refineryMolasses), 3, '.', ','),
                "toDate"=>number_format(($toDate->sharePlanter) + ($toDate->shareMiller) + ($toDate->refineryMolasses), 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format(($thisWeek->prev_sharePlanter) + ($thisWeek->prev_shareMiller) + ($thisWeek->prev_refineryMolasses), 3, '.', ','),
                "prevWeek"=>number_format(($prevWeek->prev_sharePlanter) + ($prevWeek->prev_shareMiller) + ($prevWeek->prev_refineryMolasses), 3, '.', ','),
                "toDate"=>number_format(($toDate->prev_sharePlanter) + ($toDate->prev_shareMiller) + ($toDate->prev_refineryMolasses), 3, '.', ','),
            ],
        ];

        //NOT COVERED BY MSC
        $arr["notCoveredByMsc"]["currentCrop"]["thisWeek"]=number_format((($thisWeek->manufacturedRaw) + ($thisWeek->rao) + ($thisWeek->manufacturedRefined) + ($thisWeek->raoRefined))-(($thisWeek->sharePlanter) + ($thisWeek->shareMiller) + ($thisWeek->refineryMolasses)), 3, '.', ',');
        $arr["notCoveredByMsc"]["currentCrop"]["prevWeek"]=number_format((($prevWeek->manufacturedRaw) + ($prevWeek->rao) + ($prevWeek->manufacturedRefined) + ($prevWeek->raoRefined))-(($prevWeek->sharePlanter) + ($prevWeek->shareMiller) + ($prevWeek->refineryMolasses)), 3, '.', ',');
        $arr["notCoveredByMsc"]["currentCrop"]["toDate"]=number_format((($toDate->manufacturedRaw) + ($toDate->rao) + ($toDate->manufacturedRefined) + ($toDate->raoRefined))-(($toDate->sharePlanter) + ($toDate->shareMiller) + ($toDate->refineryMolasses)), 3, '.', ',');
        $arr["notCoveredByMsc"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_notCoveredByMsc, 3, '.', ',');
        $arr["notCoveredByMsc"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_notCoveredByMsc, 3, '.', ',');
        $arr["notCoveredByMsc"]["prevCrop"]["toDate"]=number_format($toDate->prev_notCoveredByMsc, 3, '.', ',');

//        CURRENT CROP RAW BALANCE 5.1
        $balRawCTotalThisWeek = ((($thisWeek->sharePlanter) + ($thisWeek->shareMiller))-(($withRawDomCTotalThisWeek) + ($withRawDistCTotalThisWeek))+((($thisWeek->manufacturedRaw) + ($thisWeek->rao) + ($thisWeek->manufacturedRefined) + ($thisWeek->raoRefined))-(($thisWeek->sharePlanter) + ($thisWeek->shareMiller) + ($thisWeek->refineryMolasses))));
        $balRawCTotalprevWeek = ((($prevWeek->sharePlanter) + ($prevWeek->shareMiller))-(($withRawDomCTotalprevWeek) + ($withRawDistCTotalprevWeek))+((($prevWeek->manufacturedRaw) + ($prevWeek->rao) + ($prevWeek->manufacturedRefined) + ($prevWeek->raoRefined))-(($prevWeek->sharePlanter) + ($prevWeek->shareMiller) + ($prevWeek->refineryMolasses))));
        $balRawCTotaltoDate = $balRawCTotalThisWeek + $balRawCTotalprevWeek;
//        PREVIOUS CROP RAW BALANCE 5.1
        $balRawPTotalThisWeek = (($thisWeek->prev_sharePlanter+$thisWeek->prev_shareMiller)-(($withRawDomPTotalThisWeek) + ($withRawDistPTotalThisWeek) + ($withRawOtherPTotalThisWeek) + ($withRawExportPTotalThisWeek)));
        $balRawPTotalprevWeek = (($prevWeek->prev_sharePlanter+$prevWeek->prev_shareMiller)-($withRawDomPTotalprevWeek + $withRawDistPTotalprevWeek + $withRawOtherPTotalprevWeek + $withRawExportPTotalprevWeek));
        $balRawPTotaltoDate = (($toDate->prev_sharePlanter+$toDate->prev_shareMiller)-($withRawDomPTotaltoDate + $withRawDistPTotaltoDate + $withRawOtherPTotaltoDate + $withRawExportPTotaltoDate));
//        $balRawPTotaltoDate = $balRawPTotalThisWeek + $balRawPTotalprevWeek;

//        CURRENT CROP REFINED BALANCE 5.2
        $balRefinedCTotalThisWeek = (($thisWeek->refineryMolasses)-(($withRefinedDomCTotalThisWeek) + ($withRefinedDistCTotalThisWeek) + ($withRefinedOtherCTotalThisWeek) + ($withRefinedExportCTotalThisWeek)));
        $balRefinedCTotalprevWeek = (($prevWeek->refineryMolasses) - (($withRefinedDomCTotalprevWeek) + ($withRefinedDistCTotalprevWeek) + ($withRefinedOtherCTotalprevWeek) + ($withRefinedExportCTotalprevWeek)));
        $balRefinedCTotaltoDate = $balRefinedCTotalThisWeek + $balRefinedCTotalprevWeek;
//        PREVIOUS CROP REFINED BALANCE 5.2
        $balRefinedPTotalThisWeek = ($thisWeek->prev_refineryMolasses)-($withRefinedDomPTotalThisWeek + $withRefinedDistPTotalThisWeek + $withRefinedOtherPTotalThisWeek + $withRefinedExportPTotalThisWeek);
        $balRefinedPTotalprevWeek = ($prevWeek->prev_refineryMolasses)-($withRefinedDomPTotalprevWeek + $withRefinedDistPTotalprevWeek + $withRefinedOtherPTotalprevWeek + $withRefinedExportPTotalprevWeek);
        $balRefinedPTotaltoDate = $balRefinedPTotalThisWeek + $balRefinedPTotalprevWeek;

        //RAW BALANCE
        $arr["rawBalance"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($balRawCTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($balRawCTotalprevWeek, 3, '.', ','),
                "toDate"=>  number_format($balRawCTotaltoDate, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format($balRawPTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($balRawPTotalprevWeek, 3, '.', ','),
                "toDate"=>  number_format($balRawPTotaltoDate, 3, '.', ','),
            ],
        ];

        //REFINED BALANCE
        $arr["refinedBalance"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($balRefinedCTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($balRefinedCTotalprevWeek, 3, '.', ','),
                "toDate"=>  number_format($balRefinedCTotaltoDate, 3, '.', ','),
            ],

            "prevCrop"=>[
                "thisWeek"=>number_format($balRefinedPTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($balRefinedPTotalprevWeek, 3, '.', ','),
                "toDate"=>  number_format($balRefinedPTotaltoDate, 3, '.', ','),
            ],
        ];

        //1/27/2025 LOUIS RENAMED VARIABLE DUE TO CONFLICT WITH FORM 1 VARIABLE
        //TOTAL BALANCE
        $arr["totalBalance3"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($balRefinedCTotalThisWeek + $balRawCTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($balRefinedCTotalprevWeek + $balRawCTotalprevWeek, 3, '.', ','),
                "toDate"=>  number_format($balRefinedCTotaltoDate + $balRawCTotaltoDate, 3, '.', ','),
            ],

            "prevCrop"=>[
                "thisWeek"=>number_format($balRefinedPTotalThisWeek + $balRawPTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($balRefinedPTotalprevWeek + $balRawPTotalprevWeek, 3, '.', ','),
                "toDate"=>  number_format($balRefinedPTotaltoDate + $balRawPTotaltoDate, 3, '.', ','),
            ],
        ];

        return [
            'values' => collect($arr)->dot()->all(),
        ];
    }

    private function getDeliveriesAsOf($reportNo, $weeklyReport){
        $deliveries = Deliveries::query()
            ->selectRaw('weekly_report_slug, trader, sugar_type, withdrawal_type, sum(qty_current) as currentTotal, sum(qty_prev) as prevTotal, weekly_reports.*')
            ->leftJoin('weekly_reports','weekly_reports.slug','=','form3b_deliveries.weekly_report_slug')
            ->where('crop_year','=',$weeklyReport->crop_year)
            ->where('mill_code','=',$weeklyReport->mill_code)
            ->where('report_no','<=', $reportNo != 0 ? $reportNo : $weeklyReport->report_no * 1)
            ->where(function($q){
                $q->where('weekly_reports.status' ,'!=', -1)
                    ->orWhere('weekly_reports.status', '=', null);
            })
            ->groupBy('sugar_type', 'withdrawal_type')
            ->get();
        return $deliveries;
    }

//    private function getDeliveriesAsOfMro($reportNo, $weeklyReport){
//        $deliveries_sro = IssuancesOfSro::query()
//            ->selectRaw('weekly_report_slug,trader, consumption, sum(refined_qty) as currentTotal, sum(prev_refined_qty) as prevTotal, weekly_reports.*')
//            ->leftJoin('weekly_reports','weekly_reports.slug','=','form5a_issuances_of_sro.weekly_report_slug')
//            ->where('crop_year','=',$weeklyReport->crop_year)
//            ->where('mill_code','=',$weeklyReport->mill_code)
//            ->where('report_no','<=', $reportNo != 0 ? $reportNo : $weeklyReport->report_no * 1)
//            ->where(function($q){
//                $q->where('weekly_reports.status' ,'!=', -1)
//                    ->orWhere('weekly_reports.status', '=', null);
//            })
//            ->get();
//        return $deliveries_sro;
//    }
}
