<?php

namespace App\Http\Controllers\GetForms;

use App\Http\Controllers\Controller;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\SMS\Form5a\IssuancesOfSro;
use App\Models\SMS\Form5a\Deliveries;


class GetForm2Controller extends Controller
{

    private function formatValue2($value) {
        return $value < 0 ? '(' . number_format(abs($value), 4, '.', ',') . ')' : number_format($value, 4, '.', ',');
    }

    public function getForm2($slug, $isDotted = true){
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

        $issuanceAdvCTotalThisWeek = 0.000;
        $issuanceAdvPTotalThisWeek = 0.000;
        $issuanceAdvCTotalprevWeek = 0.000;
        $issuanceAdvPTotalprevWeek = 0.000;
        $issuanceAdvCTotaltoDate = 0.000;
        $issuanceAdvPTotaltoDate = 0.000;

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

        $withdrawalAdvCTotalThisWeek = 0.000;
        $withdrawalAdvPTotalThisWeek = 0.000;
        $withdrawalAdvCTotalprevWeek = 0.000;
        $withdrawalAdvPTotalprevWeek = 0.000;
        $withdrawalAdvCTotaltoDate = 0.000;
        $withdrawalAdvPTotaltoDate = 0.000;

        //ISSUANCE COMPUTATION --------------------------------------------------------- START
        //GET THIS WEEK VALUES FOR ISSUANCES
        $deliveries = $weeklyReport->form5aIssuancesOfSro()
            ->whereNull('here_only')
            ->whereNotNull('rsq_no')
            ->selectRaw('consumption,sum(refined_qty) as currentTotal, sum(prev_refined_qty) as prevTotal')
            ->groupBy('consumption') //FIX FOR THE IF ELSE LOGIC FILTERED BY DOMESTIC
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
            }else if($delivery->consumption == "ADVANCE"){
                //IF ADVANCE REFINING ISSUANCE
                $arr["issuanceAdvanceRefining"]["currentCrop"]["thisWeek"] = $delivery->currentTotal;
                $arr["issuanceAdvanceRefining"]["prevCrop"]["thisWeek"] = $delivery->prevTotal;
                $issuanceAdvCTotalThisWeek += $arr["issuanceAdvanceRefining"]["currentCrop"]["thisWeek"];
                $issuanceAdvPTotalThisWeek += $arr["issuanceAdvanceRefining"]["prevCrop"]["thisWeek"];
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
            }else if($delivery->consumption == "ADVANCE"){
                //IF ADVANCE REFINING ISSUANCE
                $arr["issuanceAdvanceRefining"]["currentCrop"]["prevWeek"] = $delivery->currentTotal;
                $arr["issuanceAdvanceRefining"]["prevCrop"]["prevWeek"] = $delivery->prevTotal;
                $issuanceAdvCTotalprevWeek += $arr["issuanceAdvanceRefining"]["currentCrop"]["prevWeek"];
                $issuanceAdvPTotalprevWeek += $arr["issuanceAdvanceRefining"]["prevCrop"]["prevWeek"];
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
            }else if($delivery->consumption == "ADVANCE"){
                //IF ADVANCE REFINING ISSUANCE
                $arr["issuanceAdvanceRefining"]["currentCrop"]["toDate"] = $delivery->currentTotal;
                $arr["issuanceAdvanceRefining"]["prevCrop"]["toDate"] = $delivery->prevTotal;
                $issuanceAdvCTotaltoDate += $arr["issuanceAdvanceRefining"]["currentCrop"]["toDate"];
                $issuanceAdvPTotaltoDate += $arr["issuanceAdvanceRefining"]["prevCrop"]["toDate"];
            }
        }

        //TOTAL DOMESTIC ISSUANCE
        $arr["totalIssuanceDomestic"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue2($issuanceDomCTotalThisWeek),
                "prevWeek"=>$this->formatValue2($issuanceDomCTotalprevWeek),
                "toDate"=>$this->formatValue2($issuanceDomCTotaltoDate),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue2($issuanceDomPTotalThisWeek),
                "prevWeek"=>$this->formatValue2($issuanceDomPTotalprevWeek),
                "toDate"=>$this->formatValue2($issuanceDomPTotaltoDate),
            ],
        ];

        //TOTAL IMPORTED ISSUANCE
        $arr["totalIssuanceImported"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue2($issuanceImpCTotalThisWeek),
                "prevWeek"=>$this->formatValue2($issuanceImpCTotalprevWeek),
                "toDate"=>$this->formatValue2($issuanceImpCTotaltoDate),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue2($issuanceImpPTotalThisWeek),
                "prevWeek"=>$this->formatValue2($issuanceImpPTotalprevWeek),
                "toDate"=>$this->formatValue2($issuanceImpPTotaltoDate),
            ],
        ];

        $arr["totalIssuanceAdvanceRefining"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue2($issuanceAdvCTotalThisWeek),
                "prevWeek"=>$this->formatValue2($issuanceAdvCTotalprevWeek),
                "toDate"=>$this->formatValue2($issuanceAdvCTotaltoDate),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue2($issuanceAdvPTotalThisWeek),
                "prevWeek"=>$this->formatValue2($issuanceAdvPTotalprevWeek),
                "toDate"=>$this->formatValue2($issuanceAdvPTotaltoDate),
            ],
        ];

        //TOTAL OVERALL ISSUANCE
        $arr["totalIssuanceOverall"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue2($issuanceImpCTotalThisWeek + $issuanceDomCTotalThisWeek + $issuanceAdvCTotalThisWeek),
                "prevWeek"=>$this->formatValue2($issuanceImpCTotalprevWeek + $issuanceDomCTotalprevWeek + $issuanceAdvCTotalprevWeek),
                "toDate"=>$this->formatValue2($issuanceImpCTotaltoDate + $issuanceDomCTotaltoDate + $issuanceAdvCTotaltoDate),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue2($issuanceImpPTotalThisWeek + $issuanceDomPTotalThisWeek + $issuanceAdvPTotalThisWeek),
                "prevWeek"=>$this->formatValue2($issuanceImpPTotalprevWeek + $issuanceDomPTotalprevWeek + $issuanceAdvPTotalprevWeek),
                "toDate"=>$this->formatValue2($issuanceImpPTotaltoDate + $issuanceDomPTotaltoDate + $issuanceAdvPTotaltoDate),
            ],
        ];
        //ISSUANCE COMPUTATION --------------------------------------------------------- END

        //WITHDRAWAL COMPUTATION ------------------------------------------------------- START
        //GET THIS WEEK VALUES FOR WITHDRAWALS
        $deliveries = $weeklyReport->form5aDeliveries()
            ->selectRaw('consumption,sum(qty_current) as currentTotal, sum(qty_prev) as prevTotal')
            ->groupBy('consumption') //FIX FOR THE IF ELSE LOGIC FILTERED BY DOMESTIC
            ->get();
        foreach ($deliveries as $delivery){
            if($delivery->consumption == "DOMESTIC"){
                //IF DOMESTIC WITHDRAWAL
                $arr["withdrawalDomestic"]["currentCrop"]["thisWeek"] = $delivery->currentTotal;
                $arr["withdrawalDomestic"]["prevCrop"]["thisWeek"] = $delivery->prevTotal;
                $withdrawalDomCTotalThisWeek += $arr["withdrawalDomestic"]["currentCrop"]["thisWeek"];
                $withdrawalDomPTotalThisWeek += $arr["withdrawalDomestic"]["prevCrop"]["thisWeek"];
            }else if($delivery->consumption == "IMPORTED"){
                //IF IMPORTED WITHDRAWAL
                $arr["withdrawalImported"]["currentCrop"]["thisWeek"] = $delivery->currentTotal;
                $arr["withdrawalImported"]["prevCrop"]["thisWeek"] = $delivery->prevTotal;
                $withdrawalImpCTotalThisWeek += $arr["withdrawalImported"]["currentCrop"]["thisWeek"];
                $withdrawalImpPTotalThisWeek += $arr["withdrawalImported"]["prevCrop"]["thisWeek"];
            }else if($delivery->consumption == "ADVANCE"){
                //IF IMPORTED WITHDRAWAL
                $arr["withdrawalAdvance"]["currentCrop"]["thisWeek"] = $delivery->currentTotal;
                $arr["withdrawalAdvance"]["prevCrop"]["thisWeek"] = $delivery->prevTotal;
                $withdrawalAdvCTotalThisWeek += $arr["withdrawalAdvance"]["currentCrop"]["thisWeek"];
                $withdrawalAdvPTotalThisWeek += $arr["withdrawalAdvance"]["prevCrop"]["thisWeek"];
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
            }else if($delivery->consumption == "IMPORTED"){
                //if for refining
                $arr["withdrawalImported"]["currentCrop"]["prevWeek"] = $delivery->currentTotal;
                $arr["withdrawalImported"]["prevCrop"]["prevWeek"] = $delivery->prevTotal;
                $withdrawalImpCTotalprevWeek += $arr["withdrawalImported"]["currentCrop"]["prevWeek"];
                $withdrawalImpPTotalprevWeek += $arr["withdrawalImported"]["prevCrop"]["prevWeek"];
            }else if($delivery->consumption == "ADVANCE"){
                //IF IMPORTED WITHDRAWAL
                $arr["withdrawalAdvance"]["currentCrop"]["prevWeek"] = $delivery->currentTotal;
                $arr["withdrawalAdvance"]["prevCrop"]["prevWeek"] = $delivery->prevTotal;
                $withdrawalAdvCTotalprevWeek += $arr["withdrawalAdvance"]["currentCrop"]["prevWeek"];
                $withdrawalAdvPTotalprevWeek += $arr["withdrawalAdvance"]["prevCrop"]["prevWeek"];
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
            }else if($delivery->consumption == "IMPORTED"){
                //if for refining
                $arr["withdrawalImported"]["currentCrop"]["toDate"] = $delivery->currentTotal;
                $arr["withdrawalImported"]["prevCrop"]["toDate"] = $delivery->prevTotal;
                $withdrawalImpCTotaltoDate += $arr["withdrawalImported"]["currentCrop"]["toDate"];
                $withdrawalImpPTotaltoDate += $arr["withdrawalImported"]["prevCrop"]["toDate"];
            }else if($delivery->consumption == "ADVANCE"){
                //IF IMPORTED WITHDRAWAL
                $arr["withdrawalAdvance"]["currentCrop"]["toDate"] = $delivery->currentTotal;
                $arr["withdrawalAdvance"]["prevCrop"]["toDate"] = $delivery->prevTotal;
                $withdrawalAdvCTotaltoDate += $arr["withdrawalAdvance"]["currentCrop"]["toDate"];
                $withdrawalAdvPTotaltoDate += $arr["withdrawalAdvance"]["prevCrop"]["toDate"];
            }
        }

        //TOTAL DOMESTIC WITHDRAWAL
        $arr["totalWithdrawalDomestic"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue2($withdrawalDomCTotalThisWeek ?? 0),
                "prevWeek"=>$this->formatValue2($withdrawalDomCTotalprevWeek ?? 0),
                "toDate"=>$this->formatValue2($withdrawalDomCTotaltoDate ?? 0),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue2($withdrawalDomPTotalThisWeek ?? 0),
                "prevWeek"=>$this->formatValue2($withdrawalDomPTotalprevWeek ?? 0),
                "toDate"=>$this->formatValue2($withdrawalDomPTotaltoDate ?? 0),
            ],
        ];

        //TOTAL IMPORTED WITHDRAWAL
        $arr["totalWithdrawalImported"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue2($withdrawalImpCTotalThisWeek ?? 0),
                "prevWeek"=>$this->formatValue2($withdrawalImpCTotalprevWeek ?? 0),
                "toDate"=>$this->formatValue2($withdrawalImpCTotaltoDate ?? 0),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue2($withdrawalImpPTotalThisWeek ?? 0),
                "prevWeek"=>$this->formatValue2($withdrawalImpPTotalprevWeek ?? 0),
                "toDate"=>$this->formatValue2($withdrawalImpPTotaltoDate ?? 0),
            ],
        ];

        $arr["totalWithdrawalAdvanceRefining"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue2($withdrawalAdvCTotalThisWeek ?? 0),
                "prevWeek"=>$this->formatValue2($withdrawalAdvCTotalprevWeek ?? 0),
                "toDate"=>$this->formatValue2($withdrawalAdvCTotaltoDate ?? 0),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue2($withdrawalAdvPTotalThisWeek ?? 0),
                "prevWeek"=>$this->formatValue2($withdrawalAdvPTotalprevWeek ?? 0),
                "toDate"=>$this->formatValue2($withdrawalAdvPTotaltoDate ?? 0),
            ],
        ];

        //TOTAL OVERALL WITHDRAWAL
        $arr["totalWithdrawalOverall"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue2($withdrawalImpCTotalThisWeek + $withdrawalDomCTotalThisWeek + $withdrawalAdvCTotalThisWeek ?? 0),
                "prevWeek"=>$this->formatValue2($withdrawalImpCTotalprevWeek + $withdrawalDomCTotalprevWeek + $withdrawalAdvCTotalprevWeek ?? 0),
                "toDate"=>$this->formatValue2($withdrawalImpCTotaltoDate + $withdrawalDomCTotaltoDate + $withdrawalAdvCTotaltoDate ?? 0),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue2($withdrawalImpPTotalThisWeek + $withdrawalDomPTotalThisWeek + $withdrawalAdvPTotalThisWeek ?? 0),
                "prevWeek"=>$this->formatValue2($withdrawalImpPTotalprevWeek + $withdrawalDomPTotalprevWeek + $withdrawalAdvPTotalprevWeek ?? 0),
                "toDate"=>$this->formatValue2($withdrawalImpPTotaltoDate + $withdrawalDomPTotaltoDate + $withdrawalAdvPTotaltoDate ?? 0),
            ],
        ];
        //WITHDRAWAL COMPUTATION ------------------------------------------------------- END

        //number_format($ReceiptCTotalThisWeek, 3, '.', ',')
        //CARRY-OVER COMPUTATION
        $arr["carryOver"]["currentCrop"]["thisWeek"]=$thisWeek->carryOver;
        $arr["carryOver"]["currentCrop"]["prevWeek"]=$this->formatValue2($prevWeek->carryOver);
        $arr["carryOver"]["currentCrop"]["toDate"]=$this->formatValue2($toDate->carryOver);
        $arr["carryOver"]["prevCrop"]["thisWeek"]=$this->formatValue2($thisWeek->prev_carryOver ?? 0);
        $arr["carryOver"]["prevCrop"]["prevWeek"]=$this->formatValue2($prevWeek->prev_carryOver ?? 0);
        $arr["carryOver"]["prevCrop"]["toDate"]=$this->formatValue2($toDate->prev_carryOver ?? 0);

        //COVERED BY SRO COMPUTATION
        $arr["coveredBySro"]["currentCrop"]["thisWeek"]=$this->formatValue2($thisWeek->coveredBySro);
        $arr["coveredBySro"]["currentCrop"]["prevWeek"]=$this->formatValue2($prevWeek->coveredBySro);
        $arr["coveredBySro"]["currentCrop"]["toDate"]=$this->formatValue2($toDate->coveredBySro);
        $arr["coveredBySro"]["prevCrop"]["thisWeek"]=$this->formatValue2($thisWeek->prev_coveredBySro);
        $arr["coveredBySro"]["prevCrop"]["prevWeek"]=$this->formatValue2($prevWeek->prev_coveredBySro);
        $arr["coveredBySro"]["prevCrop"]["toDate"]=$this->formatValue2($toDate->prev_coveredBySro);

        $value1 = Helper::sanitizeNumFormat(session('formatted_transfer1'));
        $value2 = Helper::sanitizeNumFormat(session('formatted_transfer2'));
        $value3 = Helper::sanitizeNumFormat(session('formatted_transfer3'));
        $value4 = Helper::sanitizeNumFormat(session('formatted_transfer4'));
        $value5 = Helper::sanitizeNumFormat(session('formatted_transfer5'));
        $value6 = Helper::sanitizeNumFormat(session('formatted_transfer6'));

        //NOT COVERED BY SRO COMPUTATION
