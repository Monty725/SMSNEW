<div id="form4a" style="break-after: page">
    @include('sms.printables.forms.header',['formName' => 'SMS Form No. 4A'])

    <h4 class="no-margin"><b>MILLSITE AND SUBSIDIARY WAREHOUSE INVENTORY REPORT - REFINED</b></h4>
    <p class="no-margin"><i>(Figures in Lkg-bags)</i></p>

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
            <td colspan="7" class="text-strong text-left" style="font-size:13px">1. REFINERY WAREHOUSE</td>
        </tr>
        <tr>
            <td colspan="7" style="border-top:1px solid #ccc; padding:0;"></td>
        </tr>
        <tr>
            <td style="text-indent: 10px">1.1 Carry-Over</td>
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['carryOver']['current'] ?? 0,4)}}</td>--}}
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['carryOver']['current'] ?? 0,4)}}</td>--}}
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['carryOver']['current'] ?? 0,4)}}</td>--}}
            <td></td>
            <td></td>
            <td></td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['carryOver']['prev'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['carryOver']['prev'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['carryOver']['prev'] ?? 0,4)}}</td>
        </tr>
        <tr>
            <td style="text-indent: 10px">1.2 Net Production</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['receipts']['current'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['receipts']['current'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['receipts']['current'] ?? 0,4)}}</td>
            <td></td>
            <td></td>
            <td></td>
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['receipts']['prev'] ?? 0,4)}}</td>--}}
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['receipts']['prev'] ?? 0,4)}}</td>--}}
{{--            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['receipts']['prev'] ?? 0,4)}}</td>--}}
        </tr>
        <tr>
            <td style="text-indent: 10px">1.3 Withdrawals</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['withdrawals']['current'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['withdrawals']['current'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['withdrawals']['current'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['withdrawals']['prev'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['withdrawals']['prev'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['withdrawals']['prev'] ?? 0,4)}}</td>
        </tr>
        <tr>
            <td style="text-indent: 10px">1.4 Transfers to Subsidiary</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['transferToRefinery']['current'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['transferToRefinery']['current'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['transferToRefinery']['current'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['transferToRefinery']['prev'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['transferToRefinery']['prev'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['transferToRefinery']['prev'] ?? 0,4)}}</td>
        </tr>
        <tr>
            <td style="text-indent: 10px">1.5 Return to Millsite (from Subsidiary Warehouse)</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['transferFromSubsidiary']['current'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['transferFromSubsidiary']['current'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['transferFromSubsidiary']['current'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form4a['transferFromSubsidiary']['prev'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm4a['transferFromSubsidiary']['prev'] ?? 0,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm4a['transferFromSubsidiary']['prev'] ?? 0,4)}}</td>
        </tr>
        @php
            // CURRENT WEEK
            $stock_current4a =
                + ($form4a['receipts']['current'] ?? 0)
                + ($form4a['transferFromSubsidiary']['current'] ?? 0)
                - ($form4a['withdrawals']['current'] ?? 0)
                - ($form4a['transferToRefinery']['current'] ?? 0);

            $stock_prevToDate_current4a =
                + ($prevToDateForm4a['receipts']['current'] ?? 0)
                + ($prevToDateForm4a['transferFromSubsidiary']['current'] ?? 0)
                - ($prevToDateForm4a['withdrawals']['current'] ?? 0)
                - ($prevToDateForm4a['transferToRefinery']['current'] ?? 0);

            $stock_toDate_current4a =
                + ($toDateForm4a['receipts']['current'] ?? 0)
                + ($toDateForm4a['transferFromSubsidiary']['current'] ?? 0)
                - ($toDateForm4a['withdrawals']['current'] ?? 0)
                - ($toDateForm4a['transferToRefinery']['current'] ?? 0);


            // PREVIOUS YEAR
            $stock_prev4a =
                ($form4a['carryOver']['prev'] ?? 0)
                + ($form4a['transferFromSubsidiary']['prev'] ?? 0)
                - ($form4a['withdrawals']['prev'] ?? 0)
                - ($form4a['transferToRefinery']['prev'] ?? 0);

            $stock_prevToDate_prev4a =
                ($prevToDateForm4a['carryOver']['prev'] ?? 0)
                + ($prevToDateForm4a['transferFromSubsidiary']['prev'] ?? 0)
                - ($prevToDateForm4a['withdrawals']['prev'] ?? 0)
                - ($prevToDateForm4a['transferToRefinery']['prev'] ?? 0);

            $stock_toDate_prev4a =
                ($toDateForm4a['carryOver']['prev'] ?? 0)
                + ($toDateForm4a['transferFromSubsidiary']['prev'] ?? 0)
                - ($toDateForm4a['withdrawals']['prev'] ?? 0)
                - ($toDateForm4a['transferToRefinery']['prev'] ?? 0);
        @endphp
        <tr>
            <td style="text-indent: 10px">1.6 Stock Balance</td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($stock_current4a,4) }}
            </td>

            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($stock_prevToDate_current4a,4) }}
            </td>

            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($stock_toDate_current4a,4) }}
            </td>

            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($stock_prev4a,4) }}
            </td>

            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($stock_prevToDate_prev4a,4) }}
            </td>

            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($stock_toDate_prev4a,4) }}
            </td>
        </tr>
        <tr>
            <td colspan="7" class="text-strong text-left" style="font-size:13px">2. SUBSIDARY WAREHOUSE</td>
        </tr>
        <tr>
            <td colspan="7" style="border-top:1px solid #ccc; padding:0;"></td>
        </tr>
{{--        <tr>--}}
{{--            <td colspan="7"><br></td>--}}
{{--        </tr>--}}
        @php
            $allowedSubsidiaries = [
                'carryOver',
                'receipts',
                'withdrawals',
                'transferToMillsite',
                'stockBalances',
            ];

            $subsidiaryNumber = 0;

            // Initialize totals for every allowed subsidiary
            // so keys such as stockBalances always exist.
            $total = [];

            foreach ($allowedSubsidiaries as $subsidiaryKey) {
                $total[$subsidiaryKey] = [
                    'current' => 0,
                    'prevCWeek' => 0,
                    'toCDate' => 0,
                    'prev' => 0,
                    'prevPWeek' => 0,
                    'toPDate' => 0,
                ];
            }
        @endphp

        @if(count($form4a['subsidiaries']) > 0)

            @foreach($form4a['subsidiaries'] as $key => $subs)

                @if(in_array($key, $allowedSubsidiaries))

                    @php
                        // Store only warehouses that have data
                        // in ANY of the six columns.
                        $validSubs = [];
                    @endphp

                    @if(count($subs) > 0)

                        {{-- FIRST PASS: determine which warehouses should be displayed --}}
                        @foreach($subs as $slug => $sub)

                            @if(!empty($sub['obj']) && $sub['obj']->for == 'REFINED')

                                @php
                                    $currentValue =
                                        $sub['current'] ?? 0;

                                    $prevCWeekValue =
                                        $prevToDateForm4a['subsidiaries'][$key][$slug]['current'] ?? 0;

                                    $toCDateValue =
                                        $toDateForm4a['subsidiaries'][$key][$slug]['current'] ?? 0;

                                    $prevValue =
                                        $sub['prev'] ?? 0;

                                    $prevPWeekValue =
                                        $prevToDateForm4a['subsidiaries'][$key][$slug]['prev'] ?? 0;

                                    $toPDateValue =
                                        $toDateForm4a['subsidiaries'][$key][$slug]['prev'] ?? 0;

                                    // Show the warehouse if ANY of the
                                    // six columns contains a value.
                                    $warehouseHasData =
                                        $currentValue != 0 ||
                                        $prevCWeekValue != 0 ||
                                        $toCDateValue != 0 ||
                                        $prevValue != 0 ||
                                        $prevPWeekValue != 0 ||
                                        $toPDateValue != 0;
                                @endphp

                                @if($warehouseHasData)

                                    @php
                                        $validSubs[$slug] = [
                                            'sub' => $sub,
                                            'current' => $currentValue,
                                            'prevCWeek' => $prevCWeekValue,
                                            'toCDate' => $toCDateValue,
                                            'prev' => $prevValue,
                                            'prevPWeek' => $prevPWeekValue,
                                            'toPDate' => $toPDateValue,
                                        ];

                                        // Add ONLY displayed warehouses to totals.
                                        $total[$key]['current'] += $currentValue;
                                        $total[$key]['prevCWeek'] += $prevCWeekValue;
                                        $total[$key]['toCDate'] += $toCDateValue;
                                        $total[$key]['prev'] += $prevValue;
                                        $total[$key]['prevPWeek'] += $prevPWeekValue;
                                        $total[$key]['toPDate'] += $toPDateValue;
                                    @endphp

                                @endif

                            @endif

                        @endforeach

                        {{-- SECOND PASS: display only if there are valid warehouses --}}
                        @if(count($validSubs) > 0)

                            @php
                                $subsidiaryNumber++;
                            @endphp

                            <tr>
                                <td colspan="7" class="text-strong">
                                    2.{{ $subsidiaryNumber }}
                                    {{ \App\Swep\Helpers\Arrays::subsidiaryItems()[$key] }}
                                </td>
                            </tr>

                            {{-- Display valid warehouses --}}
                            @foreach($validSubs as $slug => $warehouse)

                                @php
                                    $sub = $warehouse['sub'];
                                @endphp

                                <tr>
                                    <td>
                                        <span class="indent"></span>
                                        {{ $sub['obj']->name ?? null }}
                                        ({{ $sub['obj']->alias ?? null }})
                                    </td>

                                    <td class="text-right">
                                        {{ \App\Swep\Helpers\Helper::toNumber($warehouse['current'],4) }}
                                    </td>

                                    <td class="text-right">
                                        {{ \App\Swep\Helpers\Helper::toNumber($warehouse['prevCWeek'],4) }}
                                    </td>

                                    <td class="text-right">
                                        {{ \App\Swep\Helpers\Helper::toNumber($warehouse['toCDate'],4) }}
                                    </td>

                                    <td class="text-right">
                                        {{ \App\Swep\Helpers\Helper::toNumber($warehouse['prev'],4) }}
                                    </td>

                                    <td class="text-right">
                                        {{ \App\Swep\Helpers\Helper::toNumber($warehouse['prevPWeek'],4) }}
                                    </td>

                                    <td class="text-right">
                                        {{ \App\Swep\Helpers\Helper::toNumber($warehouse['toPDate'],4) }}
                                    </td>
                                </tr>

                            @endforeach

                            {{-- TOTAL --}}
                            <tr>
                                <td class="text-right text-strong">TOTAL</td>

                                <td class="text-right text-strong">
                                    {{ \App\Swep\Helpers\Helper::toNumber($total[$key]['current'],4) }}
                                </td>

                                <td class="text-right text-strong">
                                    {{ \App\Swep\Helpers\Helper::toNumber($total[$key]['prevCWeek'],4) }}
                                </td>

                                <td class="text-right text-strong">
                                    {{ \App\Swep\Helpers\Helper::toNumber($total[$key]['toCDate'],4) }}
                                </td>

                                <td class="text-right text-strong">
                                    {{ \App\Swep\Helpers\Helper::toNumber($total[$key]['prev'],4) }}
                                </td>

                                <td class="text-right text-strong">
                                    {{ \App\Swep\Helpers\Helper::toNumber($total[$key]['prevPWeek'],4) }}
                                </td>

                                <td class="text-right text-strong">
                                    {{ \App\Swep\Helpers\Helper::toNumber($total[$key]['toPDate'],4) }}
                                </td>
                            </tr>

                        @endif

                    @endif

                @endif

            @endforeach

        @endif

        </tbody>

        <tr style="font-weight:600; height:50px;">
            <td style="width:400px;">
                <span style="font-weight:700;">3. TOTAL STOCKS</span> (Millsite & Subsidiary Warehouses)
            </td>

            {{--    <td class="text-right">
                    {{ \App\Swep\Helpers\Helper::toNumber(
                        $total['stockBalances']['current'] + $stock_current4a
                    ) }}
                </td>

                <td class="text-right">
                    {{ \App\Swep\Helpers\Helper::toNumber(
                        $total['stockBalances']['prevCWeek'] + $stock_prevToDate_current4a
                    ) }}
                </td>
            --}}

            <td colspan="3" class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber(
                    $total['stockBalances']['toCDate']
                    + $stock_toDate_current4a
                ) }}
            </td>

            {{--    <td class="text-right">
                    {{ \App\Swep\Helpers\Helper::toNumber(
                        $total['stockBalances']['prev'] + $stock_prev4a
                    ) }}
                </td>

                <td class="text-right">
                    {{ \App\Swep\Helpers\Helper::toNumber(
                        $total['stockBalances']['prevPWeek'] + $stock_prevToDate_prev4a
                    ) }}
                </td>
            --}}

            <td colspan="3" class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber(
                    $total['stockBalances']['toPDate']
                    + $stock_toDate_prev4a
                ) }}
            </td>
        </tr>

        <tr style="font-weight:600; height:50px;">
            <td style="width:400px;">
                <span style="font-weight:700;">4. TOTAL STOCKS</span> (Current & Previous Crops)
            </td>

            <td colspan="6" class="text-right" style="font-size: 18px;">
                {{ \App\Swep\Helpers\Helper::toNumber(
                    $total['stockBalances']['toCDate']
                    + $stock_toDate_current4a
                    + $total['stockBalances']['toPDate']
                    + $stock_toDate_prev4a
                ) }}
            </td>
        </tr>
        <tr>
            <td>Remarks: </td>
            <td colspan="9">
                {{ $wr->form4a->remarks ?? null}}
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
                <u>{{$signatories['form4a']['sign1']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form4a']['sign2']['name'] ?? null}}</u>
            </td>

        </tr>
        <tr >
            <td>
                {{$signatories['form4a']['sign1']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form4a']['sign2']['position'] ?? null}}
            </td>
        </tr>
    </table>
</div>