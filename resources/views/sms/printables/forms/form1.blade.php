<div id="form1" style="break-after: page">
    @include('sms.printables.forms.header',['formName' => 'SMS Form No. 1'])

    <h4 class="no-margin"><b>WEEKLY REPORT ON RAW SUGAR</b></h4>
{{--    <p class="no-margin"><i>(Figures in 50-Kg Bags)</i></p>--}}
    <p class="no-margin"><i>(Figures in Metric Tons)</i></p>
    <table class="table-bordered " style="width: 100%">
        <thead>
        <tr >
            <th rowspan="2"></th>
            <th colspan="3" class="text-center" style="width: 35%">CURRENT CROP</th>
            <th colspan="3" class="text-center" style="width: 35%">PREVIOUS CROP</th>
        </tr>
        <tr>
            <th class="text-center">This Week</th>
            <th class="text-center">Previous</th>
            <th class="text-center">To-date</th>
            <th class="text-center">This Week</th>
            <th class="text-center">Previous</th>
            <th class="text-center">To-date</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1. MANUFACTURED</td>
{{--            @dd($newform1);--}}
            <td class="text-right">
                {{ $newform1['values']['manufactured.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{ $newform1['values']['manufactured.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform1['values']['manufactured.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform1['values']['manufactured.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform1['values']['manufactured.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform1['values']['manufactured.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>

        <tr>
            <td colspan="4">2. ISSUANCES/CARRY-OVER</td>
        </tr>

        {{--NEW ISSUANCES PRINTING LOUIS 2-5-2025--}}
        @if(!empty($newform1["rows"]["issuances"]))
            @php
                $rowsissuances = $newform1["rows"]["issuances"];
                ksort($rowsissuances);
            @endphp
            @foreach($rowsissuances as $sugarclass => $issuances)
                <tr>
                    <td><span class="indent"></span><span class="indent"></span> {{$sugarclass}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($issuances["currentCrop"]["thisWeek"] ?? 0,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($issuances["currentCrop"]["prevWeek"] ?? 0 ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($issuances["currentCrop"]["toDate"] ?? 0 ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($issuances["prevCrop"]["thisWeek"] ?? 0,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($issuances["prevCrop"]["prevWeek"] ?? 0 ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($issuances["prevCrop"]["toDate"] ?? 0 ,3)}}</td>
                </tr>
            @endforeach
        @endif

        <tr>
            <td class="text-right">TOTAL</td>
            <td class="text-right text-strong">{{$newform1['values']['totalIssuances.currentCrop.thisWeek'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalIssuances.currentCrop.prevWeek'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalIssuances.currentCrop.toDate'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalIssuances.prevCrop.thisWeek'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalIssuances.prevCrop.prevWeek'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalIssuances.prevCrop.toDate'] ?? 0 }}</td>
        </tr>

        <tr>
            <td colspan="7">3. WITHDRAWALS</td>
        </tr>

        <tr>
            <td colspan="7"><span class="indent"></span> 3.1. Exports/Domestic/World</td>
        </tr>

        {{--NEW WITHDRAWALS PRINTING LOUIS 2-5-2025--}}
        @if(!empty($newform1["rows"]["withdrawals"]))
            @php
            $rowswithdrawals = $newform1["rows"]["withdrawals"];
            ksort($rowswithdrawals);
            @endphp
            @foreach($rowswithdrawals as $sugarclass => $withdrawals)
                <tr>
                    <td><span class="indent"></span><span class="indent"></span> {{$sugarclass}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($withdrawals["currentCrop"]["thisWeek"] ?? 0,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($withdrawals["currentCrop"]["prevWeek"] ?? 0 ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($withdrawals["currentCrop"]["toDate"] ?? 0 ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($withdrawals["prevCrop"]["thisWeek"] ?? 0,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($withdrawals["prevCrop"]["prevWeek"] ?? 0 ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($withdrawals["prevCrop"]["toDate"] ?? 0 ,3)}}</td>
                </tr>
            @endforeach
        @endif

        {{--{{dd($newform1)}}--}}

        <tr>
            <td class="text-right">3.1. Total</td>
            <td class="text-right text-strong">{{$newform1['values']['totalWithdraw.currentCrop.thisWeek'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalWithdraw.currentCrop.prevWeek'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalWithdraw.currentCrop.toDate'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalWithdraw.prevCrop.thisWeek'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalWithdraw.prevCrop.prevWeek'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalWithdraw.prevCrop.toDate'] ?? 0 }}</td>
        </tr>

        <tr>
            <td colspan="7"><span class="indent"></span>3.2. For Refining:</td>
        </tr>

        {{--NEW WITHDRAWALS REFINED PRINTING LOUIS 2-5-2025--}}
        @if(!empty($newform1["rows"]["withdrawals_for_refining"]))
            @php
                $rowswithdrawalsref = $newform1["rows"]["withdrawals_for_refining"];
                ksort($rowswithdrawalsref);
            @endphp
            @foreach($rowswithdrawalsref as $sugarclass => $withdrawals)
                <tr>
                    <td><span class="indent"></span><span class="indent"></span> {{$sugarclass}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($withdrawals["currentCrop"]["thisWeek"] ?? 0,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($withdrawals["currentCrop"]["prevWeek"] ?? 0 ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($withdrawals["currentCrop"]["toDate"] ?? 0 ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($withdrawals["prevCrop"]["thisWeek"] ?? 0,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($withdrawals["prevCrop"]["prevWeek"] ?? 0 ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($withdrawals["prevCrop"]["toDate"] ?? 0 ,3)}}</td>
                </tr>
            @endforeach
        @endif

        <tr>
            <td class="text-right">TOTAL WITHDRAWALS</td>
            <td class="text-right text-strong">{{$newform1['values']['totalAllWithdraw.currentCrop.thisWeek'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalAllWithdraw.currentCrop.prevWeek'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalAllWithdraw.currentCrop.toDate'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalAllWithdraw.prevCrop.thisWeek'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalAllWithdraw.prevCrop.prevWeek'] ?? 0 }}</td>
            <td class="text-right text-strong">{{$newform1['values']['totalAllWithdraw.prevCrop.toDate'] ?? 0 }}</td>
        </tr>

        <tr>
            <td colspan="7">4. BALANCE</td>
        </tr>

        {{--NEW BALANCE PRINTING LOUIS 2-5-2025--}}
        @if(!empty($newform1["rows"]["balance"]))
            @php
                $rowsbalance = $newform1["rows"]["balance"];
                ksort($rowsbalance);
            @endphp
            @foreach($rowsbalance as $sugarclass => $balance)
                <tr>
                    <td><span class="indent"></span><span class="indent"></span> {{$sugarclass}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($balance["currentCrop"]["thisWeek"] ?? 0,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($balance["currentCrop"]["prevWeek"] ?? 0 ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($balance["currentCrop"]["toDate"] ?? 0 ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($balance["prevCrop"]["thisWeek"] ?? 0,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($balance["prevCrop"]["prevWeek"] ?? 0 ,3)}}</td>
                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($balance["prevCrop"]["toDate"] ?? 0 ,3)}}</td>
                </tr>
            @endforeach
        @endif

        <tr>
            <td class="text-right">TOTAL</td>
             <td class="text-right text-strong">{{$newform1['values']['totalBalance.currentCrop.thisWeek'] ?? 0 }}</td>
             <td class="text-right text-strong">{{$newform1['values']['totalBalance.currentCrop.prevWeek'] ?? 0 }}</td>
             <td class="text-right text-strong">{{$newform1['values']['totalBalance.currentCrop.toDate'] ?? 0 }}</td>
             <td class="text-right text-strong">{{$newform1['values']['totalBalance.prevCrop.thisWeek'] ?? 0 }}</td>
             <td class="text-right text-strong">{{$newform1['values']['totalBalance.prevCrop.prevWeek'] ?? 0 }}</td>
             <td class="text-right text-strong">{{$newform1['values']['totalBalance.prevCrop.toDate'] ?? 0 }}</td>
        </tr>

        <tr>
            <td>5. UNQUEDANNED</td>
            <td class="text-right">{{$newform1['values']['unquedanned.currentCrop.thisWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['unquedanned.currentCrop.prevWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['unquedanned.currentCrop.toDate'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['unquedanned.prevCrop.thisWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['unquedanned.prevCrop.prevWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['unquedanned.prevCrop.toDate'] ?? 0 }}</td>
        </tr>
        <tr>
            <td>6. STOCK BALANCE</td>
            <td class="text-right">{{$newform1['values']['stockBal.currentCrop.thisWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['stockBal.currentCrop.prevWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['stockBal.currentCrop.toDate'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['stockBal.prevCrop.thisWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['stockBal.prevCrop.prevWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['stockBal.prevCrop.toDate'] ?? 0 }}</td>
        </tr>
        <tr>
            <td>7. TRANSFERS TO REFINERY</td>
            <td class="text-right">{{$newform1['values']['transfersToRef.currentCrop.thisWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['transfersToRef.currentCrop.prevWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['transfersToRef.currentCrop.toDate'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['transfersToRef.prevCrop.thisWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['transfersToRef.prevCrop.prevWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['transfersToRef.prevCrop.toDate'] ?? 0 }}</td>
        </tr>

        <tr>
            <td>8. PHYSICAL STOCK</td>
            <td class="text-right">{{$newform1['values']['physicalStock.currentCrop.thisWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['physicalStock.currentCrop.prevWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['physicalStock.currentCrop.toDate'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['physicalStock.prevCrop.thisWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['physicalStock.prevCrop.prevWeek'] ?? 0 }}</td>
            <td class="text-right">{{$newform1['values']['physicalStock.prevCrop.toDate'] ?? 0 }}</td>
        </tr>


        <tr>
            <td>9. TONS DUE CANE</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form1['tdc']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['tdc']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($wr->toDateForm1()->tdc ?? null,3) }}
            </td>
            <td class="text-strong" colspan="3">
                QUEDAN ISSUANCES
            </td>
        </tr>

        <tr>
            <td>10. GROSS TONS CANE MILLED</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form1['gtcm']['current']?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['gtcm']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($wr->toDateForm1()->gtcm ?? null,3) }}
            </td>
            @if(!empty($details_arr['RAW']['seriesNos']['A']))
                <td colspan="3">
                    <span class="text-strong">A: </span>
                    @foreach($details_arr['RAW']['seriesNos']['A'] as $sn)
                        {{$sn->seriesFrom ?? null}} - {{$sn->seriesTo ?? null}}  ({{$sn->noOfPcs ?? null}} pcs),
                    @endforeach
                </td>
            @else
                <td colspan="3"><span class="text-strong">A: </span></td>
            @endif
        </tr>

        <tr>
            <td>11. LKG/TC, Gross</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($form1['lkgtc_gross']['current']?? null,4) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['lkgtc_gross']['current'] ?? null,4) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm1['lkgtc_gross']['current'] ?? null,4) }}
            </td>


            @if(!empty($details_arr['RAW']['seriesNos']['B']))
                <td colspan="3">
                    <span class="text-strong">B: </span>
                @foreach($details_arr['RAW']['seriesNos']['B'] as $sn)
                    {{$sn->seriesFrom ?? null}} - {{$sn->seriesTo ?? null}}  ({{$sn->noOfPcs ?? null}} pcs),
                @endforeach
                </td>
            @else
                <td colspan="3"><span class="text-strong">B: </span></td>
            @endif
        </tr>


        @if($wr->sugarMill->syrup == 1)
            <tr>
                <td>9B. TONS DUE SYRUP</td>
                <td class="text-right">
                    {{ \App\Swep\Helpers\Helper::toNumber($form1['tds']['current'] ?? null,3) }}
                </td>
                <td class="text-right">
                    {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['tds']['current'] ?? null,3) }}
                </td>
                <td class="text-right">
                    {{ \App\Swep\Helpers\Helper::toNumber($wr->toDateForm1()->tds ?? null,3) }}
                </td>
                <td class="text-right">
                </td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>10B. EQUIVALENT GTCM</td>
                <td class="text-right">
                    {{ \App\Swep\Helpers\Helper::toNumber($form1['egtcm']['current']?? null,3) }}
                </td>
                <td class="text-right">
                    {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['egtcm']['current'] ?? null,3) }}
                </td>
                <td class="text-right">
                    {{ \App\Swep\Helpers\Helper::toNumber($wr->toDateForm1()->egtcm ?? null,3) }}
                </td>
                <td class="text-right">
                </td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>11B. LKG/TC, Gross - Syrup</td>
                <td class="text-right">
                    {{ \App\Swep\Helpers\Helper::toNumber($form1['lkgtc_gross_syrup']['current']?? null,3) }}
                </td>
                <td class="text-right">
                    {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['lkgtc_gross_syrup']['current'] ?? null,3) }}
                </td>
                <td class="text-right">
                    {{ \App\Swep\Helpers\Helper::toNumber($toDateForm1['lkgtc_gross_syrup']['current'] ?? null,3) }}
                </td>
                <td class="text-right">
                </td>
                <td></td>
                <td></td>
            </tr>
        @endif

{{--        <tr>--}}
{{--            <td>11. LGK/TC, GROSS	</td>--}}
{{--            <td class="text-right">--}}
{{--                {{ \App\Swep\Helpers\Helper::toNumber($form1['lkgtc_gross']['current'] ?? null,3) }}--}}
{{--            </td>--}}
{{--            <td class="text-right">--}}
{{--                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['lkgtc_gross']['current'] ?? null,3) }}--}}
{{--            </td>--}}
{{--            <td class="text-right">--}}
{{--                {{ \App\Swep\Helpers\Helper::toNumber($form1['lkgtc_gross']['current'] ?? null ,3) }}--}}
{{--            </td>--}}
{{--            <td class="text-right">--}}
{{--            </td>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--        </tr>--}}

        <tr>
            <td>12. A. PLANTER'S SHARE	</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->share_planter ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['share_planter']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($wr->toDateForm1()->share_planter ?? null,3) }}
            </td>
            @if(!empty($details_arr['RAW']['seriesNos']['C']))
                <td colspan="3">
                    <span class="text-strong">C: </span>
                    @foreach($details_arr['RAW']['seriesNos']['C'] as $sn)
                        {{$sn->seriesFrom ?? null}} - {{$sn->seriesTo ?? null}}  ({{$sn->noOfPcs ?? null}} pcs),
                    @endforeach
                </td>
            @else
                <td colspan="3"><span class="text-strong">C: </span></td>
            @endif
        </tr>

        <tr>
            <td>12. B. MILLER'S SHARE	</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->share_miller ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['share_miller']['current'] ?? null,3) }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($wr->toDateForm1()->share_miller ?? null,3) }}
            </td>
            @if(!empty($details_arr['RAW']['seriesNos']['D']))
                <td colspan="3">
                    <span class="text-strong">D: </span>
                    @foreach($details_arr['RAW']['seriesNos']['D'] as $sn)
                        {{$sn->seriesFrom ?? null}} - {{$sn->seriesTo ?? null}}  ({{$sn->noOfPcs ?? null}} pcs),
                    @endforeach
                </td>
            @else
                <td colspan="3"><span class="text-strong">D: </span></td>
            @endif
        </tr>

        </tbody>
    </table>

    <table class="table-bordered" style="width: 100%;">
        @php
            $a = 'prices';

        @endphp
        <tr>
            <td colspan="6">13. Mill District Price Monitoring</td>
            <td colspan="2">WHOLSESALE(PESO/LKG)</td>
            <td colspan="2">RETAIL(PESO/KILO)</td>
        </tr>
        <tr>
            <td><span class="indent"></span>A:</td>
            <td>
                ₱{{ \App\Swep\Helpers\Helper::toNumber($wr->form1->price_A ?? 0,2) }}
            </td>
            <td>C:</td>
            <td>
                ₱{{ \App\Swep\Helpers\Helper::toNumber($wr->form1->price_C ?? 0,2) }}
            </td>
            <td>DE:</td>
            <td>
                ₱{{ \App\Swep\Helpers\Helper::toNumber($wr->form1->price_DE ?? 0,2) }}
            </td>
            <td>RAW:</td>
            <td>
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->wholesale_raw ?? 0,2) }}
            </td>
            <td>RAW:</td>
            <td>
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->retail_raw ?? 0,2) }}
            </td>
        </tr>

        <tr>
            <td><span class="indent"></span>B:</td>
            <td>
                ₱{{ \App\Swep\Helpers\Helper::toNumber($wr->form1->price_B ?? 0,2) }}
            </td>
            <td>D:</td>
            <td>
                ₱{{ \App\Swep\Helpers\Helper::toNumber($wr->form1->price_D ?? 0,2) }}
            </td>
            <td>DR:</td>
            <td>
                ₱{{ \App\Swep\Helpers\Helper::toNumber($wr->form1->price_DR ?? 0,2) }}
            </td>
            <td>REFINED:</td>
            <td>
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->wholesale_refined ?? 0,2) }}
            </td>
            <td>REFINED:</td>
            <td>
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->retail_refined ?? 0,2) }}
            </td>
        </tr>

        <tr>
            <td>14. Sugar Distribution Factor: </td>
            <td colspan="9">
                {{ \App\Swep\Helpers\Helper::toNumber($wr->form1->dist_factor ?? 0,10) }}
            </td>
        </tr>
        <tr>
            <td>15. Remarks: </td>
            <td colspan="9">
                @php
                    $currentNet = \App\Swep\Helpers\Helper::toNumber($form1['lkgtc_net']['current'] ?? 0, 3);
                @endphp

                @if ($currentNet !== '0.000')
                    LKGTC/NET:
                    Current: {{ $currentNet }} ||&nbsp;
                    Previous: {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['lkgtc_net']['current'] ?? 0, 3) }} ||&nbsp;
                    To Date: {{ \App\Swep\Helpers\Helper::toNumber($toDateForm1['lkgtc_net']['current'] ?? 0, 3) }} ||&nbsp;
                @endif
                {{ $wr->form1->remarks ?? null}}
            </td>
        </tr>

{{--        <td class="text-right">--}}
{{--            {{ \App\Swep\Helpers\Helper::toNumber($form1['lkgtc_gross']['current']?? null,4) }}--}}
{{--        </td>--}}
{{--        <td class="text-right">--}}
{{--            {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm1['lkgtc_gross']['current'] ?? null,4) }}--}}
{{--        </td>--}}
{{--        <td class="text-right">--}}
{{--            {{ \App\Swep\Helpers\Helper::toNumber($toDateForm1['lkgtc_gross']['current'] ?? null,4) }}--}}
{{--        </td>--}}

    </table>
    <table class="sign-table cols-3">
        <tr>
            <td>Certified:</td>
            <td>Verified:</td>
            <td>Verified:</td>
        </tr>

        <tr >
            <td>
                <u>{{$signatories['form1']['sign1']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form1']['sign2']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form1']['sign3']['name'] ?? null}}</u>
            </td>
        </tr>
        <tr >
            <td>
                {{$signatories['form1']['sign1']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form1']['sign2']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form1']['sign3']['position'] ?? null}}
            </td>
        </tr>
    </table>

</div>