//        $arr["notCoveredBySro"]["currentCrop"]["thisWeek"]=number_format($value1, 3, '.', ',');
//        $arr["notCoveredBySro"]["currentCrop"]["prevWeek"]=number_format($value2, 3, '.', ',');
//        $arr["notCoveredBySro"]["currentCrop"]["toDate"]=number_format($value3, 3, '.', ',');
//        $arr["notCoveredBySro"]["prevCrop"]["thisWeek"]=number_format($value4, 3, '.', ',');
//        $arr["notCoveredBySro"]["prevCrop"]["prevWeek"]=number_format($value5, 3, '.', ',');
//        $arr["notCoveredBySro"]["prevCrop"]["toDate"]=number_format($value6, 3, '.', ',');

        $arr["notCoveredBySro"]["currentCrop"]["thisWeek"]=$this->formatValue2($thisWeek->notCoveredBySro);
        $arr["notCoveredBySro"]["currentCrop"]["prevWeek"]=$this->formatValue2($prevWeek->notCoveredBySro);
        $arr["notCoveredBySro"]["currentCrop"]["toDate"]=$this->formatValue2($toDate->notCoveredBySro);
        $arr["notCoveredBySro"]["prevCrop"]["thisWeek"]=$this->formatValue2($thisWeek->prev_notCoveredBySro);
        $arr["notCoveredBySro"]["prevCrop"]["prevWeek"]=$this->formatValue2($prevWeek->prev_notCoveredBySro);
        $arr["notCoveredBySro"]["prevCrop"]["toDate"]=$this->formatValue2($toDate->prev_notCoveredBySro);

        //OTHER MILLS COMPUTATION
        $arr["otherMills"]["currentCrop"]["thisWeek"]=$this->formatValue2($thisWeek->otherMills);
        $arr["otherMills"]["currentCrop"]["prevWeek"]=$this->formatValue2($prevWeek->otherMills);
        $arr["otherMills"]["currentCrop"]["toDate"]=$this->formatValue2($toDate->otherMills);
        $arr["otherMills"]["prevCrop"]["thisWeek"]=$this->formatValue2($thisWeek->prev_otherMills);
        $arr["otherMills"]["prevCrop"]["prevWeek"]=$this->formatValue2($prevWeek->prev_otherMills);
        $arr["otherMills"]["prevCrop"]["toDate"]=$this->formatValue2($toDate->prev_otherMills);

        //IMPORTED COMPUTATION
        $arr["imported"]["currentCrop"]["thisWeek"]=$this->formatValue2($thisWeek->imported);
        $arr["imported"]["currentCrop"]["prevWeek"]=$this->formatValue2($prevWeek->imported);
        $arr["imported"]["currentCrop"]["toDate"]=$this->formatValue2($toDate->imported);
        $arr["imported"]["prevCrop"]["thisWeek"]=$this->formatValue2($thisWeek->prev_imported);
        $arr["imported"]["prevCrop"]["prevWeek"]=$this->formatValue2($prevWeek->prev_imported);
        $arr["imported"]["prevCrop"]["toDate"]=$this->formatValue2($toDate->prev_imported);

        //ADVANCE REFINING COMPUTATION
        $arr["advanceRefining"]["currentCrop"]["thisWeek"]=$this->formatValue2($thisWeek->advance_refining);
        $arr["advanceRefining"]["currentCrop"]["prevWeek"]=$this->formatValue2($prevWeek->advance_refining);
        $arr["advanceRefining"]["currentCrop"]["toDate"]=$this->formatValue2($toDate->advance_refining);
        $arr["advanceRefining"]["prevCrop"]["thisWeek"]=$this->formatValue2($thisWeek->prev_advance_refining);
        $arr["advanceRefining"]["prevCrop"]["prevWeek"]=$this->formatValue2($prevWeek->prev_advance_refining);
        $arr["advanceRefining"]["prevCrop"]["toDate"]=$this->formatValue2($toDate->prev_advance_refining);

        //MELTED COMPUTATION
        $arr["melted"]["currentCrop"]["thisWeek"]=$this->formatValue2($thisWeek->melted);
        $arr["melted"]["currentCrop"]["prevWeek"]=$this->formatValue2($prevWeek->melted);
        $arr["melted"]["currentCrop"]["toDate"]=$this->formatValue2($toDate->melted);
        $arr["melted"]["prevCrop"]["thisWeek"]=$this->formatValue2($thisWeek->prev_melted ?? 0);
        $arr["melted"]["prevCrop"]["prevWeek"]=$this->formatValue2($prevWeek->prev_melted);
        $arr["melted"]["prevCrop"]["toDate"]=$this->formatValue2($toDate->prev_melted);

        //RAW WITHDRAWALS COMPUTATION
        $arr["rawWithdrawals"]["currentCrop"]["thisWeek"]=$this->formatValue2($thisWeek->rawWithdrawals);
        $arr["rawWithdrawals"]["currentCrop"]["prevWeek"]=$this->formatValue2($prevWeek->rawWithdrawals);
        $arr["rawWithdrawals"]["currentCrop"]["toDate"]=$this->formatValue2($toDate->rawWithdrawals);
        $arr["rawWithdrawals"]["prevCrop"]["thisWeek"]=$this->formatValue2($thisWeek->prev_rawWithdrawals);
        $arr["rawWithdrawals"]["prevCrop"]["prevWeek"]=$this->formatValue2($prevWeek->prev_rawWithdrawals);
        $arr["rawWithdrawals"]["prevCrop"]["toDate"]=$this->formatValue2($toDate->prev_rawWithdrawals);


        //PRODUCTION DOMESTIC
        $arr["prodDomestic"]["currentCrop"]["thisWeek"]=$this->formatValue2($thisWeek->prodDomestic);
        $arr["prodDomestic"]["currentCrop"]["prevWeek"]=$this->formatValue2($prevWeek->prodDomestic);
        $arr["prodDomestic"]["currentCrop"]["toDate"]=$this->formatValue2($toDate->prodDomestic);
        $arr["prodDomestic"]["prevCrop"]["thisWeek"]=$this->formatValue2($thisWeek->prev_prodDomestic);
        $arr["prodDomestic"]["prevCrop"]["prevWeek"]=$this->formatValue2($prevWeek->prev_prodDomestic);
        $arr["prodDomestic"]["prevCrop"]["toDate"]=$this->formatValue2($toDate->prev_prodDomestic);

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

        //Max edward was Here ( o _ o )

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
                "thisWeek"=>number_format($thisWeek->coveredBySro + $thisWeek->otherMills + $thisWeek->imported + $thisWeek->advance_refining + $thisWeek->notCoveredBySro, 3, '.', ','),
                "prevWeek"=>number_format($prevWeek->coveredBySro + $prevWeek->otherMills + $prevWeek->imported + $prevWeek->advance_refining + $prevWeek->notCoveredBySro, 3, '.', ','),
                "toDate"=>number_format($toDate->coveredBySro + $toDate->otherMills + $toDate->imported + $toDate->advance_refining + $toDate->notCoveredBySro, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format($thisWeek->prev_coveredBySro + $thisWeek->prev_otherMills + $thisWeek->prev_imported + $thisWeek->prev_advance_refining + $thisWeek->prev_notCoveredBySro, 3, '.', ','),
                "prevWeek"=>number_format($prevWeek->prev_coveredBySro + $prevWeek->prev_otherMills + $prevWeek->prev_imported + $prevWeek->prev_advance_refining + $prevWeek->prev_notCoveredBySro, 3, '.', ','),
                "toDate"=>number_format($toDate->prev_coveredBySro + $toDate->prev_otherMills + $toDate->prev_imported + $toDate->prev_advance_refining + $toDate->prev_notCoveredBySro, 3, '.', ','),
            ],
        ];

        //BALANCE RAW
