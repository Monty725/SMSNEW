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
                        $arr["withRawDomestic"]["currentCrop"]["thisWeek"] = $delivery->currentTotal;
                        $arr["withRawDomestic"]["prevCrop"]["thisWeek"] = $delivery->prevTotal;
                        $withRawDomCTotalThisWeek += $arr["withRawDomestic"]["currentCrop"]["thisWeek"];
                        $withRawDomPTotalThisWeek += $arr["withRawDomestic"]["prevCrop"]["thisWeek"];
                    } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                        $arr["withRawDistillery"]["currentCrop"]["thisWeek"] = $delivery->currentTotal;
                        $arr["withRawDistillery"]["prevCrop"]["thisWeek"] = $delivery->prevTotal;
                        $withRawDistCTotalThisWeek += $arr["withRawDistillery"]["currentCrop"]["thisWeek"];
                        $withRawDistPTotalThisWeek += $arr["withRawDistillery"]["prevCrop"]["thisWeek"];
                    }
            }elseif($delivery->sugar_type == "REFINED"){
                    if ($delivery->withdrawal_type == "DOMESTIC") {
                        $arr["withRefinedDomestic"]["currentCrop"]["thisWeek"] = $delivery->currentTotal;
                        $arr["withRefinedDomestic"]["prevCrop"]["thisWeek"] = $delivery->prevTotal;
                        $withRefinedDomCTotalThisWeek += $arr["withRefinedDomestic"]["currentCrop"]["thisWeek"];
                        $withRefinedDomPTotalThisWeek += $arr["withRefinedDomestic"]["prevCrop"]["thisWeek"];
                    } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                        $arr["withRefinedDistillery"]["currentCrop"]["thisWeek"] = $delivery->currentTotal;
                        $arr["withRefinedDistillery"]["prevCrop"]["thisWeek"] = $delivery->prevTotal;
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
                    $arr["withRawDomestic"]["currentCrop"]["prevWeek"] = $delivery->currentTotal;
                    $arr["withRawDomestic"]["prevCrop"]["prevWeek"] = $delivery->prevTotal;
                    $withRawDomCTotalprevWeek += $arr["withRawDomestic"]["currentCrop"]["prevWeek"];
                    $withRawDomPTotalprevWeek += $arr["withRawDomestic"]["prevCrop"]["prevWeek"];
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRawDistillery"]["currentCrop"]["prevWeek"] = $delivery->currentTotal;
                    $arr["withRawDistillery"]["prevCrop"]["prevWeek"] = $delivery->prevTotal;
                    $withRawDistCTotalprevWeek += $arr["withRawDistillery"]["currentCrop"]["prevWeek"];
                    $withRawDistPTotalprevWeek += $arr["withRawDistillery"]["prevCrop"]["prevWeek"];
                }
            }elseif($delivery->sugar_type == "REFINED"){
                if ($delivery->withdrawal_type == "DOMESTIC") {
                    $arr["withRefinedDomestic"]["currentCrop"]["prevWeek"] = $delivery->currentTotal;
                    $arr["withRefinedDomestic"]["prevCrop"]["prevWeek"] = $delivery->prevTotal;
                    $withRefinedDomCTotalprevWeek += $arr["withRefinedDomestic"]["currentCrop"]["prevWeek"];
                    $withRefinedDomPTotalprevWeek += $arr["withRefinedDomestic"]["prevCrop"]["prevWeek"];
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRefinedDistillery"]["currentCrop"]["prevWeek"] = $delivery->currentTotal;
                    $arr["withRefinedDistillery"]["prevCrop"]["prevWeek"] = $delivery->prevTotal;
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
                    $arr["withRawDomestic"]["currentCrop"]["toDate"] = $delivery->currentTotal;
                    $arr["withRawDomestic"]["prevCrop"]["toDate"] = $delivery->prevTotal;
                    $withRawDomCTotaltoDate += $arr["withRawDomestic"]["currentCrop"]["toDate"];
                    $withRawDomPTotaltoDate += $arr["withRawDomestic"]["prevCrop"]["toDate"];
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRawDistillery"]["currentCrop"]["toDate"] = $delivery->currentTotal;
                    $arr["withRawDistillery"]["prevCrop"]["toDate"] = $delivery->prevTotal;
                    $withRawDistCTotaltoDate += $arr["withRawDistillery"]["currentCrop"]["toDate"];
                    $withRawDistPTotaltoDate += $arr["withRawDistillery"]["prevCrop"]["toDate"];
                }
            }elseif($delivery->sugar_type == "REFINED"){
                if ($delivery->withdrawal_type == "DOMESTIC") {
                    $arr["withRefinedDomestic"]["currentCrop"]["toDate"] = $delivery->currentTotal;
                    $arr["withRefinedDomestic"]["prevCrop"]["toDate"] = $delivery->prevTotal;
                    $withRefinedDomCTotaltoDate += $arr["withRefinedDomestic"]["currentCrop"]["toDate"];
                    $withRefinedDomPTotaltoDate += $arr["withRefinedDomestic"]["prevCrop"]["toDate"];
                } elseif ($delivery->withdrawal_type == "DISTILLERY") {
                    $arr["withRefinedDistillery"]["currentCrop"]["toDate"] = $delivery->currentTotal;
                    $arr["withRefinedDistillery"]["prevCrop"]["toDate"] = $delivery->prevTotal;
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

        //NOT COVERED BY MSC
        $arr["notCoveredByMsc"]["currentCrop"]["thisWeek"]=number_format($thisWeek->prev_notCoveredByMsc, 3, '.', ',');
        $arr["notCoveredByMsc"]["currentCrop"]["prevWeek"]=number_format($prevWeek->prev_notCoveredByMsc, 3, '.', ',');
        $arr["notCoveredByMsc"]["currentCrop"]["toDate"]=number_format($toDate->prev_notCoveredByMsc, 3, '.', ',');
        $arr["notCoveredByMsc"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_notCoveredByMsc, 3, '.', ',');
        $arr["notCoveredByMsc"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_notCoveredByMsc, 3, '.', ',');
        $arr["notCoveredByMsc"]["prevCrop"]["toDate"]=number_format($toDate->prev_notCoveredByMsc, 3, '.', ',');

//        $arr["notCoveredByMsc"]["currentCrop"]["thisWeek"]=$thisWeek->prev_notCoveredByMsc
        //PRODUCTION TOTAL
        $arr["totalProduction"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format(($arr["manufacturedRaw"]["currentCrop"]["thisWeek"]=$thisWeek->manufacturedRaw) + ($arr["rao"]["currentCrop"]["thisWeek"]=$thisWeek->rao) + ($arr["manufacturedRefined"]["currentCrop"]["thisWeek"]=$thisWeek->manufacturedRefined) + ($arr["raoRefined"]["currentCrop"]["thisWeek"]=$thisWeek->raoRefined), 3, '.', ','),
                "prevWeek"=>number_format(($arr["manufacturedRaw"]["currentCrop"]["prevWeek"]=$prevWeek->manufacturedRaw) + ($arr["rao"]["currentCrop"]["prevWeek"]=$prevWeek->rao) + ($arr["manufacturedRefined"]["currentCrop"]["prevWeek"]=$prevWeek->manufacturedRefined) + ($arr["raoRefined"]["currentCrop"]["prevWeek"]=$prevWeek->raoRefined), 3, '.', ','),
                "toDate"=>number_format(($arr["manufacturedRaw"]["currentCrop"]["toDate"]=$toDate->manufacturedRaw) + ($arr["rao"]["currentCrop"]["toDate"]=$toDate->rao) + ($arr["manufacturedRefined"]["currentCrop"]["toDate"]=$toDate->manufacturedRefined) + ($arr["raoRefined"]["currentCrop"]["toDate"]=$toDate->raoRefined), 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format(($arr["manufacturedRaw"]["prevCrop"]["thisWeek"]=$thisWeek->prev_manufacturedRaw) + ($arr["rao"]["prevCrop"]["thisWeek"]=$thisWeek->prev_rao) + ($arr["manufacturedRefined"]["prevCrop"]["thisWeek"]=$thisWeek->prev_manufacturedRefined) + ($arr["raoRefined"]["prevCrop"]["thisWeek"]=$thisWeek->prev_raoRefined), 3, '.', ','),
                "prevWeek"=>number_format(($arr["manufacturedRaw"]["prevCrop"]["prevWeek"]=$prevWeek->prev_manufacturedRaw) + ($arr["rao"]["prevCrop"]["prevWeek"]=$prevWeek->prev_rao) + ($arr["manufacturedRefined"]["prevCrop"]["prevWeek"]=$prevWeek->prev_manufacturedRefined) + ($arr["raoRefined"]["prevCrop"]["prevWeek"]=$prevWeek->prev_raoRefined), 3, '.', ','),
                "toDate"=>number_format(($arr["manufacturedRaw"]["prevCrop"]["toDate"]=$toDate->prev_manufacturedRaw) + ($arr["rao"]["prevCrop"]["toDate"]=$toDate->prev_rao) + ($arr["manufacturedRefined"]["prevCrop"]["toDate"]=$toDate->prev_manufacturedRefined) + ($arr["raoRefined"]["prevCrop"]["toDate"]=$toDate->prev_raoRefined), 3, '.', ','),
            ],
        ];

        //ISSUANCES TOTAL
        $arr["totalIssuance"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format(($arr["sharePlanter"]["currentCrop"]["thisWeek"]=$thisWeek->sharePlanter) + ($arr["shareMiller"]["currentCrop"]["thisWeek"]=$thisWeek->shareMiller) + ($arr["refineryMolasses"]["currentCrop"]["thisWeek"]=$thisWeek->refineryMolasses), 3, '.', ','),
                "prevWeek"=>number_format(($arr["sharePlanter"]["currentCrop"]["prevWeek"]=$prevWeek->sharePlanter) + ($arr["shareMiller"]["currentCrop"]["prevWeek"]=$prevWeek->shareMiller) + ($arr["refineryMolasses"]["currentCrop"]["prevWeek"]=$prevWeek->refineryMolasses), 3, '.', ','),
                "toDate"=>number_format(($arr["sharePlanter"]["currentCrop"]["toDate"]=$toDate->sharePlanter) + ($arr["shareMiller"]["currentCrop"]["toDate"]=$toDate->shareMiller) + ($arr["refineryMolasses"]["currentCrop"]["toDate"]=$toDate->refineryMolasses), 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format(($arr["sharePlanter"]["prevCrop"]["thisWeek"]=$thisWeek->prev_sharePlanter) + ($arr["shareMiller"]["prevCrop"]["thisWeek"]=$thisWeek->prev_shareMiller) + ($arr["refineryMolasses"]["prevCrop"]["thisWeek"]=$thisWeek->prev_refineryMolasses), 3, '.', ','),
                "prevWeek"=>number_format(($arr["sharePlanter"]["prevCrop"]["prevWeek"]=$prevWeek->prev_sharePlanter) + ($arr["shareMiller"]["prevCrop"]["prevWeek"]=$prevWeek->prev_shareMiller) + ($arr["refineryMolasses"]["prevCrop"]["prevWeek"]=$prevWeek->prev_refineryMolasses), 3, '.', ','),
                "toDate"=>number_format(($arr["sharePlanter"]["prevCrop"]["toDate"]=$toDate->prev_sharePlanter) + ($arr["shareMiller"]["prevCrop"]["toDate"]=$toDate->prev_shareMiller) + ($arr["refineryMolasses"]["prevCrop"]["toDate"]=$toDate->prev_refineryMolasses), 3, '.', ','),
            ],
        ];

        $balRawCTotalThisWeek = (($arr["sharePlanter"]["currentCrop"]["thisWeek"]=$thisWeek->sharePlanter) + ($arr["shareMiller"]["currentCrop"]["thisWeek"]=$thisWeek->shareMiller) + ($arr["refineryMolasses"]["currentCrop"]["thisWeek"]=$thisWeek->refineryMolasses)) + (($withRawDomCTotalThisWeek) + ($withRawDistCTotalThisWeek)) + ($arr["notCoveredByMsc"]["currentCrop"]["thisWeek"]=$thisWeek->prev_notCoveredByMsc);
        $balRawPTotalThisWeek = (($arr["sharePlanter"]["prevCrop"]["thisWeek"]=$thisWeek->prev_sharePlanter) + ($arr["shareMiller"]["prevCrop"]["thisWeek"]=$thisWeek->prev_shareMiller)) + (($withRawDomPTotalThisWeek) + ($withRawDistPTotalThisWeek) + ($withRefinedDomPTotalThisWeek) + ($withRefinedDistPTotalThisWeek));
        $balRawCTotalprevWeek = (($arr["sharePlanter"]["currentCrop"]["prevWeek"]=$prevWeek->sharePlanter) + ($arr["shareMiller"]["currentCrop"]["prevWeek"]=$prevWeek->shareMiller) + ($arr["refineryMolasses"]["currentCrop"]["prevWeek"]=$prevWeek->refineryMolasses)) + (($withRawDomCTotalprevWeek) + ($withRawDistCTotalprevWeek)) + ($arr["notCoveredByMsc"]["currentCrop"]["prevWeek"]=$prevWeek->prev_notCoveredByMsc);
        $balRawPTotalprevWeek = (($arr["sharePlanter"]["prevCrop"]["prevWeek"]=$prevWeek->prev_sharePlanter) + ($arr["shareMiller"]["prevCrop"]["prevWeek"]=$prevWeek->prev_shareMiller)) + (($withRawDomPTotalprevWeek) + ($withRawDistPTotalprevWeek) + ($withRefinedDomPTotalprevWeek) + ($withRefinedDistPTotalprevWeek));
        $balRawCTotaltoDate = (($arr["sharePlanter"]["currentCrop"]["toDate"]=$toDate->sharePlanter) + ($arr["shareMiller"]["currentCrop"]["toDate"]=$toDate->shareMiller) + ($arr["refineryMolasses"]["currentCrop"]["toDate"]=$toDate->refineryMolasses)) + (($withRawDomCTotaltoDate) + ($withRawDistCTotaltoDate)) + ($arr["notCoveredByMsc"]["currentCrop"]["toDate"]=$toDate->prev_notCoveredByMsc);
        $balRawPTotaltoDate = (($arr["sharePlanter"]["prevCrop"]["toDate"]=$toDate->prev_sharePlanter) + ($arr["shareMiller"]["prevCrop"]["toDate"]=$toDate->prev_shareMiller)) + (($withRawDomPTotaltoDate) + ($withRawDistPTotaltoDate) + ($withRefinedDomPTotaltoDate) + ($withRefinedDistPTotaltoDate));

        $balRefinedCTotalThisWeek = ($arr["refineryMolasses"]["currentCrop"]["thisWeek"]=$thisWeek->refineryMolasses) - (($withRefinedDomCTotalThisWeek) + ($withRefinedDistCTotalThisWeek)) + ($arr["notCoveredByMsc"]["currentCrop"]["thisWeek"]=$thisWeek->prev_notCoveredByMsc);
        $balRefinedPTotalThisWeek = ($arr["refineryMolasses"]["prevCrop"]["thisWeek"]=$thisWeek->prev_refineryMolasses) - (($withRawDomPTotalThisWeek) + ($withRawDistPTotalThisWeek) + ($withRefinedDomPTotalThisWeek) + ($withRefinedDistPTotalThisWeek));
        $balRefinedCTotalprevWeek = ($arr["refineryMolasses"]["currentCrop"]["prevWeek"]=$prevWeek->refineryMolasses) - (($withRefinedDomCTotalprevWeek) + ($withRefinedDistCTotalprevWeek)) + ($arr["notCoveredByMsc"]["currentCrop"]["prevWeek"]=$prevWeek->prev_notCoveredByMsc);
        $balRefinedPTotalprevWeek = ($arr["refineryMolasses"]["prevCrop"]["prevWeek"]=$prevWeek->prev_refineryMolasses) - (($withRawDomPTotalprevWeek) + ($withRawDistPTotalprevWeek) + ($withRefinedDomPTotalprevWeek) + ($withRefinedDistPTotalprevWeek));
        $balRefinedCTotaltoDate = ($arr["refineryMolasses"]["currentCrop"]["toDate"]=$toDate->refineryMolasses) - (($withRefinedDomCTotaltoDate) + ($withRefinedDistCTotaltoDate)) + ($arr["notCoveredByMsc"]["currentCrop"]["toDate"]=$toDate->prev_notCoveredByMsc);
        $balRefinedPTotaltoDate = ($arr["refineryMolasses"]["prevCrop"]["toDate"]=$toDate->prev_refineryMolasses) - (($withRawDomPTotaltoDate) + ($withRawDistPTotaltoDate) + ($withRefinedDomPTotaltoDate) + ($withRefinedDistPTotaltoDate));


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

        //TOTAL BALANCE
        $arr["totalBalance"] = [
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
