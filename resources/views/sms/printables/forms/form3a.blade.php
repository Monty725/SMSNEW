<div id="form3a" style="break-after: page">
    @include('sms.printables.forms.header',['formName' => 'SMS Form No. 3A'])

    <h4 class="no-margin"><b>MILLSITE AND SUBSIDIARY WAREHOUSE INVENTORY REPORT - MOLASSES</b></h4>
    <p class="no-margin"><i>(Figures in Metric Tons)</i></p>

    <table class="table-bordered " style="width: 100%">
        <thead>
        <tr >
            <th rowspan="2"></th>
            <th colspan="3" class="text-center">CURRENT CROP</th>
            <th colspan="3" class="text-center">PREVIOUS CROP</th>
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
            <td colspan="7" class="text-strong text-left" style="font-size:13px">1. MOLASSES (Mill Site)</td>
        </tr>
        <tr>
            <td colspan="7" style="border-top:1px solid #ccc; padding:0;"></td>
        </tr>
        <tr>
            <td style="text-indent: 10px">1.1 Carry-Over</td>
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['carryOver']['current'] ?? null,4)}}</td>--}}
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['carryOver']['current'] ?? null,4)}}</td>--}}
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['carryOver']['current'] ?? null,4)}}</td>--}}
            <td></td>
            <td></td>
            <td></td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['carryOver']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['carryOver']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['carryOver']['prev'] ?? null,4)}}</td>
        </tr>
        <tr>
            <td style="text-indent: 10px">1.2 Net Production</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['netProd']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['netProd']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['netProd']['current'] ?? null,4)}}</td>
            <td></td>
            <td></td>
            <td></td>
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['netProd']['prev'] ?? null,4)}}</td>--}}
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['netProd']['prev'] ?? null,4)}}</td>--}}
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['netProd']['prev'] ?? null,4)}}</td>--}}
        </tr>
        <tr>
            <td style="text-indent: 10px">1.3 Retention, Adjustment, Overages,etc.</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['rao']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['rao']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['rao']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['rao']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['rao']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['rao']['prev'] ?? null,4)}}</td>
        </tr>
        <tr>
            <td style="text-indent: 10px">1.4 Receipts</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['receipts']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['receipts']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['receipts']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['receipts']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['receipts']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['receipts']['prev'] ?? null,4)}}</td>
        </tr>
        <tr>
            <td style="text-indent: 10px">1.5 Withdrawals</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['withdrawals']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['withdrawals']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['withdrawals']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['withdrawals']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['withdrawals']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['withdrawals']['prev'] ?? null,4)}}</td>
        </tr>
        <tr>
            <td style="text-indent: 10px">1.6 Transfers to Subsidiary</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['transferToRefinery']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['transferToRefinery']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['transferToRefinery']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['transferToRefinery']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['transferToRefinery']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['transferToRefinery']['prev'] ?? null,4)}}</td>
        </tr>
        <tr>
            <td style="text-indent: 10px">1.7 Return to Millsite (from Subsidiary Warehouse)</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['transferFromSubsidiary']['current'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['transferFromSubsidiary']['current'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['transferFromSubsidiary']['current'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['transferFromSubsidiary']['prev'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['transferFromSubsidiary']['prev'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['transferFromSubsidiary']['prev'] ?? 0,4)}}</td>
        </tr>
        @php
            // CURRENT WEEK
            $stock_current3a =
                + ($form3a['netProd']['current'] ?? 0)
                + ($form3a['rao']['current'] ?? 0)
                + ($form3a['receipts']['current'] ?? 0)
                + ($form3a['transferFromSubsidiary']['current'] ?? 0)
                - ($form3a['withdrawals']['current'] ?? 0)
                - ($form3a['transferToRefinery']['current'] ?? 0);

            $stock_prevToDate_current3a =
                + ($prevToDateForm3a['netProd']['current'] ?? 0)
                + ($prevToDateForm3a['rao']['current'] ?? 0)
                + ($prevToDateForm3a['receipts']['current'] ?? 0)
                + ($prevToDateForm3a['transferFromSubsidiary']['current'] ?? 0)
                - ($prevToDateForm3a['withdrawals']['current'] ?? 0)
                - ($prevToDateForm3a['transferToRefinery']['current'] ?? 0);

            $stock_toDate_current3a =
                + ($toDateForm3a['netProd']['current'] ?? 0)
                + ($toDateForm3a['rao']['current'] ?? 0)
                + ($toDateForm3a['receipts']['current'] ?? 0)
                + ($toDateForm3a['transferFromSubsidiary']['current'] ?? 0)
                - ($toDateForm3a['withdrawals']['current'] ?? 0)
                - ($toDateForm3a['transferToRefinery']['current'] ?? 0);


            // PREVIOUS YEAR
            $stock_prev3a =
                ($form3a['carryOver']['prev'] ?? 0)
                + ($form3a['rao']['prev'] ?? 0)
                + ($form3a['receipts']['prev'] ?? 0)
                + ($form3a['transferFromSubsidiary']['prev'] ?? 0)
                - ($form3a['withdrawals']['prev'] ?? 0)
                - ($form3a['transferToRefinery']['prev'] ?? 0);

            $stock_prevToDate_prev3a =
                ($prevToDateForm3a['carryOver']['prev'] ?? 0)
                + ($prevToDateForm3a['rao']['prev'] ?? 0)
                + ($prevToDateForm3a['receipts']['prev'] ?? 0)
                + ($prevToDateForm3a['transferFromSubsidiary']['prev'] ?? 0)
                - ($prevToDateForm3a['withdrawals']['prev'] ?? 0)
                - ($prevToDateForm3a['transferToRefinery']['prev'] ?? 0);

            $stock_toDate_prev3a =
                ($toDateForm3a['carryOver']['prev'] ?? 0)
                + ($toDateForm3a['rao']['prev'] ?? 0)
                + ($toDateForm3a['receipts']['prev'] ?? 0)
                + ($toDateForm3a['transferFromSubsidiary']['prev'] ?? 0)
                - ($toDateForm3a['withdrawals']['prev'] ?? 0)
                - ($toDateForm3a['transferToRefinery']['prev'] ?? 0);
        @endphp
        <tr>
            <td style="text-indent: 10px">1.7 Stock Balance</td>
            <td class="text-right">{{ \App\Swep\Helpers\Helper::toNumber($stock_current3a,4) }}</td>
            <td class="text-right">{{ \App\Swep\Helpers\Helper::toNumber($stock_prevToDate_current3a,4) }}</td>
            <td class="text-right">{{ \App\Swep\Helpers\Helper::toNumber($stock_toDate_current3a,4) }}</td>
            <td class="text-right">{{ \App\Swep\Helpers\Helper::toNumber($stock_prev3a,4) }}</td>
            <td class="text-right">{{ \App\Swep\Helpers\Helper::toNumber($stock_prevToDate_prev3a,4) }}</td>
            <td class="text-right">{{ \App\Swep\Helpers\Helper::toNumber($stock_toDate_prev3a,4) }}</td>
        </tr>
        <tr>
            <td colspan="7" class="text-strong text-left" style="font-size:13px">2. SUBSIDIARY TANKS</td>
        </tr>
        <tr>
            <td colspan="7" style="border-top:1px solid #ccc; padding:0;"></td>
        </tr>
        @if(count($form3a['subsidiaries']) > 0)
            @php($total = [])
            @foreach($form3a['subsidiaries'] as $key => $subs)
                <tr>
                    <td colspan="7" class="text-strong">2.{{$loop->iteration}} {{\App\Swep\Helpers\Arrays::subsidiaryItems()[$key]}}</td>
                </tr>
                @php($total[$key]['current'] = 0)
                @php($total[$key]['prevCWeek'] = 0)
                @php($total[$key]['toCDate'] = 0)
                @php($total[$key]['prev'] = 0)
                @php($total[$key]['prevPWeek'] = 0)
                @php($total[$key]['toPDate'] = 0)
                @if(count($subs) > 0)
                    @foreach($subs as $slug => $sub)
                        @if(!empty($sub['obj']))
                            @if($sub['obj']->for == 'MOLASSES' )
                                @php($total[$key]['current'] = $total[$key]['current'] + ($sub['current'] ?? 0))
                                @php($total[$key]['prevCWeek'] += ($prevToDateForm3a['subsidiaries'][$key][$slug]['current'] ?? 0))
                                @php($total[$key]['toCDate'] += ($toDateForm3a['subsidiaries'][$key][$slug]['current'] ?? 0))
                                @php($total[$key]['prev'] = $total[$key]['prev'] + ($sub['prev'] ?? 0))
                                @php($total[$key]['prevPWeek'] += ($prevToDateForm3a['subsidiaries'][$key][$slug]['prev'] ?? 0))
                                @php($total[$key]['toPDate'] += ($toDateForm3a['subsidiaries'][$key][$slug]['prev'] ?? 0))
                                <tr>
                                    {{--                                    UPDATE OF PREV WEEK AND TO DATE--}}
                                    <td><span class="indent"></span> {{ $sub['obj']->name ?? null }} ({{ $sub['obj']->alias ?? null }})</td>
                                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($sub['current'] ?? null,4)}}</td>
                                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['subsidiaries'][$key][$slug]['current'] ?? 0,4)}}</td>
                                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['subsidiaries'][$key][$slug]['current'] ?? 0,4)}}</td>
                                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($sub['prev'] ?? null,4)}}</td>
                                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['subsidiaries'][$key][$slug]['prev'] ?? 0,4)}}</td>
                                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['subsidiaries'][$key][$slug]['prev'] ?? 0,4)}}</td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                    <tr>
                        <td class="text-right text-strong">TOTAL</td>
                        <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($total[$key]['current'],4)}}</td>
                        <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($total[$key]['prevCWeek'],4)}}</td>
                        <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($total[$key]['toCDate'],4)}}</td>
                        <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($total[$key]['prev'],4)}}</td>
                        <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($total[$key]['prevPWeek'],4)}}</td>
                        <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($total[$key]['toPDate'],4)}}</td>
                    </tr>
                @endif
            @endforeach
        @endif
        </tbody>
        <tr style="font-weight:600; height:50px;">
            <td style="width:400px;">
                <span style="font-weight:700;">3. TOTAL STOCKS</span> (Millsite & Subsidiary Warehouses)
            </td>

