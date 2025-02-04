<?php

namespace App\Http\Controllers\GetForms;

use App\Http\Controllers\Controller;
use App\Models\SMS\Form5\Deliveries;

class GetForm1Controller extends Controller
{
    public function getForm1($slug){
        $weeklyReport = \App\Models\SMS\WeeklyReports::query()->where("slug","=",$slug)->first();
        $currentReportNo = $weeklyReport->report_no * 1;
        $arr=[];
        $sugarClassUsed = [];
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

        $thisWeek = $weeklyReport->form1;
        $prevWeek = $weeklyReport->form1ToDateAsOf($currentReportNo-1);
        $toDate = $weeklyReport->form1ToDateAsOf($currentReportNo);

        $thisWeek2 = $weeklyReport->form2;
        $prevWeek2 = $weeklyReport->form2ToDateAsOf($currentReportNo-1);
        $toDate2 = $weeklyReport->form2ToDateAsOf($currentReportNo);

//        dd($weeklyReport);
        function formatValue($value) {
            return $value < 0 ? '(' . number_format(abs($value), 3, '.', ',') . ')' : number_format($value, 3, '.', ',');
        }

//        number_format($withdrawCTotalThisWeek, 3, '.', ',')
        //MANUFACTURED COMPUTATION
        $arr["manufactured"]["currentCrop"]["thisWeek"]=number_format($thisWeek->manufactured, 3, '.', ',');
        $arr["manufactured"]["currentCrop"]["prevWeek"]=number_format($prevWeek->manufactured, 3, '.', ',');
        $arr["manufactured"]["currentCrop"]["toDate"]=number_format($toDate->manufactured, 3, '.', ',');
        $arr["manufactured"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_manufactured, 3, '.', ',');
        $arr["manufactured"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_manufactured, 3, '.', ',');
        $arr["manufactured"]["prevCrop"]["toDate"]=number_format($toDate->prev_manufactured, 3, '.', ',');

        //ISSUANCES COMPUTATION
        $sugarClasses = \App\Swep\Helpers\Arrays::sugarClasses();
        $sugarClassesCharge = \App\Swep\Helpers\Arrays::sugarClassesCharging();
        foreach ($sugarClasses as $sugarClass){
            if($thisWeek->$sugarClass != null){
                array_push($sugarClassUsed, $sugarClass);
            }
            if($prevWeek->$sugarClass != null){
                array_push($sugarClassUsed, $sugarClass);
            }
            if($toDate->$sugarClass != null){
                array_push($sugarClassUsed, $sugarClass);
            }
            if($thisWeek->{'prev_'.$sugarClass} != null){
                array_push($sugarClassUsed, $sugarClass);
            }
            if($prevWeek->{'prev_'.$sugarClass} != null){
                array_push($sugarClassUsed, $sugarClass);
            }
            if($toDate->{'prev_'.$sugarClass} != null){
                array_push($sugarClassUsed, $sugarClass);
            }
        }
        foreach ($sugarClassUsed as $sugarClass){
            $arr["issuances"][$sugarClass]=[
                "currentCrop"=>[
                    "thisWeek"=>$thisWeek->$sugarClass,
                    "prevWeek"=>$prevWeek->$sugarClass,
                    "toDate"=>$toDate->$sugarClass,
                ],
                "prevCrop"=>[
                    "thisWeek"=>$thisWeek->{'prev_'.$sugarClass},
                    "prevWeek"=>$prevWeek->{'prev_'.$sugarClass},
                    "toDate"=>$toDate->{'prev_'.$sugarClass},
                ],
            ];
        }
        $withdrawCTotalThisWeek = 0;
        $withdrawCTotalPrevWeek = 0;
        $withdrawCTotalToDate = 0;
        $withdrawPTotalThisWeek = 0;
        $withdrawPTotalPrevWeek = 0;
        $withdrawPTotalToDate = 0;

        $withdrawRefCTotalThisWeek = 0;
        $withdrawRefCTotalPrevWeek = 0;
        $withdrawRefCTotalToDate = 0;
        $withdrawRefPTotalThisWeek = 0;
        $withdrawRefPTotalPrevWeek = 0;
        $withdrawRefPTotalToDate = 0;


        /** DELIVERIES **/
        //GET THIS WEEK VALUES FOR WITHDRAWALS
        $deliveries = $weeklyReport->form5Deliveries()
            ->selectRaw('refining, sugar_class,sum(qty) as currentTotal, sum(qty_prev) as prevTotal')
            ->groupBy('refining','sugar_class')
            ->orderBy('sugar_class','asc')
            ->get();
        foreach ($deliveries as $delivery){
            array_push($sugarClassUsed, $delivery->sugar_class);
            if($delivery->refining != 1){
                //if not for refining
                $arr["withdrawals"][$delivery->sugar_class]["currentCrop"]["thisWeek"] = $delivery->currentTotal ?? 0;
                $arr["withdrawals"][$delivery->sugar_class]["prevCrop"]["thisWeek"] = $delivery->prevTotal ?? 0;

                $arr["withdrawalsRawData"][$sugarClassesCharge[$delivery->sugar_class]]["currentCrop"]["thisWeek"] =
                    ($arr["withdrawalsRawData"][$sugarClassesCharge[$delivery->sugar_class]]["currentCrop"]["thisWeek"] ?? 0) + $delivery->currentTotal;
                $arr["withdrawalsRawData"][$sugarClassesCharge[$delivery->sugar_class]]["prevCrop"]["thisWeek"] =
                    ($arr["withdrawalsRawData"][$sugarClassesCharge[$delivery->sugar_class]]["prevCrop"]["thisWeek"] ?? 0) +$delivery->prevTotal;

                $withdrawCTotalThisWeek += $arr["withdrawals"][$delivery->sugar_class]["currentCrop"]["thisWeek"];
                $withdrawPTotalThisWeek += $arr["withdrawals"][$delivery->sugar_class]["prevCrop"]["thisWeek"];
            }else{
                //if for refining
                $arr["withdrawals_for_refining"][$delivery->sugar_class]["currentCrop"]["thisWeek"] = $delivery->currentTotal;
                $arr["withdrawals_for_refining"][$delivery->sugar_class]["prevCrop"]["thisWeek"] = $delivery->prevTotal;

                $arr["withdrawals_for_refiningRawData"][$sugarClassesCharge[$delivery->sugar_class]]["currentCrop"]["thisWeek"] =
                    ($arr["withdrawals_for_refiningRawData"][$sugarClassesCharge[$delivery->sugar_class]]["currentCrop"]["thisWeek"] ?? 0) + $delivery->currentTotal;
                $arr["withdrawals_for_refiningRawData"][$sugarClassesCharge[$delivery->sugar_class]]["prevCrop"]["thisWeek"] =
                    ($arr["withdrawals_for_refiningRawData"][$sugarClassesCharge[$delivery->sugar_class]]["prevCrop"]["thisWeek"] ?? 0) + $delivery->prevTotal;

                $withdrawRefCTotalThisWeek += $arr["withdrawals_for_refining"][$delivery->sugar_class]["currentCrop"]["thisWeek"];
                $withdrawRefPTotalThisWeek += $arr["withdrawals_for_refining"][$delivery->sugar_class]["prevCrop"]["thisWeek"];
            }
        }

//        dd($deliveries);

        //GET THIS WEEK VALUES FOR TO DATE
        $deliveries = $this->getDeliveriesAsOf($currentReportNo,$weeklyReport);
        foreach ($deliveries as $delivery){
            array_push($sugarClassUsed, $delivery->sugar_class);
            if($delivery->refining != 1){
                //if not for refining
                $arr["withdrawals"][$delivery->sugar_class]["currentCrop"]["toDate"] = $delivery->currentTotal ?? 0;
                $arr["withdrawals"][$delivery->sugar_class]["prevCrop"]["toDate"] = $delivery->prevTotal ?? 0;
                $withdrawCTotalToDate += $arr["withdrawals"][$delivery->sugar_class]["currentCrop"]["toDate"];
                $withdrawPTotalToDate += $arr["withdrawals"][$delivery->sugar_class]["prevCrop"]["toDate"];
            }else{
                //if for refining
                $arr["withdrawals_for_refining"][$delivery->sugar_class]["currentCrop"]["toDate"] = $delivery->currentTotal;
                $arr["withdrawals_for_refining"][$delivery->sugar_class]["prevCrop"]["toDate"] = $delivery->prevTotal;
                $withdrawRefCTotalToDate += $arr["withdrawals_for_refining"][$delivery->sugar_class]["currentCrop"]["toDate"];
                $withdrawRefPTotalToDate += $arr["withdrawals_for_refining"][$delivery->sugar_class]["prevCrop"]["toDate"];
            }
        }

        //GET DELIVERIES OF PREV WEEK
        $deliveries = $this->getDeliveriesAsOf($currentReportNo * 1 - 1,$weeklyReport);
        foreach ($deliveries as $delivery){
            array_push($sugarClassUsed, $delivery->sugar_class);
            if($delivery->refining != 1){
                //if not for refining
                $arr["withdrawals"][$delivery->sugar_class]["currentCrop"]["prevWeek"] = $delivery->currentTotal ?? 0;
                $arr["withdrawals"][$delivery->sugar_class]["prevCrop"]["prevWeek"] = $delivery->prevTotal ?? 0;
                $withdrawCTotalPrevWeek += $arr["withdrawals"][$delivery->sugar_class]["currentCrop"]["prevWeek"];
                $withdrawPTotalPrevWeek += $arr["withdrawals"][$delivery->sugar_class]["prevCrop"]["prevWeek"];
            }else{
                //if for refining
                $arr["withdrawals_for_refining"][$delivery->sugar_class]["currentCrop"]["prevWeek"] = $delivery->currentTotal;
                $arr["withdrawals_for_refining"][$delivery->sugar_class]["prevCrop"]["prevWeek"] = $delivery->prevTotal;
                $withdrawRefCTotalPrevWeek += $arr["withdrawals_for_refining"][$delivery->sugar_class]["currentCrop"]["prevWeek"];
                $withdrawRefPTotalPrevWeek += $arr["withdrawals_for_refining"][$delivery->sugar_class]["prevCrop"]["prevWeek"];
            }
        }



        //WITHDRAW TOTAL LOUIS
        $arr["totalWithdraw"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($withdrawCTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($withdrawCTotalPrevWeek, 3, '.', ','),
                "toDate"=>number_format($withdrawCTotalToDate, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format($withdrawPTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($withdrawPTotalPrevWeek, 3, '.', ','),
                "toDate"=>number_format($withdrawPTotalToDate, 3, '.', ','),
            ],
        ];

        //REFINED WITHDRAW TOTAL LOUIS
        $arr["totalWithdrawRef"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($withdrawRefCTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($withdrawRefCTotalPrevWeek, 3, '.', ','),
                "toDate"=>number_format($withdrawRefCTotalToDate, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format($withdrawRefPTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($withdrawRefPTotalPrevWeek, 3, '.', ','),
                "toDate"=>number_format($withdrawRefPTotalToDate, 3, '.', ','),
            ],
        ];

        //ALL WITHDRAW TOTAL LOUIS
        $arr["totalAllWithdraw"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($withdrawRefCTotalThisWeek + $withdrawCTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($withdrawRefCTotalPrevWeek + $withdrawCTotalPrevWeek, 3, '.', ','),
                "toDate"=>number_format($withdrawRefCTotalToDate + $withdrawCTotalToDate, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format($withdrawRefPTotalThisWeek + $withdrawPTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($withdrawRefPTotalPrevWeek + $withdrawPTotalPrevWeek, 3, '.', ','),
                "toDate"=>number_format($withdrawRefPTotalToDate + $withdrawPTotalToDate, 3, '.', ','),
            ],
        ];

        //DECLARATION OF VARIABLES LOUIS 3-20-2024
        //TOTAL BALANCE VARIABLE
        $balanceCTotalThisWeek = 0;
        $balanceCTotalPrevWeek = 0;
        $balanceCTotalToDate = 0;
        $balancePTotalThisWeek = 0;
        $balancePTotalPrevWeek = 0;
        $balancePTotalToDate = 0;

        //TOTAL ISSUANCE VARIABLE
        $issuancesCTotalThisWeek = 0;
        $issuancesCTotalPrevWeek = 0;
        $issuancesCTotalToDate = 0;
        $issuancesPTotalThisWeek = 0;
        $issuancesPTotalPrevWeek = 0;
        $issuancesPTotalToDate = 0;

        //UNQUEDANNED VARIABLE
        $unquedannedCThisWeek = 0;
        $unquedannedCPrevWeek = 0;
        $unquedannedCToDate = 0;
        $unquedannedPThisWeek = 0;
        $unquedannedPPrevWeek = 0;
        $unquedannedPToDate = 0;

        //STOCK BALANCE VARIABLE
        $stockBalCThisWeek = 0;
        $stockBalCPrevWeek = 0;
        $stockBalCToDate = 0;
        $stockBalPThisWeek = 0;
        $stockBalPPrevWeek = 0;
        $stockBalPToDate = 0;

        //GET AND COMPUTE BALANCE WITH BALANCE TOTAL LOUIS 3-22-2024
        $sugarClassUsed = array_unique($sugarClassUsed);
        foreach ($sugarClassUsed as $sugarClass) {

            //CURRENT BALANCE COMPUTATION LOUIS 3-21-2024
//            if($sugarClass == "B to C")
//            {
//                $arr["balance"]["B"]["currentCrop"]["thisWeek"] =
//                    ($arr["issuances"]["B"]["currentCrop"]["thisWeek"] ?? 0) -
//                    ($arr["withdrawals"]["B to C"]["currentCrop"]["thisWeek"] ?? 0) -
//                    ($arr["withdrawals_for_refining"]["B to C"]["currentCrop"]["thisWeek"] ?? 0) ;
//                $arr["balance"]["B"]["currentCrop"]["prevWeek"] =
//                    ($arr["issuances"]["B"]["currentCrop"]["prevWeek"] ?? 0) -
//                    ($arr["withdrawals"]["B to C"]["currentCrop"]["prevWeek"] ?? 0) -
//                    ($arr["withdrawals_for_refining"]["B to C"]["currentCrop"]["prevWeek"] ?? 0) ;
//                $arr["balance"]["B"]["currentCrop"]["toDate"] =
//                    ($arr["issuances"]["B"]["currentCrop"]["toDate"] ?? 0) -
//                    ($arr["withdrawals"]["B to C"]["currentCrop"]["toDate"] ?? 0) -
//                    ($arr["withdrawals_for_refining"]["B to C"]["currentCrop"]["toDate"] ?? 0) ;
//
//                //PREVIOUS BALANCE COMPUTATION LOUIS 3-21-2024
//                $arr["balance"]["B"]["prevCrop"]["thisWeek"] =
//                    ($arr["issuances"]["B"]["prevCrop"]["thisWeek"] ?? 0) -
//                    ($arr["withdrawals"]["B to C"]["prevCrop"]["thisWeek"] ?? 0) -
//                    ($arr["withdrawals_for_refining"]["B to C"]["prevCrop"]["thisWeek"] ?? 0) ;
//                $arr["balance"]["B"]["prevCrop"]["prevWeek"] =
//                    ($arr["issuances"]["B"]["prevCrop"]["prevWeek"] ?? 0) -
//                    ($arr["withdrawals"]["B to C"]["prevCrop"]["prevWeek"] ?? 0) -
//                    ($arr["withdrawals_for_refining"]["B to C"]["prevCrop"]["prevWeek"] ?? 0) ;
//                $arr["balance"]["B"]["prevCrop"]["toDate"] =
//                    ($arr["issuances"]["B"]["prevCrop"]["toDate"] ?? 0) -
//                    ($arr["withdrawals"]["B to C"]["prevCrop"]["toDate"] ?? 0) -
//                    ($arr["withdrawals_for_refining"]["B to C"]["prevCrop"]["toDate"] ?? 0) ;
//            }
//            else
//            {
//                $arr["balance"][$sugarClass]["currentCrop"]["thisWeek"] =
//                    ($arr["issuances"][$sugarClass]["currentCrop"]["thisWeek"] ?? 0) -
//                    ($arr["withdrawals"][$sugarClass]["currentCrop"]["thisWeek"] ?? 0) -
//                    ($arr["withdrawals_for_refining"][$sugarClass]["currentCrop"]["thisWeek"] ?? 0) ;
//                $arr["balance"][$sugarClass]["currentCrop"]["prevWeek"] =
//                    ($arr["issuances"][$sugarClass]["currentCrop"]["prevWeek"] ?? 0) -
//                    ($arr["withdrawals"][$sugarClass]["currentCrop"]["prevWeek"] ?? 0) -
//                    ($arr["withdrawals_for_refining"][$sugarClass]["currentCrop"]["prevWeek"] ?? 0) ;
//                $arr["balance"][$sugarClass]["currentCrop"]["toDate"] =
//                    ($arr["issuances"][$sugarClass]["currentCrop"]["toDate"] ?? 0) -
//                    ($arr["withdrawals"][$sugarClass]["currentCrop"]["toDate"] ?? 0) -
//                    ($arr["withdrawals_for_refining"][$sugarClass]["currentCrop"]["toDate"] ?? 0) ;
//
//                //PREVIOUS BALANCE COMPUTATION LOUIS 3-21-2024
//                $arr["balance"][$sugarClass]["prevCrop"]["thisWeek"] =
//                    ($arr["issuances"][$sugarClass]["prevCrop"]["thisWeek"] ?? 0) -
//                    ($arr["withdrawals"][$sugarClass]["prevCrop"]["thisWeek"] ?? 0) -
//                    ($arr["withdrawals_for_refining"][$sugarClass]["prevCrop"]["thisWeek"] ?? 0) ;
//                $arr["balance"][$sugarClass]["prevCrop"]["prevWeek"] =
//                    ($arr["issuances"][$sugarClass]["prevCrop"]["prevWeek"] ?? 0) -
//                    ($arr["withdrawals"][$sugarClass]["prevCrop"]["prevWeek"] ?? 0) -
//                    ($arr["withdrawals_for_refining"][$sugarClass]["prevCrop"]["prevWeek"] ?? 0) ;
//                $arr["balance"][$sugarClass]["prevCrop"]["toDate"] =
//                    ($arr["issuances"][$sugarClass]["prevCrop"]["toDate"] ?? 0) -
//                    ($arr["withdrawals"][$sugarClass]["prevCrop"]["toDate"] ?? 0) -
//                    ($arr["withdrawals_for_refining"][$sugarClass]["prevCrop"]["toDate"] ?? 0) ;
//            }

            //CURRENT BALANCE COMPUTATION
            $arr["balance"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["thisWeek"] =
                ($arr["issuances"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["thisWeek"] ?? 0) -
                ($arr["withdrawalsRawData"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["thisWeek"] ?? 0) -
                ($arr["withdrawals_for_refiningRawData"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["thisWeek"] ?? 0) ;

            //OLD BALANCE CURRENT WEEK
//            $arr["balance"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["prevWeek"] =
//                ($arr["issuances"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["prevWeek"] ?? 0) -
//                ($arr["withdrawalsRawData"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["prevWeek"] ?? 0) -
//                ($arr["withdrawals_for_refiningRawData"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["prevWeek"] ?? 0) ;

//            NEW BALANCE CURRENT WEEK
            $arr["balance"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["prevWeek"] =
                ($arr["issuances"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["prevWeek"] ?? 0) -
                ($arr["withdrawals"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["prevWeek"] ?? 0) -
                ($arr["withdrawals_for_refiningRawData"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["prevWeek"] ?? 0) ;


            $arr["balance"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["toDate"] =
                ($arr["issuances"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["toDate"] ?? 0) -
//                CHANGES NEW BALANCES FORM 1 11-14-2024
                ($arr["withdrawals"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["toDate"] ?? 0) -
                ($arr["withdrawals_for_refiningRawData"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["toDate"] ?? 0) ;


            //PREVIOUS BALANCE COMPUTATION LOUIS 3-21-2024
            $arr["balance"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["thisWeek"] =
                ($arr["issuances"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["thisWeek"] ?? 0) -
                ($arr["withdrawalsRawData"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["thisWeek"] ?? 0) -
                ($arr["withdrawals_for_refiningRawData"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["thisWeek"] ?? 0) ;

//            PREV WEEK BALANCE
            $arr["balance"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["prevWeek"] =
                ($arr["issuances"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["prevWeek"] ?? 0) -
                ($arr["withdrawals"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["prevWeek"] ?? 0) -
                ($arr["withdrawals_for_refining"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["prevWeek"] ?? 0) ;

//            $arr["balance"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["toDate"] =
//                ($arr["issuances"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["toDate"] ?? 0) -
//                ($arr["withdrawalsRawData"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["toDate"] ?? 0) -
//                ($arr["withdrawals_for_refiningRawData"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["toDate"] ?? 0) ;

            $arr["balance"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["toDate"] =
                $arr["balance"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["prevWeek"] +
                $arr["balance"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["thisWeek"];
//                ($arr["issuances"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["toDate"] ?? 0) -
//                ($arr["withdrawals_for_refining"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["toDate"] ?? 0) -
//                ($arr["withdrawals"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["toDate"] ?? 0) -
//                ($arr["withdrawals_for_refiningRawData"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["toDate"] ?? 0);


//                CHANGES NEW BALANCES FORM 1 11-14-2024
//            $arr["balance"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["toDate"] =
//                ($arr["issuances"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["prevWeek"] ?? 0) -
//                ($arr["withdrawalsRawData"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["prevWeek"] ?? 0) -
//                ($arr["withdrawals_for_refiningRawData"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["prevWeek"] ?? 0) -
//                ($arr["issuances"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["thisWeek"] ?? 0) -
//                ($arr["withdrawalsRawData"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["thisWeek"] ?? 0) -
//                ($arr["withdrawals_for_refiningRawData"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["thisWeek"] ?? 0);

//            BALANCE TOTAL COMPUTATION LOUIS 3-25-2024
//            $balanceCTotalThisWeek += ($arr["balance"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["thisWeek"] ?? 0);
//            $balanceCTotalPrevWeek += ($arr["balance"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["prevWeek"] ?? 0);
//            $balanceCTotalToDate += ($arr["balance"][$sugarClassesCharge[$sugarClass]]["currentCrop"]["toDate"] ?? 0);
//            $balancePTotalThisWeek += ($arr["balance"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["thisWeek"] ?? 0);
//            $balancePTotalPrevWeek += ($arr["balance"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["prevWeek"] ?? 0);
//            $balancePTotalToDate += ($arr["balance"][$sugarClassesCharge[$sugarClass]]["prevCrop"]["toDate"] ?? 0);

//            $arr["totalBalance"] = [
//                "currentCrop"=>[
//                    "thisWeek"=>number_format($balanceCTotalThisWeek, 3, '.', ','),
//                    "prevWeek"=>number_format($balanceCTotalPrevWeek, 3, '.', ','),
//                    "toDate"=>number_format($balanceCTotalToDate, 3, '.', ','),
//                ],
//                "prevCrop"=>[
//                    "thisWeek"=>number_format($balancePTotalThisWeek, 3, '.', ','),
//                    "prevWeek"=>number_format($balancePTotalPrevWeek, 3, '.', ','),
//                    "toDate"=>number_format($balancePTotalToDate, 3, '.', ','),
//                ],
//            ];

            //ISSUANCES TOTAL COMPUTATION LOUIS 3-25-2024
            $issuancesCTotalThisWeek += ($arr["issuances"][$sugarClass]["currentCrop"]["thisWeek"] ?? 0);
            $issuancesCTotalPrevWeek += ($arr["issuances"][$sugarClass]["currentCrop"]["prevWeek"] ?? 0);
            $issuancesCTotalToDate += ($arr["issuances"][$sugarClass]["currentCrop"]["toDate"] ?? 0);
            $issuancesPTotalThisWeek += ($arr["issuances"][$sugarClass]["prevCrop"]["thisWeek"] ?? 0);
            $issuancesPTotalPrevWeek += ($arr["issuances"][$sugarClass]["prevCrop"]["prevWeek"] ?? 0);
            $issuancesPTotalToDate += ($arr["issuances"][$sugarClass]["prevCrop"]["toDate"] ?? 0);
        }

//        dd(($arr["withdrawalsRawData"][$sugarClassesCharge["B"]]["prevCrop"]["prevWeek"] ?? 0));

//        $arr['totalBalance'] = [];
//        if(isset($arr['balance'])) {
//            foreach ($arr['balance'] as $sClass => $a) {
//                $balanceCTotalThisWeek += ($arr["balance"][$sClass]["currentCrop"]["thisWeek"] ?? 0);
//                $balanceCTotalPrevWeek += ($arr["balance"][$sClass]["currentCrop"]["prevWeek"] ?? 0);
//                $balanceCTotalToDate += ($arr["balance"][$sClass]["currentCrop"]["toDate"] ?? 0);
//                $balancePTotalThisWeek += ($arr["balance"][$sClass]["prevCrop"]["thisWeek"] ?? 0);
//                $balancePTotalPrevWeek += ($arr["balance"][$sClass]["prevCrop"]["prevWeek"] ?? 0);
//                $balancePTotalToDate += ($arr["balance"][$sClass]["prevCrop"]["toDate"] ?? 0);
//
//                $arr["totalBalance"] = [
//                    "currentCrop" => [
//                        "thisWeek" => number_format($balanceCTotalThisWeek, 3, '.', ','),
//                        "prevWeek" => number_format($balanceCTotalPrevWeek, 3, '.', ','),
//                        "toDate" => number_format($balanceCTotalToDate, 3, '.', ','),
//                    ],
//                    "prevCrop" => [
//                        "thisWeek" => number_format($balancePTotalThisWeek, 3, '.', ','),
//                        "prevWeek" => number_format($balancePTotalPrevWeek, 3, '.', ','),
//                        "toDate" => number_format($balancePTotalToDate, 3, '.', ','),
//                    ],
//                ];
//            }
//        }

//        $arr['totalBalance'] = [];
//        if(isset($arr['balance'])) {
//            foreach ($arr['balance'] as $sClass => $a) {
//                $balanceCTotalThisWeek += ($arr["balance"][$sClass]["currentCrop"]["thisWeek"] ?? 0);
//                $balanceCTotalPrevWeek += ($arr["balance"][$sClass]["currentCrop"]["prevWeek"] ?? 0);
//                $balanceCTotalToDate += ($arr["balance"][$sClass]["currentCrop"]["toDate"] ?? 0);
//                $balancePTotalThisWeek += ($arr["balance"][$sClass]["prevCrop"]["thisWeek"] ?? 0);
//                $balancePTotalPrevWeek += ($arr["balance"][$sClass]["prevCrop"]["prevWeek"] ?? 0);
//                $balancePTotalToDate += ($arr["balance"][$sClass]["prevCrop"]["toDate"] ?? 0);
//
//                $arr["totalBalance"] = [
//                    "currentCrop" => [
//                        "thisWeek" => number_format($balanceCTotalThisWeek, 3, '.', ','),
//                        "prevWeek" => number_format($balanceCTotalPrevWeek, 3, '.', ','),
//                        "toDate" => number_format($balanceCTotalToDate, 3, '.', ','),
//                    ],
//                    "prevCrop" => [
//                        "thisWeek" => number_format($balancePTotalThisWeek, 3, '.', ','),
//                        "prevWeek" => number_format($balancePTotalPrevWeek, 3, '.', ','),
//                        "toDate" => number_format($balancePTotalToDate, 3, '.', ','),
//                    ],
//                ];
//            }
//        }



        $arr["totalIssuances"] = [
            "currentCrop"=>[
                "thisWeek"=>number_format($issuancesCTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($issuancesCTotalPrevWeek, 3, '.', ','),
                "toDate"=>number_format($issuancesCTotalToDate, 3, '.', ','),
            ],
            "prevCrop"=>[
                "thisWeek"=>number_format($issuancesPTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($issuancesPTotalPrevWeek, 3, '.', ','),
                "toDate"=>number_format($issuancesPTotalToDate, 3, '.', ','),
            ],
        ];

        $arr['totalBalance'] = [];
        if(isset($arr['balance'])) {
            foreach ($arr['balance'] as $sClass => $a) {
                $balanceCTotalThisWeek += ($arr["balance"][$sClass]["currentCrop"]["thisWeek"] ?? 0);
                $balanceCTotalPrevWeek += ($arr["balance"][$sClass]["currentCrop"]["prevWeek"] ?? 0);
                $balanceCTotalToDate += ($arr["balance"][$sClass]["currentCrop"]["toDate"] ?? 0);
                $balancePTotalThisWeek += ($arr["balance"][$sClass]["prevCrop"]["thisWeek"] ?? 0);
                $balancePTotalPrevWeek += ($arr["balance"][$sClass]["prevCrop"]["prevWeek"] ?? 0);
                $balancePTotalToDate += ($arr["balance"][$sClass]["prevCrop"]["toDate"] ?? 0);

                $arr["totalBalance"] = [
                    "currentCrop" => [
                        "thisWeek" => number_format($balanceCTotalThisWeek, 3, '.', ','),
                        "prevWeek" => number_format($balanceCTotalPrevWeek, 3, '.', ','),
                        "toDate" => number_format($balanceCTotalToDate, 3, '.', ','),
                    ],
                    "prevCrop" => [
                        "thisWeek" => number_format($balancePTotalThisWeek, 3, '.', ','),
                        "prevWeek" => number_format($balancePTotalPrevWeek, 3, '.', ','),
//                        "toDate" => number_format($balancePTotalToDate, 3, '.', ','),
                        "toDate" => number_format($balancePTotalPrevWeek+$balancePTotalThisWeek, 3, '.', ','),
                    ],
                ];
            }
        }



        //UNQUEDANNED FORMULA LOUIS 3-25-2024 (MANUFACTURED - TOTAL ISSUANCE) NEW - STOCK BALANCE
        $arr["stockBal"] = [
//            "currentCrop"=>[
//                "thisWeek"=>number_format(($arr["manufactured"]["currentCrop"]["thisWeek"]) - $issuancesCTotalThisWeek, 3, '.', ','),
//                "prevWeek"=>number_format(($arr["manufactured"]["currentCrop"]["prevWeek"]) - $issuancesCTotalPrevWeek, 3, '.', ','),
//                "toDate"=>number_format(($arr["manufactured"]["currentCrop"]["toDate"]) - $issuancesCTotalToDate, 3, '.', ','),
//            ],

//            NEW STOCK BALANCE FORMULA LOUIS 11-14-2024
            "currentCrop"=>[
                "thisWeek"=>number_format($balanceCTotalThisWeek + ($thisWeek->manufactured - $issuancesCTotalThisWeek), 3, '.', ','),
                "prevWeek"=>number_format($balanceCTotalPrevWeek + ($prevWeek->manufactured - $issuancesCTotalPrevWeek), 3, '.', ','),
                "toDate"=>number_format($balanceCTotalToDate + ($toDate->manufactured - $issuancesCTotalToDate), 3, '.', ','),
            ],
//            "prevCrop"=>[
//                "thisWeek"=>number_format(($arr["manufactured"]["prevCrop"]["thisWeek"]) - $issuancesPTotalThisWeek, 3, '.', ','),
//                "prevWeek"=>number_format(($arr["manufactured"]["prevCrop"]["prevWeek"]) - $issuancesPTotalPrevWeek, 3, '.', ','),
//                "toDate"=>number_format(($arr["manufactured"]["prevCrop"]["toDate"]) - $issuancesPTotalToDate, 3, '.', ','),
//            ],
//            "prevCrop"=>[
//                "thisWeek"=>number_format($issuancesPTotalThisWeek - $withdrawPTotalThisWeek, 3, '.', ','),
//                "prevWeek"=>number_format($issuancesPTotalPrevWeek - $withdrawPTotalPrevWeek, 3, '.', ','),
//                "toDate"=>number_format($issuancesPTotalToDate - $withdrawPTotalToDate, 3, '.', ','),
//            ],

//            NEW STOCK BALANCE PREVIOUS CROP FORMULA LOUIS 11-14-2024
            "prevCrop"=>[
                "thisWeek"=>number_format(($balancePTotalThisWeek)+($thisWeek->form1_prev_unquedanned), 3, '.', ','),
                "prevWeek"=>number_format(($balancePTotalPrevWeek)+($prevWeek->form1_prev_unquedanned), 3, '.', ','),
                "toDate"=>number_format(($balancePTotalPrevWeek+$balancePTotalThisWeek)+($toDate->form1_prev_unquedanned), 3, '.', ','),
            ],
        ];

        //STOCK BALANCE FORMULA LOUIS 3-25-2024 (TOTAL BALANCE + UNQUEDANNED) NEW - UNQUEDANNED
        $arr["unquedanned"] = [
//            "currentCrop"=>[
//                "thisWeek"=>number_format(($balanceCTotalThisWeek) + (($arr["manufactured"]["currentCrop"]["thisWeek"]) - $issuancesCTotalThisWeek), 3, '.', ','),
//                "prevWeek"=>number_format(($balanceCTotalPrevWeek) + (($arr["manufactured"]["currentCrop"]["prevWeek"]) - $issuancesCTotalPrevWeek), 3, '.', ','),
//                "toDate"=>number_format(($balanceCTotalToDate) + (($arr["manufactured"]["currentCrop"]["toDate"]) - $issuancesCTotalToDate), 3, '.', ','),
//            ],

//            NEW UNQUEDANNED FORMULA CURRENT YEAR 11-14-2024
            "currentCrop"=>[
                "thisWeek"=>number_format($thisWeek->manufactured- $issuancesCTotalThisWeek, 3, '.', ','),
                "prevWeek"=>number_format($prevWeek->manufactured - $issuancesCTotalPrevWeek, 3, '.', ','),
                "toDate"=>number_format($toDate->manufactured - $issuancesCTotalToDate, 3, '.', ','),
            ],

//            "prevCrop"=>[
//                "thisWeek"=>number_format(($balancePTotalThisWeek) + (($arr["manufactured"]["prevCrop"]["thisWeek"]) - $issuancesPTotalThisWeek), 3, '.', ','),
//                "prevWeek"=>number_format(($balancePTotalPrevWeek) + (($arr["manufactured"]["prevCrop"]["prevWeek"]) - $issuancesPTotalPrevWeek), 3, '.', ','),
//                "toDate"=>number_format(($balancePTotalToDate) + (($arr["manufactured"]["prevCrop"]["toDate"]) - $issuancesPTotalToDate), 3, '.', ','),
//            ],
        ];
        $arr["unquedanned"]["prevCrop"]["thisWeek"]=number_format($thisWeek->form1_prev_unquedanned, 3, '.', ',');
        $arr["unquedanned"]["prevCrop"]["prevWeek"]=number_format($prevWeek->form1_prev_unquedanned, 3, '.', ',');
        $arr["unquedanned"]["prevCrop"]["toDate"]=number_format($toDate->form1_prev_unquedanned, 3, '.', ',');

        //TRANSFERS TO REFINERY COMPUTATION
        $arr["transfersToRef"]["currentCrop"]["thisWeek"]=number_format($thisWeek->transfers_to_refinery, 3, '.', ',');
        $arr["transfersToRef"]["currentCrop"]["prevWeek"]=number_format($prevWeek->transfers_to_refinery, 3, '.', ',');
        $arr["transfersToRef"]["currentCrop"]["toDate"]=number_format($toDate->transfers_to_refinery, 3, '.', ',');
        $arr["transfersToRef"]["prevCrop"]["thisWeek"]=number_format($thisWeek->prev_transfers_to_refinery, 3, '.', ',');
        $arr["transfersToRef"]["prevCrop"]["prevWeek"]=number_format($prevWeek->prev_transfers_to_refinery, 3, '.', ',');
        $arr["transfersToRef"]["prevCrop"]["toDate"]=number_format($toDate->prev_transfers_to_refinery, 3, '.', ',');

//        //l STOCK COMPUTATION
//        $arr["physicalStock"] = [
//            "currentCrop"=>[
//                "thisWeek"=>number_format((($balanceCTotalThisWeek) + (($arr["manufactured"]["currentCrop"]["thisWeek"]) - $issuancesCTotalThisWeek)) - ($arr["transfersToRef"]["currentCrop"]["thisWeek"]=$thisWeek2->notCoveredBySro), 3, '.', ','),
//                "prevWeek"=>number_format((($balanceCTotalPrevWeek) + (($arr["manufactured"]["currentCrop"]["prevWeek"]) - $issuancesCTotalPrevWeek)) - ($arr["transfersToRef"]["currentCrop"]["prevWeek"]=$prevWeek2->notCoveredBySro), 3, '.', ','),
//                "toDate"=>number_format((($balanceCTotalToDate) + (($arr["manufactured"]["currentCrop"]["toDate"]) - $issuancesCTotalToDate)) - ($arr["transfersToRef"]["currentCrop"]["toDate"]=$toDate2->notCoveredBySro), 3, '.', ','),
//            ],
//            "prevCrop"=>[
//                "thisWeek"=>number_format((($balancePTotalThisWeek) + (($arr["manufactured"]["prevCrop"]["thisWeek"]) - $issuancesPTotalThisWeek)) - ($arr["transfersToRef"]["prevCrop"]["thisWeek"]=$thisWeek2->prev_notCoveredBySro), 3, '.', ','),
//                "prevWeek"=>number_format((($balancePTotalPrevWeek) + (($arr["manufactured"]["prevCrop"]["prevWeek"]) - $issuancesPTotalPrevWeek)) - ($arr["transfersToRef"]["prevCrop"]["prevWeek"]=$prevWeek2->prev_notCoveredBySro), 3, '.', ','),
//                "toDate"=>number_format((($balancePTotalToDate) + (($arr["manufactured"]["prevCrop"]["toDate"]) - $issuancesPTotalToDate)) - ($arr["transfersToRef"]["prevCrop"]["toDate"]=$toDate2->prev_notCoveredBySro), 3, '.', ','),
//            ],
//        ];

        //PHYSICAL STOCK COMPUTATION
        $arr["physicalStock"] = [
//            "currentCrop"=>[
//                "thisWeek"=>number_format(($arr["manufactured"]["currentCrop"]["thisWeek"]) - $issuancesCTotalThisWeek - ($arr["transfersToRef"]["currentCrop"]["thisWeek"]=$thisWeek->transfers_to_refinery), 3, '.', ','),
//                "prevWeek"=>number_format(($arr["manufactured"]["currentCrop"]["prevWeek"]) - $issuancesCTotalPrevWeek - ($arr["transfersToRef"]["currentCrop"]["prevWeek"]=$prevWeek->transfers_to_refinery), 3, '.', ','),
//                "toDate"=>number_format(($arr["manufactured"]["currentCrop"]["toDate"]) - $issuancesCTotalToDate - ($arr["transfersToRef"]["currentCrop"]["toDate"]=$toDate->transfers_to_refinery), 3, '.', ','),
//            ],

//        NEW CURRENT PHYSICAL STOCK FORMULA 11-14-2024
            "currentCrop"=>[
                "thisWeek"=>number_format(($balanceCTotalThisWeek + ($thisWeek->manufactured - $issuancesCTotalThisWeek)) - ($thisWeek->transfers_to_refinery), 3, '.', ','),
                "prevWeek"=>number_format(($balanceCTotalPrevWeek + ($prevWeek->manufactured - $issuancesCTotalPrevWeek)) - ($prevWeek->transfers_to_refinery) , 3, '.', ','),
                "toDate"=>number_format(($balanceCTotalToDate + ($toDate->manufactured - $issuancesCTotalToDate)) - ($toDate->transfers_to_refinery) , 3, '.', ','),
            ],

//            "prevCrop"=>[
//                "thisWeek"=>number_format(($issuancesPTotalThisWeek - $withdrawPTotalThisWeek) - ($arr["transfersToRef"]["prevCrop"]["thisWeek"]=$thisWeek->prev_transfers_to_refinery), 3, '.', ','),
//                "prevWeek"=>number_format(($issuancesPTotalPrevWeek - $withdrawPTotalPrevWeek) - ($arr["transfersToRef"]["prevCrop"]["prevWeek"]=$prevWeek->prev_transfers_to_refinery), 3, '.', ','),
//                "toDate"=>number_format(($issuancesPTotalToDate - $withdrawPTotalToDate) - ($arr["transfersToRef"]["prevCrop"]["toDate"]=$toDate->prev_transfers_to_refinery), 3, '.', ','),
//            ],

//        NEW PREVIOUS PHYSICAL STOCK FORMULA 11-14-2024
            "prevCrop"=>[
                "thisWeek"=>number_format((($balancePTotalThisWeek)+($thisWeek->form1_prev_unquedanned))-($thisWeek->prev_transfers_to_refinery), 3, '.', ','),
                "prevWeek"=>number_format((($balancePTotalPrevWeek)+($prevWeek->form1_prev_unquedanned))-($prevWeek->prev_transfers_to_refinery), 3, '.', ','),
                "toDate"=>number_format((($balancePTotalPrevWeek+$balancePTotalThisWeek)+($toDate->form1_prev_unquedanned))-($toDate->prev_transfers_to_refinery), 3, '.', ','),
            ],
        ];


        if(isset($arr['balance'])){
            krsort( $arr['balance']);
        }
        if(isset($arr['issuances'])){
            krsort( $arr['issuances']);
        }
        if(isset($arr['withdrawals'])){
            krsort( $arr['withdrawals']);
        }

        //TRANSFERS TO REFINERY COMPUTATION
        $arr["lkgtc_gross"]=number_format($thisWeek->lkgtc_gross, 3, '.', ',');
        $arr["lkgtc_net"]=number_format($thisWeek->lkgtc_net, 3, '.', ',');


//        dd($thisWeek);

        if(isset($arr['withdrawals_for_refining'])){krsort($arr['withdrawals_for_refining']);}
        return [
            'values' => collect($arr)->dot()->all(),
            'rows' => [
                'withdrawals' => $arr['withdrawals'] ?? 0,
                'withdrawals_for_refining' => $arr['withdrawals_for_refining'] ?? null,
                'balance' => $arr['balance'] ?? 0,
                'issuances' => $arr['issuances'] ?? 0,
            ],
        ];
    }

    private function getDeliveriesAsOf($reportNo, $weeklyReport){
        $deliveries = Deliveries::query()
            ->selectRaw('weekly_report_slug,trader, refining,sugar_class, sum(qty) as currentTotal, sum(qty_prev) as prevTotal, weekly_reports.*')
            ->leftJoin('weekly_reports','weekly_reports.slug','=','form5_deliveries.weekly_report_slug')
            ->where('crop_year','=',$weeklyReport->crop_year)
            ->where('mill_code','=',$weeklyReport->mill_code)
//            ->where('report_no','<=', $reportNo != 0 ? $reportNo : $weeklyReport->report_no * 1)
//            ->where('report_no','<=', $report_no != 0 ? $report_no : $weekly_report->report_no * 1)
            ->where('report_no','<=', $reportNo)
            ->where(function($q){
                $q->where('weekly_reports.status' ,'!=', -1)
                    ->orWhere('weekly_reports.status', '=', null);
            })
            ->groupBy('refining','sugar_class')
            ->orderBy('sugar_class','asc')
            ->get();
        return $deliveries;
    }

}