<?php

namespace App\Http\Controllers\GetForms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SMS\Form3b\IssuancesOfMro;
use App\Models\SMS\Form3b\Deliveries;

class GetForm3Controller extends Controller
{
    private function formatValue3($value) {
        return $value < 0 ? '(' . number_format(abs($value), 4, '.', ',') . ')' : number_format($value, 4, '.', ',');
    }

    public function getForm3($slug, $isDotted=true){
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

        $withRawDomCTotalThisWeek = 0.0000;
        $withRawDomPTotalThisWeek = 0.0000;
        $withRawOtherCTotalThisWeek = 0.0000;
        $withRawOtherPTotalThisWeek = 0.0000;
        $withRawExportCTotalThisWeek = 0.0000;
        $withRawExportPTotalThisWeek = 0.0000;
        $withRawDistCTotalThisWeek = 0.0000;
        $withRawDistPTotalThisWeek = 0.0000;
        $withRefinedDomCTotalThisWeek = 0.0000;
        $withRefinedDomPTotalThisWeek = 0.0000;
        $withRefinedDistCTotalThisWeek = 0.0000;
        $withRefinedDistPTotalThisWeek = 0.0000;
        $withRefinedOtherCTotalThisWeek = $this->formatValue3(0.0000);
        $withRefinedOtherPTotalThisWeek = $this->formatValue3(0.0000);
        $withRefinedExportCTotalThisWeek = $this->formatValue3(0.0000);
        $withRefinedExportPTotalThisWeek = $this->formatValue3(0.0000);

        $withRawDomCTotalprevWeek = $this->formatValue3(0.0000);
        $withRawDomPTotalprevWeek = 0.0000;
        $withRawDistCTotalprevWeek = 0.0000;
        $withRawDistPTotalprevWeek = 0.0000;
        $withRawOtherCTotalprevWeek = 0.0000;
        $withRawOtherPTotalprevWeek = 0.0000;
        $withRawExportCTotalprevWeek = 0.0000;
        $withRawExportPTotalprevWeek = 0.0000;
        $withRefinedDomCTotalprevWeek = 0.0000;
        $withRefinedDomPTotalprevWeek = 0.0000;
        $withRefinedDistCTotalprevWeek = 0.0000;
        $withRefinedDistPTotalprevWeek = 0.0000;
        $withRefinedOtherCTotalprevWeek = $this->formatValue3(0.0000);
        $withRefinedOtherPTotalprevWeek = $this->formatValue3(0.0000);
        $withRefinedExportCTotalprevWeek = $this->formatValue3(0.0000);
        $withRefinedExportPTotalprevWeek = $this->formatValue3(0.0000);

        $withRawDomCTotaltoDate = 0.0000;
        $withRawDomPTotaltoDate = 0.0000;
        $withRawDistCTotaltoDate = 0.0000;
        $withRawDistPTotaltoDate = 0.0000;
        $withRawOtherCTotaltoDate = 0.0000;
        $withRawOtherPTotaltoDate = 0.0000;
        $withRawExportCTotaltoDate = 0.0000;
        $withRawExportPTotaltoDate = 0.0000;
        $withRefinedDomCTotaltoDate = 0.0000;
        $withRefinedDomPTotaltoDate = 0.0000;
        $withRefinedDistCTotaltoDate = 0.0000;
        $withRefinedDistPTotaltoDate = 0.0000;
        $withRefinedOtherCTotaltoDate = $this->formatValue3(0.0000);
        $withRefinedOtherPTotaltoDate = $this->formatValue3(0.0000);
        $withRefinedExportCTotaltoDate = $this->formatValue3(0.0000);
        $withRefinedExportPTotaltoDate = $this->formatValue3(0.0000);

        $arr["withRefinedDomestic"]["currentCrop"]["thisWeek"] = $this->formatValue3(0.000);
        $arr["withRefinedDomestic"]["prevCrop"]["thisWeek"] = $this->formatValue3(0.000);
        $arr["withRefinedDistillery"]["currentCrop"]["thisWeek"] = $this->formatValue3(0.000);
        $arr["withRefinedDistillery"]["prevCrop"]["thisWeek"] = $this->formatValue3(0.000);
        $arr["withRefinedOthers"]["currentCrop"]["thisWeek"] = $this->formatValue3(0.000);
        $arr["withRefinedOthers"]["prevCrop"]["thisWeek"] = $this->formatValue3(0.000);
        $arr["withRefinedExport"]["currentCrop"]["thisWeek"] = $this->formatValue3(0.000);
        $arr["withRefinedExport"]["prevCrop"]["thisWeek"] = $this->formatValue3(0.000);

        $arr["withRefinedDomestic"]["currentCrop"]["prevWeek"] = $this->formatValue3(0.000);
        $arr["withRefinedDomestic"]["prevCrop"]["prevWeek"] = $this->formatValue3(0.000);
        $arr["withRefinedDistillery"]["currentCrop"]["prevWeek"] = $this->formatValue3(0.000);
        $arr["withRefinedDistillery"]["prevCrop"]["prevWeek"] = $this->formatValue3(0.000);
        $arr["withRefinedOthers"]["currentCrop"]["prevWeek"] = $this->formatValue3(0.000);
        $arr["withRefinedOthers"]["prevCrop"]["prevWeek"] = $this->formatValue3(0.000);
        $arr["withRefinedExport"]["currentCrop"]["prevWeek"] = $this->formatValue3(0.000);
        $arr["withRefinedExport"]["prevCrop"]["prevWeek"] = $this->formatValue3(0.000);

        $arr["withRefinedDomestic"]["currentCrop"]["toDate"] = $this->formatValue3(0.000);
        $arr["withRefinedDomestic"]["prevCrop"]["toDate"] = $this->formatValue3(0.000);
        $arr["withRefinedDistillery"]["currentCrop"]["toDate"] = $this->formatValue3(0.000);
        $arr["withRefinedDistillery"]["prevCrop"]["toDate"] = $this->formatValue3(0.000);
        $arr["withRefinedOthers"]["currentCrop"]["toDate"] = $this->formatValue3(0.000);
        $arr["withRefinedOthers"]["prevCrop"]["toDate"] = $this->formatValue3(0.000);
        $arr["withRefinedExport"]["currentCrop"]["toDate"] = $this->formatValue3(0.000);
        $arr["withRefinedExport"]["prevCrop"]["toDate"] = $this->formatValue3(0.000);

        $arr["withRawDomestic"]["currentCrop"]["thisWeek"] = $this->formatValue3(0.000);
        $arr["withRawDomestic"]["prevCrop"]["thisWeek"] = $this->formatValue3(0.000);
        $arr["withRawDistillery"]["currentCrop"]["thisWeek"] = $this->formatValue3(0.000);
        $arr["withRawDistillery"]["prevCrop"]["thisWeek"] = $this->formatValue3(0.000);
        $arr["withRawOthers"]["currentCrop"]["thisWeek"] = $this->formatValue3(0.000);
        $arr["withRawOthers"]["prevCrop"]["thisWeek"] = $this->formatValue3(0.000);
        $arr["withRawExport"]["currentCrop"]["thisWeek"] = $this->formatValue3(0.000);
        $arr["withRawExport"]["prevCrop"]["thisWeek"] = $this->formatValue3(0.000);

        $arr["withRawDomestic"]["currentCrop"]["prevWeek"] = $this->formatValue3(0.000);
        $arr["withRawDomestic"]["prevCrop"]["prevWeek"] = $this->formatValue3(0.000);
        $arr["withRawDistillery"]["currentCrop"]["prevWeek"] = $this->formatValue3(0.000);
        $arr["withRawDistillery"]["prevCrop"]["prevWeek"] = $this->formatValue3(0.000);
        $arr["withRawOthers"]["currentCrop"]["prevWeek"] = $this->formatValue3(0.000);
        $arr["withRawOthers"]["prevCrop"]["prevWeek"] = $this->formatValue3(0.000);
        $arr["withRawExport"]["currentCrop"]["prevWeek"] = $this->formatValue3(0.000);
        $arr["withRawExport"]["prevCrop"]["prevWeek"] = $this->formatValue3(0.000);

        $arr["withRawDomestic"]["currentCrop"]["toDate"] = $this->formatValue3(0.000);
        $arr["withRawDomestic"]["prevCrop"]["toDate"] = $this->formatValue3(0.000);
        $arr["withRawDistillery"]["currentCrop"]["toDate"] = $this->formatValue3(0.000);
        $arr["withRawDistillery"]["prevCrop"]["toDate"] = $this->formatValue3(0.000);
        $arr["withRawOthers"]["currentCrop"]["toDate"] = $this->formatValue3(0.000);
        $arr["withRawOthers"]["prevCrop"]["toDate"] = $this->formatValue3(0.000);
        $arr["withRawExport"]["currentCrop"]["toDate"] = $this->formatValue3(0.000);
        $arr["withRawExport"]["prevCrop"]["toDate"] = $this->formatValue3(0.000);

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
                        $arr["withRawDomestic"]["currentCrop"]["thisWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                        $arr["withRawDomestic"]["prevCrop"]["thisWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                        $withRawDomCTotalThisWeek += floatval(str_replace(',', '', $arr["withRawDomestic"]["currentCrop"]["thisWeek"]));
                        $withRawDomPTotalThisWeek += floatval(str_replace(',', '', $arr["withRawDomestic"]["prevCrop"]["thisWeek"]));
                    } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                        $arr["withRawDistillery"]["currentCrop"]["thisWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                        $arr["withRawDistillery"]["prevCrop"]["thisWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                        $withRawDistCTotalThisWeek += floatval(str_replace(',', '', $arr["withRawDistillery"]["currentCrop"]["thisWeek"]));
                        $withRawDistPTotalThisWeek += floatval(str_replace(',', '', $arr["withRawDistillery"]["prevCrop"]["thisWeek"]));
                    }
                    if ($delivery->withdrawal_type == "OTHERS") {
                        $arr["withRawOthers"]["currentCrop"]["thisWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                        $arr["withRawOthers"]["prevCrop"]["thisWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                        $withRawOtherCTotalThisWeek += floatval(str_replace(',', '', $arr["withRawOthers"]["currentCrop"]["thisWeek"]));
                        $withRawOtherPTotalThisWeek += floatval(str_replace(',', '', $arr["withRawOthers"]["prevCrop"]["thisWeek"]));
                    } elseif ($delivery->withdrawal_type == "EXPORT") {
                        $arr["withRawExport"]["currentCrop"]["thisWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                        $arr["withRawExport"]["prevCrop"]["thisWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                        $withRawExportCTotalThisWeek += floatval(str_replace(',', '', $arr["withRawExport"]["currentCrop"]["thisWeek"]));
                        $withRawExportPTotalThisWeek += floatval(str_replace(',', '', $arr["withRawExport"]["prevCrop"]["thisWeek"]));
                    }
            }elseif($delivery->sugar_type == "REFINED"){
                    if ($delivery->withdrawal_type == "DOMESTIC") {
                        $arr["withRefinedDomestic"]["currentCrop"]["thisWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                        $arr["withRefinedDomestic"]["prevCrop"]["thisWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                        $withRefinedDomCTotalThisWeek += floatval(str_replace(',', '', $arr["withRefinedDomestic"]["currentCrop"]["thisWeek"]));
                        $withRefinedDomPTotalThisWeek += floatval(str_replace(',', '', $arr["withRefinedDomestic"]["prevCrop"]["thisWeek"]));
                    } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                        $arr["withRefinedDistillery"]["currentCrop"]["thisWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                        $arr["withRefinedDistillery"]["prevCrop"]["thisWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                        $withRefinedDistCTotalThisWeek += floatval(str_replace(',', '', $arr["withRefinedDistillery"]["currentCrop"]["thisWeek"]));
                        $withRefinedDistPTotalThisWeek += floatval(str_replace(',', '', $arr["withRefinedDistillery"]["prevCrop"]["thisWeek"]));
                    }
                    if ($delivery->withdrawal_type == "OTHERS") {
                        $arr["withRefinedOthers"]["currentCrop"]["thisWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                        $arr["withRefinedOthers"]["prevCrop"]["thisWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                        $withRefinedOtherCTotalThisWeek += floatval(str_replace(',', '', $arr["withRefinedOthers"]["currentCrop"]["thisWeek"]));
                        $withRefinedOtherPTotalThisWeek += floatval(str_replace(',', '', $arr["withRefinedOthers"]["prevCrop"]["thisWeek"]));
                    } elseif ($delivery->withdrawal_type == "EXPORT") {
                        $arr["withRefinedExport"]["currentCrop"]["thisWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                        $arr["withRefinedExport"]["prevCrop"]["thisWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
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
                    $arr["withRawDomestic"]["currentCrop"]["prevWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRawDomestic"]["prevCrop"]["prevWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRawDomCTotalprevWeek += floatval(str_replace(',', '', $arr["withRawDomestic"]["currentCrop"]["prevWeek"]));
                    $withRawDomPTotalprevWeek += floatval(str_replace(',', '', $arr["withRawDomestic"]["prevCrop"]["prevWeek"]));
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRawDistillery"]["currentCrop"]["prevWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRawDistillery"]["prevCrop"]["prevWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRawDistCTotalprevWeek += floatval(str_replace(',', '', $arr["withRawDistillery"]["currentCrop"]["prevWeek"]));
                    $withRawDistPTotalprevWeek += floatval(str_replace(',', '', $arr["withRawDistillery"]["prevCrop"]["prevWeek"]));
                }
                if ($delivery->withdrawal_type == "OTHERS") {
                    $arr["withRawOthers"]["currentCrop"]["prevWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRawOthers"]["prevCrop"]["prevWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRawOtherCTotalprevWeek += floatval(str_replace(',', '', $arr["withRawOthers"]["currentCrop"]["prevWeek"]));
                    $withRawOtherPTotalprevWeek += floatval(str_replace(',', '', $arr["withRawOthers"]["prevCrop"]["prevWeek"]));
                } elseif ($delivery->withdrawal_type == "EXPORT") {
                    $arr["withRawExport"]["currentCrop"]["prevWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRawExport"]["prevCrop"]["prevWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRawExportCTotalprevWeek += floatval(str_replace(',', '', $arr["withRawExport"]["currentCrop"]["prevWeek"]));
                    $withRawExportPTotalprevWeek += floatval(str_replace(',', '', $arr["withRawExport"]["prevCrop"]["prevWeek"]));
                }
            }elseif($delivery->sugar_type == "REFINED"){
                if ($delivery->withdrawal_type == "DOMESTIC") {
                    $arr["withRefinedDomestic"]["currentCrop"]["prevWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRefinedDomestic"]["prevCrop"]["prevWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRefinedDomCTotalprevWeek += floatval(str_replace(',', '', $arr["withRefinedDomestic"]["currentCrop"]["prevWeek"]));
                    $withRefinedDomPTotalprevWeek += floatval(str_replace(',', '', $arr["withRefinedDomestic"]["prevCrop"]["prevWeek"]));
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRefinedDistillery"]["currentCrop"]["prevWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRefinedDistillery"]["prevCrop"]["prevWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRefinedDistCTotalprevWeek += floatval(str_replace(',', '', $arr["withRefinedDistillery"]["currentCrop"]["prevWeek"]));
                    $withRefinedDistPTotalprevWeek += floatval(str_replace(',', '', $arr["withRefinedDistillery"]["prevCrop"]["prevWeek"]));
                }
                if ($delivery->withdrawal_type == "OTHERS") {
                    $arr["withRefinedOthers"]["currentCrop"]["prevWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRefinedOthers"]["prevCrop"]["prevWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRefinedOtherCTotalprevWeek += floatval(str_replace(',', '', $arr["withRefinedOthers"]["currentCrop"]["prevWeek"]));
                    $withRefinedOtherPTotalprevWeek += floatval(str_replace(',', '', $arr["withRefinedOthers"]["prevCrop"]["prevWeek"]));
                } elseif ($delivery->withdrawal_type == "EXPORT") {
                    $arr["withRefinedExport"]["currentCrop"]["prevWeek"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRefinedExport"]["prevCrop"]["prevWeek"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
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
                    $arr["withRawDomestic"]["currentCrop"]["toDate"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRawDomestic"]["prevCrop"]["toDate"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRawDomCTotaltoDate += floatval(str_replace(',', '', $arr["withRawDomestic"]["currentCrop"]["toDate"]));
                    $withRawDomPTotaltoDate += floatval(str_replace(',', '', $arr["withRawDomestic"]["prevCrop"]["toDate"]));
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRawDistillery"]["currentCrop"]["toDate"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRawDistillery"]["prevCrop"]["toDate"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRawDistCTotaltoDate += floatval(str_replace(',', '', $arr["withRawDistillery"]["currentCrop"]["toDate"]));
                    $withRawDistPTotaltoDate += floatval(str_replace(',', '', $arr["withRawDistillery"]["prevCrop"]["toDate"]));
                }
                if ($delivery->withdrawal_type == "OTHERS") {
                    $arr["withRawOthers"]["currentCrop"]["toDate"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRawOthers"]["prevCrop"]["toDate"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRawOtherCTotaltoDate += floatval(str_replace(',', '', $arr["withRawOthers"]["currentCrop"]["toDate"]));
                    $withRawOtherPTotaltoDate += floatval(str_replace(',', '', $arr["withRawOthers"]["prevCrop"]["toDate"]));
                } elseif ($delivery->withdrawal_type == "EXPORT") {
                    $arr["withRawExport"]["currentCrop"]["toDate"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRawExport"]["prevCrop"]["toDate"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRawExportCTotaltoDate += floatval(str_replace(',', '', $arr["withRawExport"]["currentCrop"]["toDate"]));
                    $withRawExportPTotaltoDate += floatval(str_replace(',', '', $arr["withRawExport"]["prevCrop"]["toDate"]));
                }
            }elseif($delivery->sugar_type == "REFINED"){
                if ($delivery->withdrawal_type == "DOMESTIC") {
                    $arr["withRefinedDomestic"]["currentCrop"]["toDate"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRefinedDomestic"]["prevCrop"]["toDate"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRefinedDomCTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedDomestic"]["currentCrop"]["toDate"]));
                    $withRefinedDomPTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedDomestic"]["prevCrop"]["toDate"]));
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRefinedDistillery"]["currentCrop"]["toDate"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRefinedDistillery"]["prevCrop"]["toDate"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRefinedDistCTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedDistillery"]["currentCrop"]["toDate"]));
                    $withRefinedDistPTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedDistillery"]["prevCrop"]["toDate"]));
                }
                if ($delivery->withdrawal_type == "OTHERS") {
                    $arr["withRefinedOthers"]["currentCrop"]["toDate"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRefinedOthers"]["prevCrop"]["toDate"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRefinedOtherCTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedOthers"]["currentCrop"]["toDate"]));
                    $withRefinedOtherPTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedOthers"]["prevCrop"]["toDate"]));
                } elseif ($delivery->withdrawal_type == "EXPORT") {
                    $arr["withRefinedExport"]["currentCrop"]["toDate"] = $this->formatValue3($delivery->currentTotal ?? 0.0000);
                    $arr["withRefinedExport"]["prevCrop"]["toDate"] = $this->formatValue3($delivery->prevTotal ?? 0.0000);
                    $withRefinedExportCTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedExport"]["currentCrop"]["toDate"]));
                    $withRefinedExportPTotaltoDate += floatval(str_replace(',', '', $arr["withRefinedExport"]["prevCrop"]["toDate"]));
                }
            }
        }

        //RAW WITHDRAWALS TOTAL
        $arr["totalRawWith"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue3(($withRawDomCTotalThisWeek) + ($withRawDistCTotalThisWeek) + ($withRawOtherCTotalThisWeek) + ($withRawExportCTotalThisWeek)),
                "prevWeek"=>$this->formatValue3(($withRawDomCTotalprevWeek) + ($withRawDistCTotalprevWeek) + ($withRawOtherCTotalprevWeek) + ($withRawExportCTotalprevWeek)),
                "toDate"=>$this->formatValue3(($withRawDomCTotaltoDate) + ($withRawDistCTotaltoDate) + ($withRawOtherCTotaltoDate) + ($withRawExportCTotaltoDate)),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue3(($withRawDomPTotalThisWeek) + ($withRawDistPTotalThisWeek) + ($withRawOtherPTotalThisWeek) + ($withRawExportPTotalThisWeek)),
                "prevWeek"=>$this->formatValue3(($withRawDomPTotalprevWeek) + ($withRawDistPTotalprevWeek) + ($withRawOtherPTotalprevWeek) + ($withRawExportPTotalprevWeek)),
                "toDate"=>$this->formatValue3(($withRawDomPTotaltoDate) + ($withRawDistPTotaltoDate) + ($withRawOtherPTotaltoDate) + ($withRawExportPTotaltoDate)),
            ],
        ];

        //REFINED WITHDRAWALS TOTAL
        $arr["totalRefinedWith"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue3(($withRefinedDomCTotalThisWeek) + ($withRefinedDistCTotalThisWeek) + ($withRefinedOtherCTotalThisWeek) + ($withRefinedExportCTotalThisWeek)),
                "prevWeek"=>$this->formatValue3(($withRefinedDomCTotalprevWeek) + ($withRefinedDistCTotalprevWeek) + ($withRefinedOtherCTotalprevWeek) + ($withRefinedExportCTotalprevWeek)),
                "toDate"=>$this->formatValue3(($withRefinedDomCTotaltoDate) + ($withRefinedDistCTotaltoDate) + ($withRefinedOtherCTotaltoDate) + ($withRefinedExportCTotaltoDate)),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue3(($withRefinedDomPTotalThisWeek) + ($withRefinedDistPTotalThisWeek) + ($withRefinedOtherPTotalThisWeek) + ($withRefinedExportPTotalThisWeek)),
                "prevWeek"=>$this->formatValue3(($withRefinedDomPTotalprevWeek) + ($withRefinedDistPTotalprevWeek) + ($withRefinedOtherPTotalprevWeek) + ($withRefinedExportPTotalprevWeek)),
                "toDate"=>$this->formatValue3(($withRefinedDomPTotaltoDate) + ($withRefinedDistPTotaltoDate) + ($withRefinedOtherPTotaltoDate) + ($withRefinedExportPTotaltoDate)),
            ],
        ];

        //OVERALL WITHDRAWALS TOTAL
        $arr["totalOverallWith"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue3(($withRawDomCTotalThisWeek) + ($withRawDistCTotalThisWeek) + ($withRefinedDomCTotalThisWeek) + ($withRefinedDistCTotalThisWeek) + ($withRawOtherCTotalThisWeek) + ($withRawExportCTotalThisWeek) + ($withRefinedOtherCTotalThisWeek) + ($withRefinedExportCTotalThisWeek)),
                "prevWeek"=>$this->formatValue3(($withRawDomCTotalprevWeek) + ($withRawDistCTotalprevWeek) + ($withRefinedDomCTotalprevWeek) + ($withRefinedDistCTotalprevWeek) + ($withRawOtherCTotalprevWeek) + ($withRawExportCTotalprevWeek) + ($withRefinedOtherCTotalprevWeek) + ($withRefinedExportCTotalprevWeek)),
                "toDate"=>$this->formatValue3(($withRawDomCTotaltoDate) + ($withRawDistCTotaltoDate) + ($withRefinedDomCTotaltoDate) + ($withRefinedDistCTotaltoDate) + ($withRawOtherCTotaltoDate) + ($withRawExportCTotaltoDate) + ($withRefinedOtherCTotaltoDate) + ($withRefinedExportCTotaltoDate)),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue3(($withRawDomPTotalThisWeek) + ($withRawDistPTotalThisWeek) + ($withRefinedDomPTotalThisWeek) + ($withRefinedDistPTotalThisWeek) + ($withRawOtherPTotalThisWeek) + ($withRawExportPTotalThisWeek) + ($withRefinedOtherPTotalThisWeek) + ($withRefinedExportPTotalThisWeek)),
                "prevWeek"=>$this->formatValue3(($withRawDomPTotalprevWeek) + ($withRawDistPTotalprevWeek) + ($withRefinedDomPTotalprevWeek) + ($withRefinedDistPTotalprevWeek) + ($withRawOtherPTotalprevWeek) + ($withRawExportPTotalprevWeek) + ($withRefinedOtherPTotalprevWeek) + ($withRefinedExportPTotalprevWeek)),
                "toDate"=>$this->formatValue3(($withRawDomPTotaltoDate) + ($withRawDistPTotaltoDate) + ($withRefinedDomPTotaltoDate) + ($withRefinedDistPTotaltoDate) + ($withRawOtherPTotaltoDate) + ($withRawExportPTotaltoDate) + ($withRefinedOtherPTotaltoDate) + ($withRefinedExportPTotaltoDate)),
            ],
        ];
        //WITHDRAWALS COMPUTATION --------------------------------------------------------- END

        //PRODUCTION MANUFACTURED RAW
        $arr["manufacturedRaw"]["currentCrop"]["thisWeek"]=$this->formatValue3($thisWeek->manufacturedRaw);
        $arr["manufacturedRaw"]["currentCrop"]["prevWeek"]=$this->formatValue3($prevWeek->manufacturedRaw);
        $arr["manufacturedRaw"]["currentCrop"]["toDate"]=$this->formatValue3($toDate->manufacturedRaw);
        $arr["manufacturedRaw"]["prevCrop"]["thisWeek"]=$this->formatValue3($thisWeek->prev_manufacturedRaw);
        $arr["manufacturedRaw"]["prevCrop"]["prevWeek"]=$this->formatValue3($prevWeek->prev_manufacturedRaw);
        $arr["manufacturedRaw"]["prevCrop"]["toDate"]=$this->formatValue3($toDate->prev_manufacturedRaw);

        //PRODUCTION RETENTION, ADJ, OVERAGES (RAO)
        $arr["rao"]["currentCrop"]["thisWeek"]=$this->formatValue3($thisWeek->rao);
        $arr["rao"]["currentCrop"]["prevWeek"]=$this->formatValue3($prevWeek->rao);
        $arr["rao"]["currentCrop"]["toDate"]=$this->formatValue3($toDate->rao);
        $arr["rao"]["prevCrop"]["thisWeek"]=$this->formatValue3($thisWeek->prev_rao);
        $arr["rao"]["prevCrop"]["prevWeek"]=$this->formatValue3($prevWeek->prev_rao);
        $arr["rao"]["prevCrop"]["toDate"]=$this->formatValue3($toDate->prev_rao);

        //PRODUCTION MANUFACTURED REFINED
        $arr["manufacturedRefined"]["currentCrop"]["thisWeek"]=$this->formatValue3($thisWeek->manufacturedRefined);
        $arr["manufacturedRefined"]["currentCrop"]["prevWeek"]=$this->formatValue3($prevWeek->manufacturedRefined);
        $arr["manufacturedRefined"]["currentCrop"]["toDate"]=$this->formatValue3($toDate->manufacturedRefined);
        $arr["manufacturedRefined"]["prevCrop"]["thisWeek"]=$this->formatValue3($thisWeek->prev_manufacturedRefined);
        $arr["manufacturedRefined"]["prevCrop"]["prevWeek"]=$this->formatValue3($prevWeek->prev_manufacturedRefined);
        $arr["manufacturedRefined"]["prevCrop"]["toDate"]=$this->formatValue3($toDate->prev_manufacturedRefined);

        //PRODUCTION RETENTION, ADJ, OVERAGES - REFINED (RAO)
        $arr["raoRefined"]["currentCrop"]["thisWeek"]=$this->formatValue3($thisWeek->raoRefined);
        $arr["raoRefined"]["currentCrop"]["prevWeek"]=$this->formatValue3($prevWeek->raoRefined);
        $arr["raoRefined"]["currentCrop"]["toDate"]=$this->formatValue3($toDate->raoRefined);
        $arr["raoRefined"]["prevCrop"]["thisWeek"]=$this->formatValue3($thisWeek->prev_raoRefined);
        $arr["raoRefined"]["prevCrop"]["prevWeek"]=$this->formatValue3($prevWeek->prev_raoRefined);
        $arr["raoRefined"]["prevCrop"]["toDate"]=$this->formatValue3($toDate->prev_raoRefined);

        //ISSUANCES PLANTERS SHARE
        $arr["sharePlanter"]["currentCrop"]["thisWeek"]=$this->formatValue3($thisWeek->sharePlanter);
        $arr["sharePlanter"]["currentCrop"]["prevWeek"]=$this->formatValue3($prevWeek->sharePlanter);
        $arr["sharePlanter"]["currentCrop"]["toDate"]=$this->formatValue3($toDate->sharePlanter);
        $arr["sharePlanter"]["prevCrop"]["thisWeek"]=$this->formatValue3($thisWeek->prev_sharePlanter);
        $arr["sharePlanter"]["prevCrop"]["prevWeek"]=$this->formatValue3($prevWeek->prev_sharePlanter);
        $arr["sharePlanter"]["prevCrop"]["toDate"]=$this->formatValue3($toDate->prev_sharePlanter);

        //ISSUANCES MILL SHARE
        $arr["shareMiller"]["currentCrop"]["thisWeek"]=$this->formatValue3($thisWeek->shareMiller);
        $arr["shareMiller"]["currentCrop"]["prevWeek"]=$this->formatValue3($prevWeek->shareMiller);
        $arr["shareMiller"]["currentCrop"]["toDate"]=$this->formatValue3($toDate->shareMiller);
        $arr["shareMiller"]["prevCrop"]["thisWeek"]=$this->formatValue3($thisWeek->prev_shareMiller);
        $arr["shareMiller"]["prevCrop"]["prevWeek"]=$this->formatValue3($prevWeek->prev_shareMiller);
        $arr["shareMiller"]["prevCrop"]["toDate"]=$this->formatValue3($toDate->prev_shareMiller);

        //ISSUANCES REFINERY MOLASSES
        $arr["refineryMolasses"]["currentCrop"]["thisWeek"]=$this->formatValue3($thisWeek->refineryMolasses);
        $arr["refineryMolasses"]["currentCrop"]["prevWeek"]=$this->formatValue3($prevWeek->refineryMolasses);
        $arr["refineryMolasses"]["currentCrop"]["toDate"]=$this->formatValue3($toDate->refineryMolasses);
        $arr["refineryMolasses"]["prevCrop"]["thisWeek"]=$this->formatValue3($thisWeek->prev_refineryMolasses);
        $arr["refineryMolasses"]["prevCrop"]["prevWeek"]=$this->formatValue3($prevWeek->prev_refineryMolasses);
        $arr["refineryMolasses"]["prevCrop"]["toDate"]=$this->formatValue3($toDate->prev_refineryMolasses);

//        $arr["notCoveredByMsc"]["currentCrop"]["thisWeek"]=$thisWeek->prev_notCoveredByMsc
        //PRODUCTION TOTAL
        $arr["totalProduction"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue3(($thisWeek->manufacturedRaw) + ($thisWeek->rao) + ($thisWeek->manufacturedRefined) + ($thisWeek->raoRefined)),
                "prevWeek"=>$this->formatValue3(($prevWeek->manufacturedRaw) + ($prevWeek->rao) + ($prevWeek->manufacturedRefined) + ($prevWeek->raoRefined)),
                "toDate"=>$this->formatValue3(($toDate->manufacturedRaw) + ($toDate->rao) + ($toDate->manufacturedRefined) + ($toDate->raoRefined)),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue3(($thisWeek->prev_manufacturedRaw) + ($thisWeek->prev_rao) + ($thisWeek->prev_manufacturedRefined) + ($thisWeek->prev_raoRefined)),
                "prevWeek"=>$this->formatValue3(($prevWeek->prev_manufacturedRaw) + ($prevWeek->prev_rao) + ($prevWeek->prev_manufacturedRefined) + ($prevWeek->prev_raoRefined)),
                "toDate"=>$this->formatValue3(($toDate->prev_manufacturedRaw) + ($toDate->prev_rao) + ($toDate->prev_manufacturedRefined) + ($toDate->prev_raoRefined)),
            ],
        ];

        //ISSUANCES TOTAL
        $arr["totalIssuance"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue3(($thisWeek->sharePlanter) + ($thisWeek->shareMiller) + ($thisWeek->refineryMolasses)),
                "prevWeek"=>$this->formatValue3(($prevWeek->sharePlanter) + ($prevWeek->shareMiller) + ($prevWeek->refineryMolasses)),
                "toDate"=>$this->formatValue3(($toDate->sharePlanter) + ($toDate->shareMiller) + ($toDate->refineryMolasses)),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue3(($thisWeek->prev_sharePlanter) + ($thisWeek->prev_shareMiller) + ($thisWeek->prev_refineryMolasses)),
                "prevWeek"=>$this->formatValue3(($prevWeek->prev_sharePlanter) + ($prevWeek->prev_shareMiller) + ($prevWeek->prev_refineryMolasses)),
                "toDate"=>$this->formatValue3(($toDate->prev_sharePlanter) + ($toDate->prev_shareMiller) + ($toDate->prev_refineryMolasses)),
            ],
        ];

        //NOT COVERED BY MSC
        $arr["notCoveredByMsc"]["currentCrop"]["thisWeek"]=$this->formatValue3(($thisWeek->manufacturedRaw + $thisWeek->rao + $thisWeek->manufacturedRefined + $thisWeek->raoRefined)-($thisWeek->sharePlanter + $thisWeek->shareMiller + $thisWeek->refineryMolasses));
        $arr["notCoveredByMsc"]["currentCrop"]["prevWeek"]=$this->formatValue3((($prevWeek->manufacturedRaw) + ($prevWeek->rao) + ($prevWeek->manufacturedRefined) + ($prevWeek->raoRefined))-(($prevWeek->sharePlanter) + ($prevWeek->shareMiller) + ($prevWeek->refineryMolasses)));
        $arr["notCoveredByMsc"]["currentCrop"]["toDate"]=$this->formatValue3((($toDate->manufacturedRaw) + ($toDate->rao) + ($toDate->manufacturedRefined) + ($toDate->raoRefined))-(($toDate->sharePlanter) + ($toDate->shareMiller) + ($toDate->refineryMolasses)));
//        $arr["notCoveredByMsc"]["prevCrop"]["thisWeek"]=$this->formatValue3(($thisWeek->prev_manufacturedRaw + $thisWeek->prev_rao + $thisWeek->prev_manufacturedRefined + $thisWeek->prev_raoRefined)-($thisWeek->prev_sharePlanter + $thisWeek->prev_shareMiller + $thisWeek->prev_refineryMolasses));
//        $arr["notCoveredByMsc"]["prevCrop"]["prevWeek"]=$this->formatValue3((($prevWeek->prev_manufacturedRaw) + ($prevWeek->prev_rao) + ($prevWeek->prev_manufacturedRefined) + ($prevWeek->prev_raoRefined))-(($prevWeek->prev_sharePlanter) + ($prevWeek->prev_shareMiller) + ($prevWeek->prev_refineryMolasses)));
//        $arr["notCoveredByMsc"]["prevCrop"]["toDate"]=$this->formatValue3((($toDate->prev_manufacturedRaw) + ($toDate->prev_rao) + ($toDate->prev_manufacturedRefined) + ($toDate->prev_raoRefined))-(($toDate->prev_sharePlanter) + ($toDate->prev_shareMiller) + ($toDate->prev_refineryMolasses)));
//        OLD NOT COVERED BY MSC BEFORE ENRICO
        $arr["notCoveredByMsc"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_notCoveredByMsc, 3, '.', ',');
        $arr["notCoveredByMsc"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_notCoveredByMsc, 3, '.', ',');
        $arr["notCoveredByMsc"]["prevCrop"]["toDate"]=number_format($toDate->prev_notCoveredByMsc, 3, '.', ',');

//        CURRENT CROP RAW BALANCE 5.1
        $balRawCTotalThisWeek = ((($thisWeek->sharePlanter) + ($thisWeek->shareMiller)) -(($withRawDomCTotalThisWeek) + ($withRawDistCTotalThisWeek) + ($withRawOtherCTotalThisWeek) +($withRawExportCTotalThisWeek))+((($thisWeek->manufacturedRaw) + ($thisWeek->rao) + ($thisWeek->manufacturedRefined) + ($thisWeek->raoRefined))-(($thisWeek->sharePlanter) + ($thisWeek->shareMiller) + ($thisWeek->refineryMolasses))));
        $balRawCTotalprevWeek = ((($prevWeek->sharePlanter) + ($prevWeek->shareMiller))-(($withRawDomCTotalprevWeek) + ($withRawDistCTotalprevWeek) + ($withRawOtherCTotalprevWeek) +($withRawExportCTotalprevWeek))+((($prevWeek->manufacturedRaw) + ($prevWeek->rao) + ($prevWeek->manufacturedRefined) + ($prevWeek->raoRefined))-(($prevWeek->sharePlanter) + ($prevWeek->shareMiller) + ($prevWeek->refineryMolasses))));
        $balRawCTotaltoDate = $balRawCTotalThisWeek + $balRawCTotalprevWeek;
//        PREVIOUS CROP RAW BALANCE 5.1
        $balRawPTotalThisWeek = (($thisWeek->prev_sharePlanter+$thisWeek->prev_shareMiller)-(($withRawDomPTotalThisWeek) + ($withRawDistPTotalThisWeek) + ($withRawOtherPTotalThisWeek) + ($withRawExportPTotalThisWeek)));
        $balRawPTotalprevWeek = (($prevWeek->prev_sharePlanter+$prevWeek->prev_shareMiller)-($withRawDomPTotalprevWeek + $withRawDistPTotalprevWeek + $withRawOtherPTotalprevWeek + $withRawExportPTotalprevWeek));
//        $balRawPTotaltoDate = (($toDate->prev_sharePlanter+$toDate->prev_shareMiller)-($withRawDomPTotaltoDate + $withRawDistPTotaltoDate + $withRawOtherPTotaltoDate + $withRawExportPTotaltoDate));
        $balRawPTotaltoDate = $balRawPTotalThisWeek + $balRawPTotalprevWeek;

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
                "thisWeek"=>$this->formatValue3($balRawCTotalThisWeek),
                "prevWeek"=>$this->formatValue3($balRawCTotalprevWeek),
                "toDate"=>  $this->formatValue3($balRawCTotaltoDate),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue3($balRawPTotalThisWeek),
                "prevWeek"=>$this->formatValue3($balRawPTotalprevWeek),
                "toDate"=>  $this->formatValue3($balRawPTotaltoDate),
            ],
        ];

        //REFINED BALANCE
        $arr["refinedBalance"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue3($balRefinedCTotalThisWeek),
                "prevWeek"=>$this->formatValue3($balRefinedCTotalprevWeek),
                "toDate"=>  $this->formatValue3($balRefinedCTotaltoDate),
            ],

            "prevCrop"=>[
                "thisWeek"=>$this->formatValue3($balRefinedPTotalThisWeek),
                "prevWeek"=>$this->formatValue3($balRefinedPTotalprevWeek),
                "toDate"=>  $this->formatValue3($balRefinedPTotaltoDate),
            ],
        ];

        //1/27/2025 LOUIS RENAMED VARIABLE DUE TO CONFLICT WITH FORM 1 VARIABLE
        //TOTAL BALANCE
        $arr["totalBalance3"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue3($balRefinedCTotalThisWeek + $balRawCTotalThisWeek),
                "prevWeek"=>$this->formatValue3($balRefinedCTotalprevWeek + $balRawCTotalprevWeek),
                "toDate"=>  $this->formatValue3($balRefinedCTotaltoDate + $balRawCTotaltoDate),
            ],

            "prevCrop"=>[
                "thisWeek"=>$this->formatValue3($balRefinedPTotalThisWeek + $balRawPTotalThisWeek),
                "prevWeek"=>$this->formatValue3($balRefinedPTotalprevWeek + $balRawPTotalprevWeek),
                "toDate"=>  $this->formatValue3($balRefinedPTotaltoDate + $balRawPTotaltoDate),
            ],
        ];

//        return [
//            'values' => collect($arr)->dot()->all(),
//        ];

        return [
            'values' => $isDotted ? collect($arr)->dot()->all() : collect($arr)->all(),
        ];
    }

    private function getDeliveriesAsOf($reportNo, $weeklyReport){
        $deliveries = Deliveries::query()
            ->selectRaw('weekly_report_slug, trader, sugar_type, withdrawal_type, sum(qty_current) as currentTotal, sum(qty_prev) as prevTotal, weekly_reports.*')
            ->leftJoin('weekly_reports','weekly_reports.slug','=','form3b_deliveries.weekly_report_slug')
            ->where('crop_year','=',$weeklyReport->crop_year)
            ->where('mill_code','=',$weeklyReport->mill_code)
//            ->where('report_no','<=', $reportNo != 0 ? $reportNo : $weeklyReport->report_no * 1)
//          LOUIS 08-10-2025 "Weekly report 1 prevweek copying thisweek"
            ->where('report_no','<=', $reportNo)
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