{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($total['stockBalances']['current'] + $stock_current3a)}}</td>--}}
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($total['stockBalances']['prevCWeek'] + $stock_prevToDate_current3a)}}</td>--}}
            <td colspan="3" class="text-right">{{\App\Swep\Helpers\Helper::toNumber($total['stockBalances']['toCDate'] + $stock_toDate_current3a)}}</td>
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($total['stockBalances']['prev'] + $stock_prev3a)}}</td>--}}
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($total['stockBalances']['prevPWeek'] + $stock_prevToDate_prev3a)}}</td>--}}
            <td colspan="3" class="text-right">{{\App\Swep\Helpers\Helper::toNumber($total['stockBalances']['toPDate'] + $stock_toDate_prev3a)}}</td>
        </tr>
        <tr style="font-weight:600; height:50px;">
            <td style="width:400px;">
                <span style="font-weight:700;">4. TOTAL STOCKS</span> (Current & Previous Crops)
            </td>

            <td colspan="6" class="text-right" style="font-size: 18px;">
                {{ \App\Swep\Helpers\Helper::toNumber(
                    $total['stockBalances']['toCDate']
                    + $stock_toDate_current3a
                    + $total['stockBalances']['toPDate']
                    + $stock_toDate_prev3a
                ) }}
            </td>
        </tr>
    </table>
    <table class="sign-table cols-3">
        <tr>
            <td>Certified:</td>
            <td>Verified:</td>
        </tr>

        <tr >
            <td>
                <u>{{$signatories['form3a']['sign1']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form3a']['sign2']['name'] ?? null}}</u>
            </td>

        </tr>
        <tr >
            <td>
                {{$signatories['form3a']['sign1']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form3a']['sign2']['position'] ?? null}}
            </td>
        </tr>
    </table>
</div>