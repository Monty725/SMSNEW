<?php

namespace App\Http\Controllers\GetForms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SMS\Form3b\IssuancesOfMro;
use App\Models\SMS\Form3b\Deliveries;

class GetForm3AController extends Controller
{
    public function getForm3a($slug){
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

        $thisWeek = $weeklyReport->form3a;
        $prevWeek = $weeklyReport->form3aToDateAsOf($currentReportNo-1);
        $toDate = $weeklyReport->form3aToDateAsOf($currentReportNo);

        $withRawDomCTotalThisWeek = 0.000;
        $withRawDomPTotalThisWeek = 0.000;
        $withRawDistCTotalThisWeek = 0.000;
        $withRawDistPTotalThisWeek = 0.000;
        $withRefinedDomCTotalThisWeek = 0.000;
        $withRefinedDomPTotalThisWeek = 0.000;
        $withRefinedDistCTotalThisWeek = 0.000;
        $withRefinedDistPTotalThisWeek = 0.000;

        $withRawDomCTotalprevWeek = 0.000;
        $withRawDomPTotalprevWeek = 0.000;
        $withRawDistCTotalprevWeek = 0.000;
        $withRawDistPTotalprevWeek = 0.000;
        $withRefinedDomCTotalprevWeek = 0.000;
        $withRefinedDomPTotalprevWeek = 0.000;
        $withRefinedDistCTotalprevWeek = 0.000;
        $withRefinedDistPTotalprevWeek = 0.000;

        $withRawDomCTotaltoDate = 0.000;
        $withRawDomPTotaltoDate = 0.000;
        $withRawDistCTotaltoDate = 0.000;
        $withRawDistPTotaltoDate = 0.000;
        $withRefinedDomCTotaltoDate = 0.000;
        $withRefinedDomPTotaltoDate = 0.000;
        $withRefinedDistCTotaltoDate = 0.000;
        $withRefinedDistPTotaltoDate = 0.000;

        $arr["withRefinedDomestic"]["currentCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDomestic"]["prevCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDistillery"]["currentCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDistillery"]["prevCrop"]["thisWeek"] = number_format(0.000, 3, '.', ',');

        $arr["withRefinedDomestic"]["currentCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDomestic"]["prevCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDistillery"]["currentCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDistillery"]["prevCrop"]["prevWeek"] = number_format(0.000, 3, '.', ',');

        $arr["withRefinedDomestic"]["currentCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDomestic"]["prevCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDistillery"]["currentCrop"]["toDate"] = number_format(0.000, 3, '.', ',');
        $arr["withRefinedDistillery"]["prevCrop"]["toDate"] = number_format(0.000, 3, '.', ',');

//        number_format($thisWeek->manufacturedRaw, 3, '.', ',')
        //WITHDRAWALS COMPUTATION --------------------------------------------------------- START
        //GET THIS WEEK VALUES FOR WITHDRAWALS
        $deliveries = $weeklyReport->form3bDeliveries()
            ->selectRaw('sugar_type, withdrawal_type, sum(qty_current) as currentTotal, sum(qty_prev) as prevTotal')
            ->groupBy('sugar_type', 'withdrawal_type')
            ->get();
        foreach ($deliveries as $delivery){
            if($delivery->sugar_type == "RAW"){
                    if ($delivery->withdrawal_type == "DOMESTIC") {
                        $arr["withRawDomestic"]["currentCrop"]["thisWeek"] = $delivery->currentTotal ?? 0.000;
                        $arr["withRawDomestic"]["prevCrop"]["thisWeek"] = $delivery->prevTotal ?? 0.000;
                        $withRawDomCTotalThisWeek += $arr["withRawDomestic"]["currentCrop"]["thisWeek"];
                        $withRawDomPTotalThisWeek += $arr["withRawDomestic"]["prevCrop"]["thisWeek"];
                    } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                        $arr["withRawDistillery"]["currentCrop"]["thisWeek"] = $delivery->currentTotal ?? 0.000;
                        $arr["withRawDistillery"]["prevCrop"]["thisWeek"] = $delivery->prevTotal ?? 0.000;
                        $withRawDistCTotalThisWeek += $arr["withRawDistillery"]["currentCrop"]["thisWeek"];
                        $withRawDistPTotalThisWeek += $arr["withRawDistillery"]["prevCrop"]["thisWeek"];
                    }
            }elseif($delivery->sugar_type == "REFINED"){
                    if ($delivery->withdrawal_type == "DOMESTIC") {
                        $arr["withRefinedDomestic"]["currentCrop"]["thisWeek"] = $delivery->currentTotal ?? 0.000;
                        $arr["withRefinedDomestic"]["prevCrop"]["thisWeek"] = $delivery->prevTotal ?? 0.000;
                        $withRefinedDomCTotalThisWeek += $arr["withRefinedDomestic"]["currentCrop"]["thisWeek"];
                        $withRefinedDomPTotalThisWeek += $arr["withRefinedDomestic"]["prevCrop"]["thisWeek"];
                    } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                        $arr["withRefinedDistillery"]["currentCrop"]["thisWeek"] = $delivery->currentTotal ?? 0.000;
                        $arr["withRefinedDistillery"]["prevCrop"]["thisWeek"] = $delivery->prevTotal ?? 0.000;
                        $withRefinedDistCTotalThisWeek += $arr["withRefinedDistillery"]["currentCrop"]["thisWeek"];
                        $withRefinedDistPTotalThisWeek += $arr["withRefinedDistillery"]["prevCrop"]["thisWeek"];
                    }
            }
        }

        //GET PREVIOUS WEEK VALUES FOR WITHDRAWALS
        $deliveries = $this->getDeliveriesAsOf($currentReportNo * 1 - 1,$weeklyReport);
        foreach ($deliveries as $delivery){
            if($delivery->sugar_type == "RAW"){
                if ($delivery->withdrawal_type == "DOMESTIC") {
                    $arr["withRawDomestic"]["currentCrop"]["prevWeek"] = $delivery->currentTotal ?? 0.000;
                    $arr["withRawDomestic"]["prevCrop"]["prevWeek"] = $delivery->prevTotal ?? 0.000;
                    $withRawDomCTotalprevWeek += $arr["withRawDomestic"]["currentCrop"]["prevWeek"];
                    $withRawDomPTotalprevWeek += $arr["withRawDomestic"]["prevCrop"]["prevWeek"];
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRawDistillery"]["currentCrop"]["prevWeek"] = $delivery->currentTotal ?? 0.000;
                    $arr["withRawDistillery"]["prevCrop"]["prevWeek"] = $delivery->prevTotal ?? 0.000;
                    $withRawDistCTotalprevWeek += $arr["withRawDistillery"]["currentCrop"]["prevWeek"];
                    $withRawDistPTotalprevWeek += $arr["withRawDistillery"]["prevCrop"]["prevWeek"];
                }
            }elseif($delivery->sugar_type == "REFINED"){
                if ($delivery->withdrawal_type == "DOMESTIC") {
                    $arr["withRefinedDomestic"]["currentCrop"]["prevWeek"] = $delivery->currentTotal ?? 0.000;
                    $arr["withRefinedDomestic"]["prevCrop"]["prevWeek"] = $delivery->prevTotal ?? 0.000;
                    $withRefinedDomCTotalprevWeek += $arr["withRefinedDomestic"]["currentCrop"]["prevWeek"];
                    $withRefinedDomPTotalprevWeek += $arr["withRefinedDomestic"]["prevCrop"]["prevWeek"];
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRefinedDistillery"]["currentCrop"]["prevWeek"] = $delivery->currentTotal ?? 0.000;
                    $arr["withRefinedDistillery"]["prevCrop"]["prevWeek"] = $delivery->prevTotal ?? 0.000;
                    $withRefinedDistCTotalprevWeek += $arr["withRefinedDistillery"]["currentCrop"]["prevWeek"];
                    $withRefinedDistPTotalprevWeek += $arr["withRefinedDistillery"]["prevCrop"]["prevWeek"];
                }
            }
        }

        //GET TO DATE VALUES FOR WITHDRAWALS
        $deliveries = $this->getDeliveriesAsOf($currentReportNo,$weeklyReport);
        foreach ($deliveries as $delivery){
            if($delivery->sugar_type == "RAW"){
                if ($delivery->withdrawal_type == "DOMESTIC") {
                    $arr["withRawDomestic"]["currentCrop"]["toDate"] = $delivery->currentTotal ?? 0.000;
                    $arr["withRawDomestic"]["prevCrop"]["toDate"] = $delivery->prevTotal ?? 0.000;
                    $withRawDomCTotaltoDate += $arr["withRawDomestic"]["currentCrop"]["toDate"];
                    $withRawDomPTotaltoDate += $arr["withRawDomestic"]["prevCrop"]["toDate"];
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRawDistillery"]["currentCrop"]["toDate"] = $delivery->currentTotal ?? 0.000;
                    $arr["withRawDistillery"]["prevCrop"]["toDate"] = $delivery->prevTotal ?? 0.000;
                    $withRawDistCTotaltoDate += $arr["withRawDistillery"]["currentCrop"]["toDate"];
                    $withRawDistPTotaltoDate += $arr["withRawDistillery"]["prevCrop"]["toDate"];
                }
            }elseif($delivery->sugar_type == "REFINED"){
                if ($delivery->withdrawal_type == "DOMESTIC") {
                    $arr["withRefinedDomestic"]["currentCrop"]["toDate"] = $delivery->currentTotal ?? 0.000;
                    $arr["withRefinedDomestic"]["prevCrop"]["toDate"] = $delivery->prevTotal ?? 0.000;
                    $withRefinedDomCTotaltoDate += $arr["withRefinedDomestic"]["currentCrop"]["toDate"];
                    $withRefinedDomPTotaltoDate += $arr["withRefinedDomestic"]["prevCrop"]["toDate"];
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRefinedDistillery"]["currentCrop"]["toDate"] = $delivery->currentTotal ?? 0.000;
                    $arr["withRefinedDistillery"]["prevCrop"]["toDate"] = $delivery->prevTotal ?? 0.000;
                    $withRefinedDistCTotaltoDate += $arr["withRefinedDistillery"]["currentCrop"]["toDate"];
                    $withRefinedDistPTotaltoDate += $arr["withRefinedDistillery"]["prevCrop"]["toDate"];
                }
            }
        }

        //RAW WITHDRAWALS TOTAL
        $arr["totalRawWith"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format(($withRawDomCTotalThisWeek) + ($withRawDistCTotalThisWeek), 3, '.', ','),
                "prevWeek"=>number_format(($withRawDomCTotalprevWeek) + ($withRawDistCTotalprevWeek), 3, '.', ','),
                "toDate"=>number_format(($withRawDomCTotaltoDate) + ($withRawDistCTotaltoDate), 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format(($withRawDomPTotalThisWeek) + ($withRawDistPTotalThisWeek), 3, '.', ','),
                "prevWeek"=>number_format(($withRawDomPTotalprevWeek) + ($withRawDistPTotalprevWeek), 3, '.', ','),
                "toDate"=>number_format(($withRawDomPTotaltoDate) + ($withRawDistPTotaltoDate), 3, '.', ','),
            ],
        ];

        //REFINED WITHDRAWALS TOTAL
        $arr["totalRefinedWith"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format(($withRefinedDomCTotalThisWeek) + ($withRefinedDistCTotalThisWeek), 3, '.', ','),
                "prevWeek"=>number_format(($withRefinedDomCTotalprevWeek) + ($withRefinedDistCTotalprevWeek), 3, '.', ','),
                "toDate"=>number_format(($withRefinedDomCTotaltoDate) + ($withRefinedDistCTotaltoDate), 3, '.', ','),
            ],
                        "prevCrop"=>[
                "thisWeek"=>number_format(($withRefinedDomPTotalThisWeek) + ($withRefinedDistPTotalThisWeek), 3, '.', ','),
                "prevWeek"=>number_format(($withRefinedDomPTotalprevWeek) + ($withRefinedDistPTotalprevWeek), 3, '.', ','),
                "toDate"=>number_format(($withRefinedDomPTotaltoDate) + ($withRefinedDistPTotaltoDate), 3, '.', ','),
            ],
        ];

        //OVERALL WITHDRAWALS TOTAL
        $arr["totalOverallWith"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format(($withRawDomCTotalThisWeek) + ($withRawDistCTotalThisWeek) + ($withRefinedDomCTotalThisWeek) + ($withRefinedDistCTotalThisWeek), 3, '.', ','),
                "prevWeek"=>number_format(($withRawDomCTotalprevWeek) + ($withRawDistCTotalprevWeek) + ($withRefinedDomCTotalprevWeek) + ($withRefinedDistCTotalprevWeek), 3, '.', ','),
                "toDate"=>number_format(($withRawDomCTotaltoDate) + ($withRawDistCTotaltoDate) + ($withRefinedDomCTotaltoDate) + ($withRefinedDistCTotaltoDate), 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format(($withRawDomPTotalThisWeek) + ($withRawDistPTotalThisWeek) + ($withRefinedDomPTotalThisWeek) + ($withRefinedDistPTotalThisWeek), 3, '.', ','),
                "prevWeek"=>number_format(($withRawDomPTotalprevWeek) + ($withRawDistPTotalprevWeek) + ($withRefinedDomPTotalprevWeek) + ($withRefinedDistPTotalprevWeek), 3, '.', ','),
                "toDate"=>number_format(($withRawDomPTotaltoDate) + ($withRawDistPTotaltoDate) + ($withRefinedDomPTotaltoDate) + ($withRefinedDistPTotaltoDate), 3, '.', ','),
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
        $balRawCTotaltoDate = ((($toDate->sharePlanter) + ($toDate->shareMiller))-(($withRawDomCTotaltoDate) + ($withRawDistCTotaltoDate))+((($toDate->manufacturedRaw) + ($toDate->rao) + ($toDate->manufacturedRefined) + ($toDate->raoRefined))-(($toDate->sharePlanter) + ($toDate->shareMiller) + ($toDate->refineryMolasses))));
//        PREVIOUS CROP RAW BALANCE 5.1
        $balRawPTotalThisWeek = (($thisWeek->prev_sharePlanter+$thisWeek->prev_shareMiller)-(($withRawDomPTotalThisWeek) + ($withRawDistPTotalThisWeek)));
        $balRawPTotalprevWeek = (($prevWeek->prev_sharePlanter+$prevWeek->prev_shareMiller)+(($withRawDomPTotalprevWeek) + ($withRawDistPTotalprevWeek)));
        $balRawPTotaltoDate = (($toDate->prev_sharePlanter+$toDate->prev_shareMiller)+(($withRawDomPTotaltoDate) + ($withRawDistPTotaltoDate)));

//        CURRENT CROP REFINED BALANCE 5.2
        $balRefinedCTotalThisWeek = (($thisWeek->refineryMolasses)-(($withRefinedDomCTotalThisWeek) + ($withRefinedDistCTotalThisWeek)));
        $balRefinedCTotalprevWeek = (($prevWeek->refineryMolasses) - (($withRefinedDomCTotalprevWeek) + ($withRefinedDistCTotalprevWeek)));
        $balRefinedCTotaltoDate = (($toDate->refineryMolasses) - (($withRefinedDomCTotaltoDate) + ($withRefinedDistCTotaltoDate)));
//        PREVIOUS CROP REFINED BALANCE 5.2
        $balRefinedPTotalThisWeek = (($thisWeek->prev_refineryMolasses)-(($withRefinedDomCTotalThisWeek) + ($withRefinedDistCTotalThisWeek)));
        $balRefinedPTotalprevWeek = (($prevWeek->prev_refineryMolasses)-(($withRefinedDomCTotalThisWeek) + ($withRefinedDistCTotalThisWeek)));
        $balRefinedPTotaltoDate = (($toDate->prev_refineryMolasses)-(($withRefinedDomCTotalThisWeek) + ($withRefinedDistCTotalThisWeek)));

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
//            "prevCrop"=>[
//                "thisWeek"=>number_format($balRefinedPTotalThisWeek, 3, '.', ','),
//                "prevWeek"=>number_format($balRefinedPTotalprevWeek, 3, '.', ','),
//                "toDate"=>  number_format($balRefinedPTotaltoDate, 3, '.', ','),
//            ],

            "prevCrop"=>[
                "thisWeek"=>number_format(($thisWeek->prev_refineryMolasses) - (($withRefinedDomPTotalThisWeek) + ($withRefinedDistPTotalThisWeek)), 3, '.', ','),
                "prevWeek"=>number_format(($prevWeek->prev_refineryMolasses) - (($withRefinedDomPTotalprevWeek) + ($withRefinedDistPTotalprevWeek)), 3, '.', ','),
                "toDate"=>  number_format(($toDate->prev_refineryMolasses) - (($withRefinedDomPTotaltoDate) + ($withRefinedDistPTotaltoDate)), 3, '.', ','),
            ],
        ];

//        $thisWeek->prev_refineryMolasses

        //1/27/2025 LOUIS RENAMED VARIABLE DUE TO CONFLICT WITH FORM 1 VARIABLE
        //TOTAL BALANCE
        $arr["totalBalance3"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($balRefinedCTotalThisWeek + $balRawCTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($balRefinedCTotalprevWeek + $balRawCTotalprevWeek, 3, '.', ','),
                "toDate"=>  number_format($balRefinedCTotaltoDate + $balRawCTotaltoDate, 3, '.', ','),
            ],
//            "prevCrop"=>[
//                "thisWeek"=>number_format($balRefinedPTotalThisWeek + ($balRawPTotalThisWeek*-1), 3, '.', ','),
//                "prevWeek"=>number_format($balRefinedPTotalprevWeek + $balRawPTotalprevWeek, 3, '.', ','),
//                "toDate"=>  number_format($balRefinedPTotaltoDate + $balRawPTotaltoDate, 3, '.', ','),
//            ],

//            "prevCrop"=>[
//                "thisWeek"=>number_format($balRefinedPTotalThisWeek + ($balRawPTotalThisWeek*-1), 3, '.', ','),
//                "prevWeek"=>number_format($balRefinedPTotalprevWeek + $balRawPTotalprevWeek, 3, '.', ','),
//                "toDate"=>  number_format($balRefinedPTotaltoDate + $balRawPTotaltoDate, 3, '.', ','),
//            ],

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
