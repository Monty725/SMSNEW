@extends('printables.print_layouts.print_layout_main')


@section('wrapper')
    <table class="" style="width: 100%;">
        <tr>
            <td style="width: 30%">
                <p class="no-margin text-strong">THE ADMINISTRATOR</p>
                <p class="no-margin">SUGAR REGULATORY ADMINISTRATION</p>
                <p class="no-margin">SRA, DILIMAN, QUEZON CITY</p>
            </td>
            <td class="text-center">
                <p class="text-strong">SUGAR REGULATORY ADMINISTRATION</p>
                <p class="text-strong"> REGULATION DEPARTMENT</p>
            </td>
            <td style="width: 30%" class="text-top">
            <table class="tbl-condensed" style="width: 100%">
                <tbody>
                <tr>
                    <td style="width: 50%"></td>
                    <td>Crop year:</td>
                    <td class="text-strong">{{\Illuminate\Support\Facades\Request::get('crop_year')}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Report No:</td>
                    <td class="text-strong">{{\Illuminate\Support\Facades\Request::get('report_no')}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Week Ending:</td>
                    <td>
                        <b>{{ $weekEnding ? \Illuminate\Support\Carbon::parse($weekEnding)->format('F d, Y') : '-' }}</b>
                    </td>
                </tr>
                </tbody>
            </table>
            </td>
        </tr>
    </table>

    <p class="text-strong">REFINED SUGAR PRODUCTION, WITHDRAWALS, and STOCK BALANCES ( In 50 KILO-BAG)</p>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="3" class="text-center">#</th>
            <th rowspan="3" class="text-center">REFINERIES</th>
            <th rowspan="3">Start of Refining</th>
            <th rowspan="3">End of Refining</th>
            <th rowspan="3" class="text-center">Previous Crop/s Carry-over</th>
            <th rowspan="2" colspan="3" class="text-center">CURRENT CROP PRODUCTION</th>
            <th colspan="4" class="text-center">WITHDRAWALS</th>
            <th colspan="3" class="text-center">STOCK BALANCES</th>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Current Crop</th>
            <th colspan="2" class="text-center">Previous Crop</th>
            <th rowspan="2" class="text-center">CURRENT</th>
            <th rowspan="2" class="text-center">PREVIOUS</th>
            <th rowspan="2" class="text-center">TOTAL</th>
        </tr>
        <tr>
            <th class="text-center">This Week</th>
            <th class="text-center">Previous</th>
            <th class="text-center">To Date</th>
            <th class="text-center">This Week</th>
            <th class="text-center">To-Date</th>
            <th class="text-center">This Week</th>
            <th class="text-center">To-Date</th>

        </tr>
        </thead>
        <tbody>
        @if(!empty($millsArray))
            @php
                $ct = 0;
                $totals = [];
                $template = array_fill(0, 11, 0);

                // [path inside form2, sanitizer method name]
                $columns = [
                    0 => ['prodNet.prevCrop.toDate',                    'sanitize'],
                    1 => ['prodNet.currentCrop.thisWeek',               'sanitize'],
                    2 => ['prodNet.currentCrop.prevWeek',               'sanitize'],
                    3 => ['prodNet.currentCrop.toDate',                 'sanitize'],
                    4 => ['totalWithdrawalOverall.currentCrop.thisWeek','sanitizeAutonum'],
                    5 => ['totalWithdrawalOverall.currentCrop.toDate',  'sanitizeAutonum'],
                    6 => ['totalWithdrawalOverall.prevCrop.thisWeek',   'sanitizeAutonum'],
                    7 => ['totalWithdrawalOverall.prevCrop.toDate',     'sanitizeAutonum'],
                    8 => ['stockBalance.currentCrop.toDate',            'sanitize'],
                    9 => ['stockBalance.prevCrop.toDate',               'sanitize'],
                ];

                $num = function ($form2, $path, $method) {
                    $value = (string) data_get($form2, $path, '0');
                    return $method === 'sanitize'
                        ? \App\Swep\Helpers\Helper::sanitize($value)
                        : \App\Swep\Helpers\Helper::sanitizeAutonum($value);
                };

                // '-' for null, empty, non-numeric, or anything that rounds to 0.000
                $dash = function ($value) {
                    if ($value === null || $value === '' || !is_numeric($value)) {
                        return '-';
                    }
                    $value = round($value, 3);
                    return $value == 0
                        ? '-'
                        : \App\Swep\Helpers\Helper::toNumber($value, 3, '-');
                };
            @endphp

            @foreach($millsArray as $group => $mills)
                @php $totals[$group] = $template; @endphp

                {{-- Group header --}}
                <tr class="text-strong">
                    <td></td>
                    <td style="background-color: #e9e9e9; text-align: center">{{ $group }}</td>
                    <td colspan="{{ 2 + count($template) }}"></td>
                </tr>

                @foreach($mills as $mill_code => $mill)
                    @php
                        $ct++;
                        $form2 = $mill['form2'] ?? [];
                        $hasData = !empty($form2);
                        $cells = [];

                        if ($hasData) {
                            foreach ($columns as $i => $col) {
                                $cells[$i] = $num($form2, $col[0], $col[1]);
                            }
                            // Col 10: stock balance (current crop) + stock balance (previous crop)
                            $cells[10] = $cells[8] + $cells[9];

                            foreach ($cells as $i => $val) {
                                $totals[$group][$i] += $val;
                            }
                        }
                    @endphp

                    <tr>
                        <td>{{ $ct }}</td>
                        <td>{{ $mill_code }}</td>
                        <td></td>
                        <td></td>
                        @for($i = 0; $i < 11; $i++)
                            <td class="text-right">
                                {{ $hasData ? $dash($cells[$i]) : '-' }}
                            </td>
                        @endfor
                    </tr>
                @endforeach

                {{-- Group subtotal --}}
                <tr class="text-strong">
                    <td colspan="2" class="text-right">Subtotal</td>
                    <td></td>
                    <td></td>
                    @foreach($totals[$group] as $value)
                        <td class="text-right text-strong">{{ $dash($value) }}</td>
                    @endforeach
                </tr>
            @endforeach

            <tr class="text-strong">
                <td colspan="2">TOTAL (LKG)</td>
                <td></td>
                <td></td>
                @foreach($template as $key => $val)
                    <td class="text-right">{{ $dash(array_sum(array_column($totals, $key))) }}</td>
                @endforeach
            </tr>
        @endif
        </tbody>
    </table>



    <div style="break-before: page">
        <p class="text-strong">RAW SUGAR RECEIPTS, MELTED, and STOCK BALANCES (In Lkg.)</p>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th rowspan="3" class="text-center">#</th>
                <th rowspan="3" class="text-center">REFINERIES</th>
                <th rowspan="3" class="text-center">Previous Crop/s Carry-over</th>
                <th colspan="3" class="text-center">RAW SUGAR RECEIPTS</th>
                <th colspan="4" class="text-center">MELTED</th>
                <th colspan="4" class="text-center">WITHDRAWALS</th>
                <th colspan="3" class="text-center">STOCK BALANCES</th>
            </tr>
            <tr>
                <th rowspan="3" class="text-center">This Week</th>
                <th rowspan="3" class="text-center">Previous</th>
                <th rowspan="3" class="text-center">To Date</th>
                <th colspan="2" class="text-center">CURRENT CROP</th>
                <th colspan="2" class="text-center">PREVIOUS CROP</th>
                <th colspan="2" class="text-center">CURRENT CROP</th>
                <th colspan="2" class="text-center">PREVIOUS CROP</th>
                <th rowspan="2" class="text-center">CURRENT CROP</th>
                <th rowspan="2" class="text-center">PREVIOUS CROP</th>
                <th rowspan="2" class="text-center">TOTAL</th>
            </tr>
            <tr>
                <th class="text-center">This Week</th>
                <th class="text-center">To-Date</th>
                <th class="text-center">This Week</th>
                <th class="text-center">To-Date</th>
                <th class="text-center">This Week</th>
                <th class="text-center">To-Date</th>
                <th class="text-center">This Week</th>
                <th class="text-center">To-Date</th>

            </tr>
            </thead>
            <tbody>
            @if(!empty($millsArray))
                @php
                    $ct = 0;
                    $totals = [];
                    $template = array_fill(0, 11, 0);

                    // [path inside form2, sanitizer method name]
                    $columns = [
                        0 => ['prodNet.prevCrop.toDate',                    'sanitize'],
                        1 => ['prodNet.currentCrop.thisWeek',               'sanitize'],
                        2 => ['prodNet.currentCrop.prevWeek',               'sanitize'],
                        3 => ['prodNet.currentCrop.toDate',                 'sanitize'],
                        4 => ['totalWithdrawalOverall.currentCrop.thisWeek','sanitizeAutonum'],
                        5 => ['totalWithdrawalOverall.currentCrop.toDate',  'sanitizeAutonum'],
                        6 => ['totalWithdrawalOverall.prevCrop.thisWeek',   'sanitizeAutonum'],
                        7 => ['totalWithdrawalOverall.prevCrop.toDate',     'sanitizeAutonum'],
                        8 => ['stockBalance.currentCrop.toDate',            'sanitize'],
                        9 => ['stockBalance.prevCrop.toDate',               'sanitize'],
                    ];

                    $num = function ($form2, $path, $method) {
                        $value = (string) data_get($form2, $path, '0');
                        return $method === 'sanitize'
                            ? \App\Swep\Helpers\Helper::sanitize($value)
                            : \App\Swep\Helpers\Helper::sanitizeAutonum($value);
                    };

                    // '-' for null, empty, non-numeric, or anything that rounds to 0.000
                    $dash = function ($value) {
                        if ($value === null || $value === '' || !is_numeric($value)) {
                            return '-';
                        }
                        $value = round($value, 3);
                        return $value == 0
                            ? '-'
                            : \App\Swep\Helpers\Helper::toNumber($value, 3, '-');
                    };
                @endphp

                @foreach($millsArray as $group => $mills)
                    @php $totals[$group] = $template; @endphp

                    {{-- Group header --}}
                    <tr class="text-strong">
                        <td></td>
                        <td style="background-color: #e9e9e9; text-align: center">{{ $group }}</td>
                        <td colspan="{{ 2 + count($template) }}"></td>
                    </tr>

                    @foreach($mills as $mill_code => $mill)
                        @php
                            $ct++;
                            $form2 = $mill['form2'] ?? [];
                            $hasData = !empty($form2);
                            $cells = [];

                            if ($hasData) {
                                foreach ($columns as $i => $col) {
                                    $cells[$i] = $num($form2, $col[0], $col[1]);
                                }
                                // Col 10: stock balance (current crop) + stock balance (previous crop)
                                $cells[10] = $cells[8] + $cells[9];

                                foreach ($cells as $i => $val) {
                                    $totals[$group][$i] += $val;
                                }
                            }
                        @endphp

                        <tr>
                            <td>{{ $ct }}</td>
                            <td>{{ $mill_code }}</td>
                            <td></td>
                            <td></td>
                            @for($i = 0; $i < 11; $i++)
                                <td class="text-right">
                                    {{ $hasData ? $dash($cells[$i]) : '-' }}
                                </td>
                            @endfor
                        </tr>
                    @endforeach

                    {{-- Group subtotal --}}
                    <tr class="text-strong">
                        <td colspan="2" class="text-right">Subtotal</td>
                        <td></td>
                        <td></td>
                        @foreach($totals[$group] as $value)
                            <td class="text-right text-strong">{{ $dash($value) }}</td>
                        @endforeach
                    </tr>
                @endforeach

                <tr class="text-strong">
                    <td colspan="2">TOTAL (LKG)</td>
                    <td></td>
                    <td></td>
                    @foreach($template as $key => $val)
                        <td class="text-right">{{ $dash(array_sum(array_column($totals, $key))) }}</td>
                    @endforeach
                </tr>
            @endif
            </tbody>
        </table>
    </div>

@endsection

{{--OLD CODE--}}
{{--<td class="text-right">--}}
{{--    @php--}}
{{--        $totals[$group][2] = $totals[$group][2] + ($mill['form2']['prevToDate']['totalProduction']['current'] ?? null);--}}
{{--    @endphp--}}
{{--    {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['prevToDate']['totalProduction']['current'] ?? null,3,'-')}}--}}
{{--</td>--}}