//        $arr["balanceRaw"] = [
//            "currentCrop"=>[
//                "thisWeek"=>$this->formatValue2(($thisWeek->coveredBySro + $thisWeek->otherMills + $thisWeek->imported + $value1) - ($thisWeek->melted) - ($thisWeek->rawWithdrawals), 3, '.', ','),
//                "prevWeek"=>$this->formatValue2(($prevWeek->coveredBySro + $prevWeek->otherMills + $prevWeek->imported + $value2) - ($prevWeek->melted) - ($prevWeek->rawWithdrawals), 3, '.', ','),
//                "toDate"=>$this->formatValue2(($toDate->coveredBySro + $toDate->otherMills + $toDate->imported + $value3) - ($toDate->melted) - ($toDate->rawWithdrawals), 3, '.', ','),
//            ],
//            "prevCrop"=>[
//                "thisWeek"=>$this->formatValue2(($thisWeek->prev_carryOver) - ($thisWeek->prev_melted) - ($thisWeek->prev_rawWithdrawals), 3, '.', ','),
//                "prevWeek"=>$this->formatValue2(($prevWeek->prev_carryOver) - ($prevWeek->prev_melted) - ($prevWeek->prev_rawWithdrawals), 3, '.', ','),
//                "toDate"=>$this->formatValue2(($toDate->prev_carryOver) - ($toDate->prev_melted) - ($toDate->prev_rawWithdrawals), 3, '.', ','),
//            ],
//        ];

        $arr["balanceRaw"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue2(($thisWeek->coveredBySro + $thisWeek->otherMills + $thisWeek->imported + $thisWeek->advance_refining + $thisWeek->notCoveredBySro) - ($thisWeek->melted) - ($thisWeek->rawWithdrawals), 3, '.', ','),
                "prevWeek"=>$this->formatValue2(($prevWeek->coveredBySro + $prevWeek->otherMills + $prevWeek->imported + $prevWeek->advance_refining + $prevWeek->notCoveredBySro) - ($prevWeek->melted) - ($prevWeek->rawWithdrawals), 3, '.', ','),
                "toDate"=>$this->formatValue2(($toDate->coveredBySro + $toDate->otherMills + $toDate->imported + $toDate->advance_refining + $toDate->notCoveredBySro) - ($toDate->melted) - ($toDate->rawWithdrawals), 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue2(($thisWeek->prev_carryOver) - ($thisWeek->prev_melted) - ($thisWeek->prev_rawWithdrawals), 3, '.', ','),
                "prevWeek"=>$this->formatValue2(($prevWeek->prev_carryOver) - ($prevWeek->prev_melted) - ($prevWeek->prev_rawWithdrawals), 3, '.', ','),
                "toDate"=>$this->formatValue2(($toDate->prev_carryOver) - ($toDate->prev_melted) - ($toDate->prev_rawWithdrawals), 3, '.', ','),
            ],
        ];

        //STOCK BALANCE
        $arr["stockBalance"] = [
            "currentCrop"=>[
                "thisWeek"=>$this->formatValue2(($issuanceImpCTotalThisWeek + $issuanceDomCTotalThisWeek + $issuanceAdvCTotalThisWeek)-($withdrawalImpCTotalThisWeek + $withdrawalDomCTotalThisWeek + $withdrawalAdvCTotalThisWeek)),
                "prevWeek"=>$this->formatValue2(($issuanceImpCTotalprevWeek + $issuanceDomCTotalprevWeek + $issuanceAdvCTotalprevWeek)-($withdrawalImpCTotalprevWeek + $withdrawalDomCTotalprevWeek + $withdrawalAdvCTotalprevWeek)),
                "toDate"=>$this->formatValue2(($issuanceImpCTotaltoDate + $issuanceDomCTotaltoDate + $issuanceAdvCTotaltoDate)-($withdrawalImpCTotaltoDate + $withdrawalDomCTotaltoDate + $withdrawalAdvCTotaltoDate)),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue2(($thisWeek->prev_prodDomestic + $thisWeek->prev_prodImported + $thisWeek->prev_overage + $issuanceImpPTotalThisWeek + $issuanceDomPTotalThisWeek + $issuanceAdvPTotalThisWeek)-($withdrawalImpPTotalThisWeek + $withdrawalDomPTotalThisWeek + $withdrawalAdvPTotalThisWeek)),
                "prevWeek"=>$this->formatValue2(($prevWeek->prev_prodDomestic + $prevWeek->prev_prodImported + $prevWeek->prev_overage + $issuanceImpPTotalprevWeek + $issuanceDomPTotalprevWeek + $issuanceAdvPTotalprevWeek)-($withdrawalImpPTotalprevWeek + $withdrawalDomPTotalprevWeek + $withdrawalAdvPTotalprevWeek)),
                "toDate"=>$this->formatValue2(($toDate->prev_prodDomestic + $toDate->prev_prodImported + $toDate->prev_overage + $issuanceImpPTotaltoDate + $issuanceDomPTotaltoDate + $issuanceAdvPTotaltoDate)-($withdrawalImpPTotaltoDate + $withdrawalDomPTotaltoDate + $withdrawalAdvPTotaltoDate)),
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
                "thisWeek"=>$this->formatValue2((($issuanceImpCTotalThisWeek + $issuanceDomCTotalThisWeek + $issuanceAdvCTotalThisWeek)-($withdrawalImpCTotalThisWeek + $withdrawalDomCTotalThisWeek + $withdrawalAdvCTotalThisWeek))+($thisWeek->form2_unquedanned)),
                "prevWeek"=>$this->formatValue2((($issuanceImpCTotalprevWeek + $issuanceDomCTotalprevWeek + $issuanceAdvCTotalprevWeek)-($withdrawalImpCTotalprevWeek + $withdrawalDomCTotalprevWeek + $withdrawalAdvCTotalprevWeek))+($prevWeek->form2_unquedanned)),
                "toDate"=>$this->formatValue2((($issuanceImpCTotaltoDate + $issuanceDomCTotaltoDate + $issuanceAdvCTotaltoDate)-($withdrawalImpCTotaltoDate + $withdrawalDomCTotaltoDate + $withdrawalAdvCTotaltoDate))+($toDate->form2_unquedanned)),
            ],
            "prevCrop"=>[
                "thisWeek"=>$this->formatValue2((($thisWeek->prev_prodDomestic + $thisWeek->prev_prodImported + $thisWeek->prev_overage + $issuanceImpPTotalThisWeek + $issuanceDomPTotalThisWeek + $issuanceAdvPTotalThisWeek)-($withdrawalImpPTotalThisWeek + $withdrawalDomPTotalThisWeek + $withdrawalAdvPTotalThisWeek))+($thisWeek->form2_prev_unquedanned)),
                "prevWeek"=>$this->formatValue2((($prevWeek->prev_prodDomestic + $prevWeek->prev_prodImported + $prevWeek->prev_overage + $issuanceImpPTotalprevWeek + $issuanceDomPTotalprevWeek + $issuanceAdvPTotalprevWeek)-($withdrawalImpPTotalprevWeek + $withdrawalDomPTotalprevWeek + $withdrawalAdvPTotalprevWeek))+($prevWeek->form2_prev_unquedanned)),
                "toDate"=>$this->formatValue2((($toDate->prev_prodDomestic + $toDate->prev_prodImported + $toDate->prev_overage + $issuanceImpPTotaltoDate + $issuanceDomPTotaltoDate + $issuanceAdvPTotaltoDate)-($withdrawalImpPTotaltoDate + $withdrawalDomPTotaltoDate + $withdrawalAdvPTotaltoDate))+($toDate->form2_prev_unquedanned)),
            ],
        ];

