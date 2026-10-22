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
                        <td class="text-strong">{{ $cropYear }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Report No:</td>
                        <td class="text-strong">{{ $reportNo }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Week Ending:</td>
                        <td class="text-strong">
                            {{ $weekEnding ? \Illuminate\Support\Carbon::parse($weekEnding)->format('F d, Y') : '-' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <p class="text-strong">RAW  & REFINED MOLASSES PRODUCTION and  STOCK BALANCES (M.T.)</p>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="3" class="text-center">#</th>
            <th rowspan="3" class="text-center">MILLS</th>
            <th rowspan="3">Start of Milling</th>
            <th rowspan="3">End of Milling</th>
            <th rowspan="3" class="text-center">Previous Crop/s Carry-over</th>
            <th rowspan="2" colspan="3" class="text-center">PRODUCTION</th>
            <th colspan="4" class="text-center">WITHDRAWALS</th>
            <th colspan="3" class="text-center">STOCK BALANCES</th>
            <th rowspan="3" class="text-center">MOLASSES DISTRIBUTION FACTOR</th>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Current Crop</th>
            <th colspan="2" class="text-center">Previous Crop</th>
            <th rowspan="2" class="text-center">CURRENT</th>
            <th rowspan="2" class="text-center">PREVIOUS</th>
            <th rowspan="2" class="text-center">TOTAL STOCKS</th>
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

                // [path inside form3, sanitizer method name]
                $columns = [
                    0 => ['totalProduction.prevCrop.toDate',      'sanitize'],
                    1 => ['totalProduction.currentCrop.thisWeek', 'sanitize'],
                    2 => ['totalProduction.currentCrop.prevWeek', 'sanitize'],
                    3 => ['totalProduction.currentCrop.toDate',   'sanitize'],
                    4 => ['totalOverallWith.currentCrop.thisWeek','sanitize'],
                    5 => ['totalOverallWith.currentCrop.toDate',  'sanitize'],
                    6 => ['totalOverallWith.prevCrop.thisWeek',   'sanitize'],
                    7 => ['totalOverallWith.prevCrop.toDate',     'sanitize'],
                ];

                $num = function ($form3, $path, $method) {
                    $value = (string) data_get($form3, $path, '0');
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
                    <td colspan="{{ 3 + count($template) }}"></td>
                </tr>

                @foreach($mills as $mill_code => $mill)
                    @php
                        $ct++;
                        $form3 = $mill['form3'] ?? [];
                        $hasData = !empty($form3);
                        $cells = [];
                        $distFactor = null;

                        if ($hasData) {
                            foreach ($columns as $i => $col) {
                                $cells[$i] = $num($form3, $col[0], $col[1]);
                            }

                            // Col 8: current crop = production - withdrawals (to date)
                            $cells[8] = $num($form3, 'totalProduction.currentCrop.toDate', 'sanitize')
                                      - $num($form3, 'totalOverallWith.currentCrop.toDate', 'sanitize');

                            // Col 9: previous crop = production - withdrawals (to date)
                            $cells[9] = $num($form3, 'totalProduction.prevCrop.toDate', 'sanitize')
                                      - $num($form3, 'totalOverallWith.prevCrop.toDate', 'sanitize');

                            // Col 10: current + previous crop
                            $cells[10] = $cells[8] + $cells[9];

                            foreach ($cells as $i => $val) {
                                $totals[$group][$i] += $val;
                            }

                            $distFactor = data_get($form3, 'distFactor.currentCrop.thisWeek');
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
                        <td class="text-right">
                            {{ ($distFactor !== null && $distFactor !== '' && $distFactor != 0) ? $distFactor : '-' }}
                        </td>
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
                    <td></td>
                </tr>
            @endforeach

            <tr class="text-strong">
                <td colspan="2">TOTAL (LKG)</td>
                <td></td>
                <td></td>
                @foreach($template as $key => $val)
                    <td class="text-right">{{ $dash(array_sum(array_column($totals, $key))) }}</td>
                @endforeach
                <td></td>
            </tr>
        @endif
        </tbody>
    </table>

@endsection