<?php

namespace App\Http\Controllers\GetForms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SMS\Form5a\IssuancesOfSro;
use App\Models\SMS\Form5a\Deliveries;


class GetForm2Controller extends Controller
{

    public function getForm2($slug){
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

        $thisWeek = $weeklyReport->form2;
        $prevWeek = $weeklyReport->form2ToDateAsOf($currentReportNo-1);
        $toDate = $weeklyReport->form2ToDateAsOf($currentReportNo);

        $issuanceDomCTotalThisWeek = 0.000;
        $issuanceDomPTotalThisWeek = 0.000;
        $issuanceDomCTotalprevWeek = 0.000;
        $issuanceDomPTotalprevWeek = 0.000;
        $issuanceDomCTotaltoDate = 0.000;
        $issuanceDomPTotaltoDate = 0.000;

        $issuanceImpCTotalThisWeek = 0.000;
        $issuanceImpPTotalThisWeek = 0.000;
        $issuanceImpCTotalprevWeek = 0.000;
        $issuanceImpPTotalprevWeek = 0.000;
        $issuanceImpCTotaltoDate = 0.000;
        $issuanceImpPTotaltoDate = 0.000;

        $withdrawalDomCTotalThisWeek = 0.000;
        $withdrawalDomPTotalThisWeek = 0.000;
        $withdrawalDomCTotalprevWeek = 0.000;
        $withdrawalDomPTotalprevWeek = 0.000;
        $withdrawalDomCTotaltoDate = 0.000;
        $withdrawalDomPTotaltoDate = 0.000;

        $withdrawalImpCTotalThisWeek = 0.000;
        $withdrawalImpPTotalThisWeek = 0.000;
        $withdrawalImpCTotalprevWeek = 0.000;
        $withdrawalImpPTotalprevWeek = 0.000;
        $withdrawalImpCTotaltoDate = 0.000;
        $withdrawalImpPTotaltoDate = 0.000;

        function formatValue($value) {
            return $value < 0 ? '(' . number_format(abs($value), 3, '.', ',') . ')' : number_format($value, 3, '.', ',');
        }

        //ISSUANCE COMPUTATION --------------------------------------------------------- START
        //GET THIS WEEK VALUES FOR ISSUANCES
        $deliveries = $weeklyReport->form5aIssuancesOfSro()
            ->selectRaw('consumption,sum(refined_qty) as currentTotal, sum(prev_refined_qty) as prevTotal')
            ->get();

        foreach ($deliveries as $delivery){
            if($delivery->consumption == "DOMESTIC"){
                //IF DOMESTIC ISSUANCE
                $arr["issuanceDomestic"]["currentCrop"]["thisWeek"] = $delivery->currentTotal;
                $arr["issuanceDomestic"]["prevCrop"]["thisWeek"] = $delivery->prevTotal;
                $issuanceDomCTotalThisWeek += $arr["issuanceDomestic"]["currentCrop"]["thisWeek"];
                $issuanceDomPTotalThisWeek += $arr["issuanceDomestic"]["prevCrop"]["thisWeek"];
            }else if($delivery->consumption == "IMPORTED"){
                //IF IMPORTED ISSUANCE
                $arr["issuanceImported"]["currentCrop"]["thisWeek"] = $delivery->currentTotal;
                $arr["issuanceImported"]["prevCrop"]["thisWeek"] = $delivery->prevTotal;
                $issuanceImpCTotalThisWeek += $arr["issuanceImported"]["currentCrop"]["thisWeek"];
                $issuanceImpPTotalThisWeek += $arr["issuanceImported"]["prevCrop"]["thisWeek"];
            }
        }

        //GET PREV WEEK VALUES FOR ISSUANCES
        $deliveries_sro = $this->getDeliveriesAsOfSro($currentReportNo * 1 - 1,$weeklyReport);
        foreach ($deliveries_sro as $delivery){
            if($delivery->consumption == "DOMESTIC"){
                //if not for refining
                $arr["issuanceDomestic"]["currentCrop"]["prevWeek"] = $delivery->currentTotal;
                $arr["issuanceDomestic"]["prevCrop"]["prevWeek"] = $delivery->prevTotal;
                $issuanceDomCTotalprevWeek += $arr["issuanceDomestic"]["currentCrop"]["prevWeek"];
                $issuanceDomPTotalprevWeek += $arr["issuanceDomestic"]["prevCrop"]["prevWeek"];
            }else if($delivery->consumption == "IMPORTED"){
                //if for refining
                $arr["issuanceImported"]["currentCrop"]["prevWeek"] = $delivery->currentTotal;
                $arr["issuanceImported"]["prevCrop"]["prevWeek"] = $delivery->prevTotal;
                $issuanceImpCTotalprevWeek += $arr["issuanceImported"]["currentCrop"]["prevWeek"];
                $issuanceImpPTotalprevWeek += $arr["issuanceImported"]["prevCrop"]["prevWeek"];
            }
        }

        //GET TO DATE VALUES FOR ISSUANCES
        $deliveries_sro = $this->getDeliveriesAsOfSro($currentReportNo,$weeklyReport);
        foreach ($deliveries_sro as $delivery){
            if($delivery->consumption == "DOMESTIC"){
                //if not for refining
                $arr["issuanceDomestic"]["currentCrop"]["toDate"] = $delivery->currentTotal;
                $arr["issuanceDomestic"]["prevCrop"]["toDate"] = $delivery->prevTotal;
                $issuanceDomCTotaltoDate += $arr["issuanceDomestic"]["currentCrop"]["toDate"];
                $issuanceDomPTotaltoDate += $arr["issuanceDomestic"]["prevCrop"]["toDate"];
            }else if($delivery->consumption == "IMPORTED"){
                //if for refining
                $arr["issuanceImported"]["currentCrop"]["toDate"] = $delivery->currentTotal;
                $arr["issuanceImported"]["prevCrop"]["toDate"] = $delivery->prevTotal;
                $issuanceImpCTotaltoDate += $arr["issuanceImported"]["currentCrop"]["toDate"];
                $issuanceImpPTotaltoDate += $arr["issuanceImported"]["prevCrop"]["toDate"];
            }
        }

        //TOTAL DOMESTIC ISSUANCE
        $arr["totalIssuanceDomestic"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($issuanceDomCTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($issuanceDomCTotalprevWeek, 3, '.', ','),
                "toDate"=>number_format($issuanceDomCTotaltoDate, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format($issuanceDomPTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($issuanceDomPTotalprevWeek, 3, '.', ','),
                "toDate"=>number_format($issuanceDomPTotaltoDate, 3, '.', ','),
            ],
        ];

        //TOTAL IMPORTED ISSUANCE
        $arr["totalIssuanceImported"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($issuanceImpCTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($issuanceImpCTotalprevWeek, 3, '.', ','),
                "toDate"=>number_format($issuanceImpCTotaltoDate, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format($issuanceImpPTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($issuanceImpPTotalprevWeek, 3, '.', ','),
                "toDate"=>number_format($issuanceImpPTotaltoDate, 3, '.', ','),
            ],
        ];

        //TOTAL OVERALL ISSUANCE
        $arr["totalIssuanceOverall"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($issuanceImpCTotalThisWeek + $issuanceDomCTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($issuanceImpCTotalprevWeek + $issuanceDomCTotalprevWeek, 3, '.', ','),
                "toDate"=>number_format($issuanceImpCTotaltoDate + $issuanceDomCTotaltoDate, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format($issuanceImpPTotalThisWeek + $issuanceDomPTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($issuanceImpPTotalprevWeek + $issuanceDomPTotalprevWeek, 3, '.', ','),
                "toDate"=>number_format($issuanceImpPTotaltoDate + $issuanceDomPTotaltoDate, 3, '.', ','),
            ],
        ];
        //ISSUANCE COMPUTATION --------------------------------------------------------- END

        //WITHDRAWAL COMPUTATION ------------------------------------------------------- START
        //GET THIS WEEK VALUES FOR WITHDRAWALS
        $deliveries = $weeklyReport->form5aDeliveries()
            ->selectRaw('consumption,sum(qty_current) as currentTotal, sum(qty_prev) as prevTotal')
            ->get();
        foreach ($deliveries as $delivery){
            if($delivery->consumption == "DOMESTIC"){
                //IF DOMESTIC WITHDRAWAL
                $arr["withdrawalDomestic"]["currentCrop"]["thisWeek"] = $delivery->currentTotal;
                $arr["withdrawalDomestic"]["prevCrop"]["thisWeek"] = $delivery->prevTotal;
                $withdrawalDomCTotalThisWeek += $arr["withdrawalDomestic"]["currentCrop"]["thisWeek"];
                $withdrawalDomPTotalThisWeek += $arr["withdrawalDomestic"]["prevCrop"]["thisWeek"];
            }else{
                //IF IMPORTED WITHDRAWAL
                $arr["withdrawalImported"]["currentCrop"]["thisWeek"] = $delivery->currentTotal;
                $arr["withdrawalImported"]["prevCrop"]["thisWeek"] = $delivery->prevTotal;
                $withdrawalImpCTotalThisWeek += $arr["withdrawalImported"]["currentCrop"]["thisWeek"];
                $withdrawalImpPTotalThisWeek += $arr["withdrawalImported"]["prevCrop"]["thisWeek"];
            }
        }

        //GET PREV WEEK VALUES FOR WITHDRAWALS
        $deliveries = $this->getDeliveriesAsOf($currentReportNo * 1 - 1,$weeklyReport);
        foreach ($deliveries as $delivery){
            if($delivery->consumption == "DOMESTIC"){
                //if not for refining
                $arr["withdrawalDomestic"]["currentCrop"]["prevWeek"] = $delivery->currentTotal;
                $arr["withdrawalDomestic"]["prevCrop"]["prevWeek"] = $delivery->prevTotal;
                $withdrawalDomCTotalprevWeek += $arr["withdrawalDomestic"]["currentCrop"]["prevWeek"];
                $withdrawalDomPTotalprevWeek += $arr["withdrawalDomestic"]["prevCrop"]["prevWeek"];
            }else{
                //if for refining
                $arr["withdrawalImported"]["currentCrop"]["prevWeek"] = $delivery->currentTotal;
                $arr["withdrawalImported"]["prevCrop"]["prevWeek"] = $delivery->prevTotal;
                $withdrawalImpCTotalprevWeek += $arr["withdrawalImported"]["currentCrop"]["prevWeek"];
                $withdrawalImpPTotalprevWeek += $arr["withdrawalImported"]["prevCrop"]["prevWeek"];
            }
        }

        //GET TO DATE VALUES FOR WITHDRAWALS
        $deliveries = $this->getDeliveriesAsOf($currentReportNo,$weeklyReport);
        foreach ($deliveries as $delivery){
            if($delivery->consumption == "DOMESTIC"){
                //if not for refining
                $arr["withdrawalDomestic"]["currentCrop"]["toDate"] = $delivery->currentTotal;
                $arr["withdrawalDomestic"]["prevCrop"]["toDate"] = $delivery->prevTotal;
                $withdrawalDomCTotaltoDate += $arr["withdrawalDomestic"]["currentCrop"]["toDate"];
                $withdrawalDomPTotaltoDate += $arr["withdrawalDomestic"]["prevCrop"]["toDate"];
            }else{
                //if for refining
                $arr["withdrawalImported"]["currentCrop"]["toDate"] = $delivery->currentTotal;
                $arr["withdrawalImported"]["prevCrop"]["toDate"] = $delivery->prevTotal;
                $withdrawalImpCTotaltoDate += $arr["withdrawalImported"]["currentCrop"]["toDate"];
                $withdrawalImpPTotaltoDate += $arr["withdrawalImported"]["prevCrop"]["toDate"];
            }
        }

        //TOTAL DOMESTIC WITHDRAWAL
        $arr["totalWithdrawalDomestic"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($withdrawalDomCTotalThisWeek ?? 0, 3, '.', ','),
                "prevWeek"=>number_format($withdrawalDomCTotalprevWeek ?? 0, 3, '.', ','),
                "toDate"=>number_format($withdrawalDomCTotaltoDate ?? 0, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format($withdrawalDomPTotalThisWeek ?? 0, 3, '.', ','),
                "prevWeek"=>number_format($withdrawalDomPTotalprevWeek ?? 0, 3, '.', ','),
                "toDate"=>number_format($withdrawalDomPTotaltoDate ?? 0, 3, '.', ','),
            ],
        ];

        //TOTAL IMPORTED WITHDRAWAL
        $arr["totalWithdrawalImported"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($withdrawalImpCTotalThisWeek ?? 0, 3, '.', ','),
                "prevWeek"=>number_format($withdrawalImpCTotalprevWeek ?? 0, 3, '.', ','),
                "toDate"=>number_format($withdrawalImpCTotaltoDate ?? 0, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format($withdrawalImpPTotalThisWeek ?? 0, 3, '.', ','),
                "prevWeek"=>number_format($withdrawalImpPTotalprevWeek ?? 0, 3, '.', ','),
                "toDate"=>number_format($withdrawalImpPTotaltoDate ?? 0, 3, '.', ','),
            ],
        ];

        //TOTAL OVERALL WITHDRAWAL
        $arr["totalWithdrawalOverall"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($withdrawalImpCTotalThisWeek + $withdrawalDomCTotalThisWeek ?? 0, 3, '.', ','),
                "prevWeek"=>number_format($withdrawalImpCTotalprevWeek + $withdrawalDomCTotalprevWeek ?? 0, 3, '.', ','),
                "toDate"=>number_format($withdrawalImpCTotaltoDate + $withdrawalDomCTotaltoDate ?? 0, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format($withdrawalImpPTotalThisWeek + $withdrawalDomPTotalThisWeek ?? 0, 3, '.', ','),
                "prevWeek"=>number_format($withdrawalImpPTotalprevWeek + $withdrawalDomPTotalprevWeek ?? 0, 3, '.', ','),
                "toDate"=>number_format($withdrawalImpPTotaltoDate + $withdrawalDomPTotaltoDate ?? 0, 3, '.', ','),
            ],
        ];
        //WITHDRAWAL COMPUTATION ------------------------------------------------------- END

        //number_format($ReceiptCTotalThisWeek, 3, '.', ',')
        //CARRY-OVER COMPUTATION
        $arr["carryOver"]["currentCrop"]["thisWeek"]=$thisWeek->carryOver;
        $arr["carryOver"]["currentCrop"]["prevWeek"]=number_format($prevWeek->carryOver, 3, '.', ',');
        $arr["carryOver"]["currentCrop"]["toDate"]=number_format($toDate->carryOver, 3, '.', ',');
        $arr["carryOver"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_carryOver ?? 0, 3, '.', ',');
        $arr["carryOver"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_carryOver ?? 0, 3, '.', ',');
        $arr["carryOver"]["prevCrop"]["toDate"]=number_format($toDate->prev_carryOver ?? 0, 3, '.', ',');

        //COVERED BY SRO COMPUTATION
        $arr["coveredBySro"]["currentCrop"]["thisWeek"]=number_format($thisWeek->coveredBySro, 3, '.', ',');
        $arr["coveredBySro"]["currentCrop"]["prevWeek"]=number_format($prevWeek->coveredBySro, 3, '.', ',');
        $arr["coveredBySro"]["currentCrop"]["toDate"]=number_format($toDate->coveredBySro, 3, '.', ',');
        $arr["coveredBySro"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_coveredBySro, 3, '.', ',');
        $arr["coveredBySro"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_coveredBySro, 3, '.', ',');
        $arr["coveredBySro"]["prevCrop"]["toDate"]=number_format($toDate->prev_coveredBySro, 3, '.', ',');

        //NOT COVERED BY SRO COMPUTATION
        $arr["notCoveredBySro"]["currentCrop"]["thisWeek"]=number_format($thisWeek->notCoveredBySro, 3, '.', ',');
        $arr["notCoveredBySro"]["currentCrop"]["prevWeek"]=number_format($prevWeek->notCoveredBySro, 3, '.', ',');
        $arr["notCoveredBySro"]["currentCrop"]["toDate"]=number_format($toDate->notCoveredBySro, 3, '.', ',');
        $arr["notCoveredBySro"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_notCoveredBySro, 3, '.', ',');
        $arr["notCoveredBySro"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_notCoveredBySro, 3, '.', ',');
        $arr["notCoveredBySro"]["prevCrop"]["toDate"]=number_format($toDate->prev_notCoveredBySro, 3, '.', ',');

        //OTHER MILLS COMPUTATION
        $arr["otherMills"]["currentCrop"]["thisWeek"]=number_format($thisWeek->otherMills, 3, '.', ',');
        $arr["otherMills"]["currentCrop"]["prevWeek"]=number_format($prevWeek->otherMills, 3, '.', ',');
        $arr["otherMills"]["currentCrop"]["toDate"]=number_format($toDate->otherMills, 3, '.', ',');
        $arr["otherMills"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_otherMills, 3, '.', ',');
        $arr["otherMills"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_otherMills, 3, '.', ',');
        $arr["otherMills"]["prevCrop"]["toDate"]=number_format($toDate->prev_otherMills, 3, '.', ',');

        //IMPORTED COMPUTATION
        $arr["imported"]["currentCrop"]["thisWeek"]=number_format($thisWeek->imported, 3, '.', ',');
        $arr["imported"]["currentCrop"]["prevWeek"]=number_format($prevWeek->imported, 3, '.', ',');
        $arr["imported"]["currentCrop"]["toDate"]=number_format($toDate->imported, 3, '.', ',');
        $arr["imported"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_imported, 3, '.', ',');
        $arr["imported"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_imported, 3, '.', ',');
        $arr["imported"]["prevCrop"]["toDate"]=number_format($toDate->prev_imported, 3, '.', ',');

        //MELTED COMPUTATION
        $arr["melted"]["currentCrop"]["thisWeek"]=number_format($thisWeek->melted, 3, '.', ',');
        $arr["melted"]["currentCrop"]["prevWeek"]=number_format($prevWeek->melted, 3, '.', ',');
        $arr["melted"]["currentCrop"]["toDate"]=number_format($toDate->melted, 3, '.', ',');
        $arr["melted"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_melted ?? 0, 3, '.', ',');
        $arr["melted"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_melted, 3, '.', ',');
        $arr["melted"]["prevCrop"]["toDate"]=number_format($toDate->prev_melted, 3, '.', ',');

        //RAW WITHDRAWALS COMPUTATION
        $arr["rawWithdrawals"]["currentCrop"]["thisWeek"]=number_format($thisWeek->rawWithdrawals, 3, '.', ',');
        $arr["rawWithdrawals"]["currentCrop"]["prevWeek"]=number_format($prevWeek->rawWithdrawals, 3, '.', ',');
        $arr["rawWithdrawals"]["currentCrop"]["toDate"]=number_format($toDate->rawWithdrawals, 3, '.', ',');
        $arr["rawWithdrawals"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_rawWithdrawals, 3, '.', ',');
        $arr["rawWithdrawals"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_rawWithdrawals, 3, '.', ',');
        $arr["rawWithdrawals"]["prevCrop"]["toDate"]=number_format($toDate->prev_rawWithdrawals, 3, '.', ',');


        //PRODUCTION DOMESTIC
        $arr["prodDomestic"]["currentCrop"]["thisWeek"]=number_format($thisWeek->prodDomestic, 3, '.', ',');
        $arr["prodDomestic"]["currentCrop"]["prevWeek"]=number_format($prevWeek->prodDomestic, 3, '.', ',');
        $arr["prodDomestic"]["currentCrop"]["toDate"]=number_format($toDate->prodDomestic, 3, '.', ',');
        $arr["prodDomestic"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_prodDomestic, 3, '.', ',');
        $arr["prodDomestic"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_prodDomestic, 3, '.', ',');
        $arr["prodDomestic"]["prevCrop"]["toDate"]=number_format($toDate->prev_prodDomestic, 3, '.', ',');

        //PRODUCTION IMPORTED
//        $arr["prodImported"]["currentCrop"]["thisWeek"]=number_format($thisWeek->prodImported ?? 0, 3, '.', ',');
//        $arr["prodImported"]["currentCrop"]["prevWeek"]=number_format($prevWeek->prodImported ?? 0, 3, '.', ',');
//        $arr["prodImported"]["currentCrop"]["toDate"]=number_format($toDate->prodImported ?? 0, 3, '.', ',');
//        $arr["prodImported"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_prodImported ?? 0, 3, '.', ',');
//        $arr["prodImported"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_prodImported ?? 0, 3, '.', ',');
//        $arr["prodImported"]["prevCrop"]["toDate"]=number_format($toDate->prev_prodImported ?? 0, 3, '.', ',');

        //PRODUCTION IMPORTED
        $arr["prodImported"]["currentCrop"]["thisWeek"]=number_format($thisWeek->prodImported, 3, '.', ',');
        $arr["prodImported"]["currentCrop"]["prevWeek"]=number_format($prevWeek->prodImported, 3, '.', ',');
        $arr["prodImported"]["currentCrop"]["toDate"]=number_format($toDate->prodImported, 3, '.', ',');
        $arr["prodImported"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_prodImported, 3, '.', ',');
        $arr["prodImported"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_prodImported, 3, '.', ',');
        $arr["prodImported"]["prevCrop"]["toDate"]=number_format($toDate->prev_prodImported, 3, '.', ',');

        //PRODUCTION OVERAGES
        $arr["overage"]["currentCrop"]["thisWeek"]=number_format($thisWeek->overage, 3, '.', ',');
        $arr["overage"]["currentCrop"]["prevWeek"]=number_format($prevWeek->overage, 3, '.', ',');
        $arr["overage"]["currentCrop"]["toDate"]=number_format($toDate->overage, 3, '.', ',');
        $arr["overage"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_overage, 3, '.', ',');
        $arr["overage"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_overage, 3, '.', ',');
        $arr["overage"]["prevCrop"]["toDate"]=number_format($toDate->prev_overage, 3, '.', ',');


        //TOTAL REFINED
//        $arr["totalRefined"] = [
//            "currentCrop"=>[
//                "thisWeek"=>number_format($arr["prodDomestic"]["currentCrop"]["thisWeek"]=$thisWeek->prodDomestic + $arr["prodImported"]["currentCrop"]["thisWeek"]=$thisWeek->prodImported + $arr["overage"]["currentCrop"]["thisWeek"]=$thisWeek->overage ?? 0, 3, '.', ','),
//                "prevWeek"=>number_format($arr["prodDomestic"]["currentCrop"]["prevWeek"]=$prevWeek->prodDomestic + $arr["prodImported"]["currentCrop"]["prevWeek"]=$prevWeek->prodImported + $arr["overage"]["currentCrop"]["prevWeek"]=$prevWeek->overage?? 0, 3, '.', ','),
//                "toDate"=>number_format($arr["prodDomestic"]["currentCrop"]["toDate"]=$toDate->prodDomestic + $arr["prodImported"]["currentCrop"]["toDate"]=$toDate->prodImported + $arr["overage"]["currentCrop"]["toDate"]=$toDate->overage?? 0, 3, '.', ','),
//            ],
//            "prevCrop"=>[
//                "thisWeek"=>number_format($arr["prodDomestic"]["prevCrop"]["thisWeek"]=$thisWeek->prev_prodDomestic + $arr["prodImported"]["prevCrop"]["thisWeek"]=$thisWeek->prev_prodImported + $arr["overage"]["prevCrop"]["thisWeek"]=$thisWeek->prev_overage ?? 0, 3, '.', ','),
//                "prevWeek"=>number_format($arr["prodDomestic"]["prevCrop"]["prevWeek"]=$prevWeek->prev_prodDomestic + $arr["prodImported"]["prevCrop"]["prevWeek"]=$prevWeek->prev_prodImported + $arr["overage"]["prevCrop"]["prevWeek"]=$prevWeek->prev_overage ?? 0, 3, '.', ','),
//                "toDate"=>number_format($arr["prodDomestic"]["prevCrop"]["toDate"]=$toDate->prev_prodDomestic + $arr["prodImported"]["prevCrop"]["toDate"]=$toDate->prev_prodImported + $arr["overage"]["prevCrop"]["toDate"]=$toDate->prev_overage ?? 0, 3, '.', ','),
//            ],
//        ];

        $arr["totalRefined"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($thisWeek->prodDomestic + $thisWeek->prodImported + $thisWeek->overage ?? 0, 3, '.', ','),
                "prevWeek"=>number_format($prevWeek->prodDomestic + $prevWeek->prodImported + $prevWeek->overage?? 0, 3, '.', ','),
                "toDate"=>number_format($toDate->prodDomestic + $toDate->prodImported + $toDate->overage?? 0, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format($thisWeek->prev_prodDomestic + $thisWeek->prev_prodImported + $thisWeek->prev_overage ?? 0, 3, '.', ','),
                "prevWeek"=>number_format($prevWeek->prev_prodDomestic + $prevWeek->prev_prodImported + $prevWeek->prev_overage ?? 0, 3, '.', ','),
                "toDate"=>number_format($toDate->prev_prodDomestic + $toDate->prev_prodImported + $toDate->prev_overage ?? 0, 3, '.', ','),
            ],
        ];


        //RETURN TO PROCESS
        $arr["prodReturn"]["currentCrop"]["thisWeek"]=number_format($thisWeek->prodReturn, 3, '.', ',');
        $arr["prodReturn"]["currentCrop"]["prevWeek"]=number_format($prevWeek->prodReturn ?? 0, 3, '.', ',');
        $arr["prodReturn"]["currentCrop"]["toDate"]=number_format($toDate->prodReturn, 3, '.', ',');
        $arr["prodReturn"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_prodReturn ?? 0, 3, '.', ',');
        $arr["prodReturn"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_prodReturn ?? 0, 3, '.', ',');
        $arr["prodReturn"]["prevCrop"]["toDate"]=number_format($toDate->prev_prodReturn ?? 0, 3, '.', ',');

        //PRODUCTION NET
        $arr["prodNet"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format(($thisWeek->prodDomestic + $thisWeek->prodImported + $thisWeek->overage) - $thisWeek->prodReturn, 3, '.', ','),
                "prevWeek"=>number_format(($prevWeek->prodDomestic + $prevWeek->prodImported + $prevWeek->overage) - $prevWeek->prodReturn, 3, '.', ','),
                "toDate"=>number_format(($toDate->prodDomestic + $toDate->prodImported + $toDate->overage) - $toDate->prodReturn, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format(($thisWeek->prev_prodDomestic + $thisWeek->prev_prodImported + $thisWeek->prev_overage) - $thisWeek->prev_prodReturn, 3, '.', ','),
                "prevWeek"=>number_format(($prevWeek->prev_prodDomestic + $prevWeek->prev_prodImported + $prevWeek->prev_overage) - $prevWeek->prev_prodReturn, 3, '.', ','),
                "toDate"=>number_format(($toDate->prev_prodDomestic + $toDate->prev_prodImported + $toDate->prev_overage) - $toDate->prev_prodReturn, 3, '.', ','),
            ],
        ];

        //OLD TOTAL RECEIPT
//        $arr["totalReceipt"] = [
//            "currentCrop"=>[
//                "thisWeek"=>number_format($arr["coveredBySro"]["currentCrop"]["thisWeek"] + $arr["otherMills"]["currentCrop"]["thisWeek"] + $arr["imported"]["currentCrop"]["thisWeek"] + $arr["notCoveredBySro"]["currentCrop"]["thisWeek"], 3, '.', ','),
//                "prevWeek"=>number_format($arr["coveredBySro"]["currentCrop"]["prevWeek"] + $arr["otherMills"]["currentCrop"]["prevWeek"] + $arr["imported"]["currentCrop"]["prevWeek"] + $arr["notCoveredBySro"]["currentCrop"]["prevWeek"], 3, '.', ','),
//                "toDate"=>number_format($arr["coveredBySro"]["currentCrop"]["toDate"] + $arr["otherMills"]["currentCrop"]["toDate"] + $arr["imported"]["currentCrop"]["toDate"] + $arr["notCoveredBySro"]["currentCrop"]["toDate"], 3, '.', ','),
//            ],
//            "prevCrop"=>[
//                "thisWeek"=>number_format($arr["coveredBySro"]["prevCrop"]["thisWeek"] + $arr["otherMills"]["prevCrop"]["thisWeek"] + $arr["imported"]["prevCrop"]["thisWeek"] + $arr["notCoveredBySro"]["prevCrop"]["thisWeek"], 3, '.', ','),
//                "prevWeek"=>number_format($arr["coveredBySro"]["prevCrop"]["prevWeek"] + $arr["otherMills"]["prevCrop"]["prevWeek"] + $arr["imported"]["prevCrop"]["prevWeek"] + $arr["notCoveredBySro"]["prevCrop"]["prevWeek"], 3, '.', ','),
//                "toDate"=>number_format($arr["coveredBySro"]["prevCrop"]["toDate"] + $arr["otherMills"]["prevCrop"]["toDate"] + $arr["imported"]["prevCrop"]["toDate"] + $arr["notCoveredBySro"]["prevCrop"]["toDate"], 3, '.', ','),
//            ],
//        ];

        //NEW TOTAL RECEIPT
        $arr["totalReceipt"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($thisWeek->coveredBySro + $thisWeek->otherMills + $thisWeek->imported + $thisWeek->notCoveredBySro, 3, '.', ','),
                "prevWeek"=>number_format($prevWeek->coveredBySro + $prevWeek->otherMills + $prevWeek->imported + $prevWeek->notCoveredBySro, 3, '.', ','),
                "toDate"=>number_format($toDate->coveredBySro + $toDate->otherMills + $toDate->imported + $toDate->notCoveredBySro, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format($thisWeek->prev_coveredBySro + $thisWeek->prev_otherMills + $thisWeek->prev_imported + $thisWeek->prev_notCoveredBySro, 3, '.', ','),
                "prevWeek"=>number_format($prevWeek->prev_coveredBySro + $prevWeek->prev_otherMills + $prevWeek->prev_imported + $prevWeek->prev_notCoveredBySro, 3, '.', ','),
                "toDate"=>number_format($toDate->prev_coveredBySro + $toDate->prev_otherMills + $toDate->prev_imported + $toDate->prev_notCoveredBySro, 3, '.', ','),
            ],
        ];

        //BALANCE RAW
        $arr["balanceRaw"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format(($thisWeek->coveredBySro + $thisWeek->otherMills + $thisWeek->imported + $thisWeek->notCoveredBySro) - ($thisWeek->melted) - ($thisWeek->rawWithdrawals), 3, '.', ','),
                "prevWeek"=>number_format(($prevWeek->coveredBySro + $prevWeek->otherMills + $prevWeek->imported + $prevWeek->notCoveredBySro) - ($prevWeek->melted) - ($prevWeek->rawWithdrawals), 3, '.', ','),
                "toDate"=>number_format(($toDate->coveredBySro + $toDate->otherMills + $toDate->imported + $toDate->notCoveredBySro) - ($toDate->melted) - ($toDate->rawWithdrawals), 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format(($thisWeek->prev_carryOver) - ($thisWeek->prev_melted) - ($thisWeek->prev_rawWithdrawals), 3, '.', ','),
                "prevWeek"=>number_format(($prevWeek->prev_carryOver) - ($prevWeek->prev_melted) - ($prevWeek->prev_rawWithdrawals), 3, '.', ','),
                "toDate"=>number_format(($toDate->prev_carryOver) - ($toDate->prev_melted) - ($toDate->prev_rawWithdrawals), 3, '.', ','),
            ],
        ];

        //STOCK BALANCE
        $arr["stockBalance"] = [
            "currentCrop"=>[
                "thisWeek"=>formatValue(($issuanceImpCTotalThisWeek + $issuanceDomCTotalThisWeek)-($withdrawalImpCTotalThisWeek + $withdrawalDomCTotalThisWeek)),
                "prevWeek"=>formatValue(($issuanceImpCTotalprevWeek + $issuanceDomCTotalprevWeek)-($withdrawalImpCTotalprevWeek + $withdrawalDomCTotalprevWeek)),
                "toDate"=>formatValue(($issuanceImpCTotaltoDate + $issuanceDomCTotaltoDate)-($withdrawalImpCTotaltoDate + $withdrawalDomCTotaltoDate)),
            ],
            "prevCrop"=>[
                "thisWeek"=>formatValue(($thisWeek->prev_prodDomestic + $thisWeek->prev_prodImported + $thisWeek->prev_overage + $issuanceImpPTotalThisWeek + $issuanceDomPTotalThisWeek)-($withdrawalImpPTotalThisWeek + $withdrawalDomPTotalThisWeek)),
                "prevWeek"=>formatValue(($prevWeek->prev_prodDomestic + $prevWeek->prev_prodImported + $prevWeek->prev_overage + $issuanceImpPTotalprevWeek + $issuanceDomPTotalprevWeek)-($withdrawalImpPTotalprevWeek + $withdrawalDomPTotalprevWeek)),
                "toDate"=>formatValue(($toDate->prev_prodDomestic + $toDate->prev_prodImported + $toDate->prev_overage + $issuanceImpPTotaltoDate + $issuanceDomPTotaltoDate)-($withdrawalImpPTotaltoDate + $withdrawalDomPTotaltoDate)),
            ],
        ];

        //UNQUEDANNED
//        $arr["unquedanned"] = [
//            "currentCrop"=>[
//                "thisWeek"=>$arr["prodNet"]["currentCrop"]["thisWeek"]-(($issuanceImpCTotalThisWeek) + ($issuanceDomCTotalThisWeek)),
//                "prevWeek"=>$arr["prodNet"]["currentCrop"]["prevWeek"]-(($issuanceImpCTotalprevWeek) + ($issuanceDomCTotalprevWeek)),
//                "toDate"=>$arr["prodNet"]["currentCrop"]["toDate"]-(($issuanceImpCTotaltoDate) + ($issuanceDomCTotaltoDate)),
//            ],
//            "prevCrop"=>[
//                "thisWeek"=>$arr["prodNet"]["prevCrop"]["thisWeek"]-(($issuanceImpPTotalThisWeek) + ($issuanceDomPTotalThisWeek)),
//                "prevWeek"=>$arr["prodNet"]["prevCrop"]["prevWeek"]-(($issuanceImpPTotalprevWeek) + ($issuanceDomPTotalprevWeek)),
//                "toDate"=>$arr["prodNet"]["prevCrop"]["toDate"]-(($issuanceImpPTotaltoDate) + ($issuanceDomPTotaltoDate)),
//            ],
//        ];

//        $arr["unquedanned"] = [
//            "currentCrop"=>[
//                "thisWeek"=>($thisWeek->prodDomestic + $thisWeek->prodImported) - $thisWeek->prodReturn -(($issuanceImpCTotalThisWeek) + ($issuanceDomCTotalThisWeek)),
//                "prevWeek"=>($prevWeek->prodDomestic + $prevWeek->prodImported) - $prevWeek->prodReturn -(($issuanceImpCTotalprevWeek) + ($issuanceDomCTotalprevWeek)),
//                "toDate"=>($toDate->prodDomestic + $toDate->prodImported) - $toDate->prodReturn -(($issuanceImpCTotaltoDate) + ($issuanceDomCTotaltoDate)),
//            ],
//            "prevCrop"=>[
//                "thisWeek"=>($thisWeek->prev_prodDomestic + $thisWeek->prev_prodImported) - $thisWeek->prev_prodReturn -(($issuanceImpPTotalThisWeek) + ($issuanceDomPTotalThisWeek)),
//                "prevWeek"=>($prevWeek->prev_prodDomestic + $prevWeek->prev_prodImported) - $prevWeek->prev_prodReturn -(($issuanceImpPTotalprevWeek) + ($issuanceDomPTotalprevWeek)),
//                "toDate"=>($toDate->prev_prodDomestic + $toDate->prev_prodImported) - $toDate->prev_prodReturn -(($issuanceImpPTotaltoDate) + ($issuanceDomPTotaltoDate)),
//            ],
//        ];




//        $arr["form2_unquedanned"] = [
//            "currentCrop"=>[
//                "thisWeek"=>($thisWeek->prodDomestic + $thisWeek->prodImported) - $thisWeek->prodReturn -(($issuanceImpCTotalThisWeek) + ($issuanceDomCTotalThisWeek)),
//                "prevWeek"=>($prevWeek->prodDomestic + $prevWeek->prodImported) - $prevWeek->prodReturn -(($issuanceImpCTotalprevWeek) + ($issuanceDomCTotalprevWeek)),
//                "toDate"=>($toDate->prodDomestic + $toDate->prodImported) - $toDate->prodReturn -(($issuanceImpCTotaltoDate) + ($issuanceDomCTotaltoDate)),
//            ],
////            "prevCrop"=>[
////                "thisWeek"=>($thisWeek->prev_prodDomestic + $thisWeek->prev_prodImported) - $thisWeek->prev_prodReturn -(($issuanceImpPTotalThisWeek) + ($issuanceDomPTotalThisWeek)),
////                "prevWeek"=>($prevWeek->prev_prodDomestic + $prevWeek->prev_prodImported) - $prevWeek->prev_prodReturn -(($issuanceImpPTotalprevWeek) + ($issuanceDomPTotalprevWeek)),
////                "toDate"=>($toDate->prev_prodDomestic + $toDate->prev_prodImported) - $toDate->prev_prodReturn -(($issuanceImpPTotaltoDate) + ($issuanceDomPTotaltoDate)),
////            ],
//        ];

//        NEW UNQUEDANNED FORM 2
        $arr["form2_unquedanned"]["currentCrop"]["thisWeek"]=number_format($thisWeek->form2_unquedanned, 3, '.', ',');
        $arr["form2_unquedanned"]["currentCrop"]["prevWeek"]=number_format($prevWeek->form2_unquedanned, 3, '.', ',');
        $arr["form2_unquedanned"]["currentCrop"]["toDate"]=number_format($toDate->form2_unquedanned, 3, '.', ',');
        $arr["form2_unquedanned"]["prevCrop"]["thisWeek"]=number_format($thisWeek->form2_prev_unquedanned, 3, '.', ',');
        $arr["form2_unquedanned"]["prevCrop"]["prevWeek"]=number_format($prevWeek->form2_prev_unquedanned, 3, '.', ',');
        $arr["form2_unquedanned"]["prevCrop"]["toDate"]=number_format($toDate->form2_prev_unquedanned, 3, '.', ',');

        //STOCK ON HAND
//        $arr["stockOnHand"] = [
//            "currentCrop"=>[
//                "thisWeek"=>formatValue((($issuanceImpCTotalThisWeek + $issuanceDomCTotalThisWeek)-($withdrawalImpCTotalThisWeek + $withdrawalDomCTotalThisWeek))+($thisWeek->prodDomestic + $thisWeek->prodImported) - $thisWeek->prodReturn -(($issuanceImpCTotalThisWeek) + ($issuanceDomCTotalThisWeek))),
//                "prevWeek"=>formatValue((($issuanceImpCTotalprevWeek + $issuanceDomCTotalprevWeek)-($withdrawalImpCTotalprevWeek + $withdrawalDomCTotalprevWeek))+($prevWeek->prodDomestic + $prevWeek->prodImported) - $prevWeek->prodReturn -(($issuanceImpCTotalprevWeek) + ($issuanceDomCTotalprevWeek))),
//                "toDate"=>formatValue((($issuanceImpCTotaltoDate + $issuanceDomCTotaltoDate)-($withdrawalImpCTotaltoDate + $withdrawalDomCTotaltoDate))+($toDate->prodDomestic + $toDate->prodImported) - $toDate->prodReturn -(($issuanceImpCTotaltoDate) + ($issuanceDomCTotaltoDate))),
//            ],
//            "prevCrop"=>[
//                "thisWeek"=>formatValue((($issuanceImpPTotalThisWeek + $issuanceDomPTotalThisWeek)-($withdrawalImpPTotalThisWeek + $withdrawalDomPTotalThisWeek))+($thisWeek->prev_prodDomestic + $thisWeek->prev_prodImported) - $thisWeek->prev_prodReturn -(($issuanceImpPTotalThisWeek) + ($issuanceDomPTotalThisWeek))),
//                "prevWeek"=>formatValue((($issuanceImpPTotalprevWeek + $issuanceDomPTotalprevWeek)-($withdrawalImpPTotalprevWeek + $withdrawalDomPTotalprevWeek))+($prevWeek->prev_prodDomestic + $prevWeek->prev_prodImported) - $prevWeek->prev_prodReturn -(($issuanceImpPTotalprevWeek) + ($issuanceDomPTotalprevWeek))),
//                "toDate"=>formatValue((($issuanceImpPTotaltoDate + $issuanceDomPTotaltoDate)-($withdrawalImpPTotaltoDate + $withdrawalDomPTotaltoDate))+($toDate->prev_prodDomestic + $toDate->prev_prodImported) - $toDate->prev_prodReturn -(($issuanceImpPTotaltoDate) + ($issuanceDomPTotaltoDate))),
//            ],
//        ];

//        NEW STOCK ON HAND
        $arr["stockOnHand"] = [
            "currentCrop"=>[
                "thisWeek"=>formatValue((($issuanceImpCTotalThisWeek + $issuanceDomCTotalThisWeek)-($withdrawalImpCTotalThisWeek + $withdrawalDomCTotalThisWeek))+($thisWeek->form2_unquedanned)),
                "prevWeek"=>formatValue((($issuanceImpCTotalprevWeek + $issuanceDomCTotalprevWeek)-($withdrawalImpCTotalprevWeek + $withdrawalDomCTotalprevWeek))+($prevWeek->form2_unquedanned)),
                "toDate"=>formatValue((($issuanceImpCTotaltoDate + $issuanceDomCTotaltoDate)-($withdrawalImpCTotaltoDate + $withdrawalDomCTotaltoDate))+($toDate->form2_unquedanned)),
            ],
            "prevCrop"=>[
                "thisWeek"=>formatValue((($thisWeek->prev_prodDomestic + $thisWeek->prev_prodImported + $thisWeek->prev_overage + $issuanceImpPTotalThisWeek + $issuanceDomPTotalThisWeek)-($withdrawalImpPTotalThisWeek + $withdrawalDomPTotalThisWeek))+($thisWeek->form2_prev_unquedanned)),
                "prevWeek"=>formatValue((($prevWeek->prev_prodDomestic + $prevWeek->prev_prodImported + $prevWeek->prev_overage + $issuanceImpPTotalprevWeek + $issuanceDomPTotalprevWeek)-($withdrawalImpPTotalprevWeek + $withdrawalDomPTotalprevWeek))+($prevWeek->form2_prev_unquedanned)),
                "toDate"=>formatValue((($toDate->prev_prodDomestic + $toDate->prev_prodImported + $toDate->prev_overage + $issuanceImpPTotaltoDate + $issuanceDomPTotaltoDate)-($withdrawalImpPTotaltoDate + $withdrawalDomPTotaltoDate))+($toDate->form2_prev_unquedanned)),
            ],
        ];

//        OLD RETURN
        return [
            'values' => collect($arr)->dot()->all(),
        ];

//        NEW RETURN
//        return [
//            'values' => collect($arr)->dot()->map(function ($value) {
//                // Check if the value is numeric and less than 0
//                if (is_numeric($value) && $value < 0) {
//                    return '(' . abs($value) . ')';
//                }
//                return $value; // Return the original value if not negative
//            })->all(),
//        ];
    }

    private function getDeliveriesAsOf($reportNo, $weeklyReport){
        $deliveries = Deliveries::query()
            ->selectRaw('weekly_report_slug,trader, consumption, sum(qty_current) as currentTotal, sum(qty_prev) as prevTotal, weekly_reports.*')
            ->leftJoin('weekly_reports','weekly_reports.slug','=','form5a_deliveries.weekly_report_slug')
            ->where('crop_year','=',$weeklyReport->crop_year)
            ->where('mill_code','=',$weeklyReport->mill_code)
            ->where('report_no','<=', $reportNo != 0 ? $reportNo : $weeklyReport->report_no * 1)
            ->where(function($q){
                $q->where('weekly_reports.status' ,'!=', -1)
                    ->orWhere('weekly_reports.status', '=', null);
            })
            ->get();
        return $deliveries;
    }

    private function getDeliveriesAsOfSro($reportNo, $weeklyReport){
        $deliveries_sro = IssuancesOfSro::query()
            ->selectRaw('weekly_report_slug,trader, consumption, sum(refined_qty) as currentTotal, sum(prev_refined_qty) as prevTotal, weekly_reports.*')
            ->leftJoin('weekly_reports','weekly_reports.slug','=','form5a_issuances_of_sro.weekly_report_slug')
            ->where('crop_year','=',$weeklyReport->crop_year)
            ->where('mill_code','=',$weeklyReport->mill_code)
            ->where('report_no','<=', $reportNo != 0 ? $reportNo : $weeklyReport->report_no * 1)
            ->where(function($q){
                $q->where('weekly_reports.status' ,'!=', -1)
                    ->orWhere('weekly_reports.status', '=', null);
            })
            ->get();
        return $deliveries_sro;
    }

    private function getFloatValue($value) {
        return floatval($value) ?? 0;
    }

//    API 10-14-2024 LOUIS
    public function getForm2Data()
    {
        // Fetch all the data from the Form2Data model (from the database)
        $data = getForm2::all();

        // Return the data as a JSON response
        return response()->json($data, 200);
    }
}