//        OLD RETURN
//        return [
//            'values' => collect($arr)->dot()->all(),
//        ];

        return [
            'values' => $isDotted ? collect($arr)->dot()->all() : collect($arr)->all(),
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
//            ->where('report_no','<=', $reportNo != 0 ? $reportNo : $weeklyReport->report_no * 1)
            ->where('report_no','<=', $reportNo)
            ->where(function($q){
                $q->where('weekly_reports.status' ,'!=', -1)
                    ->orWhere('weekly_reports.status', '=', null);
            })
            ->groupBy('consumption')
            ->get();
        return $deliveries;
    }

    private function getDeliveriesAsOfSro($reportNo, $weeklyReport){
        $deliveries_sro = IssuancesOfSro::query()
            ->selectRaw('weekly_report_slug,trader, consumption, sum(refined_qty) as currentTotal, sum(prev_refined_qty) as prevTotal, weekly_reports.*')
            ->leftJoin('weekly_reports','weekly_reports.slug','=','form5a_issuances_of_sro.weekly_report_slug')
            ->whereNull('here_only')
            ->whereNotNull('rsq_no')
            ->where('crop_year','=',$weeklyReport->crop_year)
            ->where('mill_code','=',$weeklyReport->mill_code)
//            ->where('report_no','<=', $reportNo != 0 ? $reportNo : $weeklyReport->report_no * 1)
            ->where('report_no','<=', $reportNo)
            ->where(function($q){
                $q->where('weekly_reports.status' ,'!=', -1)
                    ->orWhere('weekly_reports.status', '=', null);
            })
            ->groupBy('consumption')
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
