@extends('printables.print_layouts.print_layout_main')


@section('wrapper')
    <table class="" style="width: 100%;">
        <tr>
            <td style="width: 30%" class="text-top">
                {{-- <p class="no-margin text-strong">THE ADMINISTRATOR</p>--}}
                {{-- <p class="no-margin">SUGAR REGULATORY ADMINISTRATION</p>--}}
                {{-- <p class="no-margin">SRA, DILIMAN, QUEZON CITY</p>--}}
                <table class="tbl-condensed" style="width: 100%">
                    <tbody>
                    <tr>
                        <td style="width: 40%">Crop year:</td>
                        <td class="text-strong">{{ \Illuminate\Support\Facades\Request::get('crop_year') }}</td>
                    </tr>
                    <tr>
                        <td>Report No:</td>
                        <td class="text-strong">{{ \Illuminate\Support\Facades\Request::get('report_no') }}</td>
                    </tr>
                    <tr>
                        <td>Week Ending:</td>
                        <td>
                            <b>{{ $weekEnding ? \Illuminate\Support\Carbon::parse($weekEnding)->format('F d, Y') : '-' }}</b>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
            <td class="text-center text-top">
                <p class="text-strong">SUGAR REGULATORY ADMINISTRATION</p>
                <p class="text-strong">REGULATION DEPARTMENT</p>
            </td>
            <td style="width: 30%" class="text-top">
            </td>
        </tr>
    </table>

    <p class="text-strong">RAW SUGAR PRODUCTION, WITHDRAWALS & STOCK BALANCES IN (In LKG Bags)</p>
{{--    <p class="text-strong">RAW SUGAR PRODUCTION, WITHDRAWALS & STOCK BALANCES (In Metric Tons)</p>--}}


    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2" class="text-center">#</th>
            <th rowspan="2" class="text-center">MILLS</th>
            <th rowspan="2" class="text-center">Previous Crop/s Carry-over</th>
            <th colspan="3" class="text-center">PRODUCTION</th>
            <th colspan="2" class="text-center">TO DATE WITHDRAWALS</th>
            <th colspan="2" class="text-center">STOCK BALANCES</th>
            <th colspan="2" class="text-center">TRANSFERS TO REFINERY</th>
            <th rowspan="2" class="text-center">TOTAL STOCKS</th>
        </tr>
        <tr>
            <th class="text-center">This Week</th>
            <th class="text-center">Previous</th>
            <th class="text-center">To Date</th>
            <th class="text-center">Current Crop</th>
            <th class="text-center">Previous Crop</th>
            <th class="text-center">Current Crop</th>
            <th class="text-center">Previous Crop</th>
            <th class="text-center">Current Crop</th>
            <th class="text-center">Previous Crop</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($comparativeArray))
            @php
                $ct = 0;
                $totals = [];
                $template = array_fill(0, 11, 0);

                // [path inside form1, sanitizer method name]
                $columns = [
                    0 => ['manufactured.prevCrop.toDate',        'sanitizeAutonum'],
                    1 => ['manufactured.currentCrop.thisWeek',   'sanitizeAutonum'],
                    2 => ['manufactured.currentCrop.prevWeek',   'sanitizeAutonum'],
                    3 => ['manufactured.currentCrop.toDate',     'sanitizeAutonum'],
                    4 => ['totalAllWithdraw.currentCrop.toDate', 'sanitizeAutonum'],
                    5 => ['totalAllWithdraw.prevCrop.toDate',    'sanitizeAutonum'],
                    6 => ['stockBal.currentCrop.toDate',         'sanitize'],
                    7 => ['stockBal.prevCrop.toDate',            'sanitize'],
                    8 => ['transfersToRef.currentCrop.toDate',   'sanitize'],
                    9 => ['transfersToRef.prevCrop.toDate',      'sanitize'],
                ];

                $num = function ($form1, $path, $method) {
                    $value = (string) data_get($form1, $path, '0');
                    return $method === 'sanitize'
                        ? \App\Swep\Helpers\Helper::sanitize($value)
                        : \App\Swep\Helpers\Helper::sanitizeAutonum($value);
                };
                $dash = function ($value, $multiplier = 1) {
                    if ($value === null || $value === '' || !is_numeric($value)) {
                        return '-';
                    }
                    $value = round($value * $multiplier, 3);
                    return $value == 0
                        ? '-'
                        : \App\Swep\Helpers\Helper::toNumber($value, 3, '-');
                };
            @endphp

            @foreach($comparativeArray as $group => $mills)
                @php $totals[$group] = $template; @endphp

                {{-- Group header --}}
                <tr class="text-strong">
                    <td></td>
                    <td style="background-color: #e9e9e9; text-align: center">{{ $group }}</td>
                    <td colspan="{{ count($template) }}"></td>
                </tr>

                @foreach($mills as $mill_code => $mill)
                    @php
                        $ct++;
                        $form1 = $mill['form1'] ?? [];
                        $hasData = !empty($form1);
                        $cells = [];

                        if ($hasData) {
                            foreach ($columns as $i => [$path, $method]) {
                                $cells[$i] = $num($form1, $path, $method);
                            }
                            // Col 10: (prev manufactured - prev withdrawals - prev transfers)
                            //       + (current manufactured - current withdrawals - current transfers)
                            $cells[10] =
                                ($num($form1,'manufactured.prevCrop.toDate','sanitizeAutonum')
                                    - $num($form1,'totalAllWithdraw.prevCrop.toDate','sanitizeAutonum')
                                    - $num($form1,'transfersToRef.prevCrop.toDate','sanitize'))
                                + ($num($form1,'manufactured.currentCrop.toDate','sanitizeAutonum')
                                    - $num($form1,'totalAllWithdraw.currentCrop.toDate','sanitizeAutonum')
                                    - $num($form1,'transfersToRef.currentCrop.toDate','sanitize'));

                            foreach ($cells as $i => $val) {
                                $totals[$group][$i] += $val;
                            }
                        }
                    @endphp

                    <tr>
                        <td>{{ $ct }}</td>
                        <td>{{ $mill_code }}</td>
                        @for($i = 0; $i < 11; $i++)
                            <td class="text-right">
                                {{ $hasData ? $dash($cells[$i]) : '-' }}
                            </td>
                        @endfor
                    </tr>
                @endforeach

                {{-- Group subtotal --}}
                <tr class="text-strong" style="background-color: #f8ffeb">
                    <td colspan="2" class="text-right">Subtotal</td>
                    @foreach($totals[$group] as $value)
                        <td class="text-right">{{ $dash($value) }}</td>
                    @endforeach
                </tr>
            @endforeach

            <tr class="text-strong">
                <td colspan="2">TOTAL (MT)</td>
                @foreach($template as $key => $val)
                    <td class="text-right">{{ $dash(array_sum(array_column($totals, $key))) }}</td>
                @endforeach
            </tr>
            <tr class="text-strong">
                <td colspan="2">TOTAL (LKG)</td>
                @foreach($template as $key => $val)
                    <td class="text-right">{{ $dash(array_sum(array_column($totals, $key)), 20) }}</td>
                @endforeach
            </tr>
        @endif
        </tbody>
    </table>
@endsection