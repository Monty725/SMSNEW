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

    <p class="text-strong">GTCM, TSDC, LKG/TONNE CANE</p>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2" class="text-center">#</th>
            <th rowspan="2" class="text-center">MILLS</th>
            <th rowspan="2" class="text-center">Start of Milling</th>
            <th rowspan="2" class="text-center">Start of Milling</th>
            <th colspan="3" class="text-center">GROSS TONNES CANE MILLED</th>
            <th colspan="3" class="text-center">MANUFACTURED</th>
            <th colspan="2" class="text-center">LKG/TONNE CANE</th>
        </tr>
        <tr>
            <th class="text-center">THIS WEEK</th>
            <th class="text-center">PREVIOUS</th>
            <th class="text-center">TO DATE</th>
            <th class="text-center">THIS WEEK</th>
            <th class="text-center">PREVIOUS</th>
            <th class="text-center">TO DATE</th>
            <th class="text-center">TW</th>
            <th class="text-center">TD</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($millsArray))
            @php
                $ct = 0;
                $totals = [];
                $template = array_fill(0, 6, 0);

                // [path inside form1]  (all values come from number_format, so sanitizeAutonum is enough)
                $columns = [
                    0 => 'gtcm.currentCrop.thisWeek',
                    1 => 'gtcm.currentCrop.prevWeek',
                    2 => 'gtcm.currentCrop.toDate',
                    3 => 'manufactured.currentCrop.thisWeek',
                    4 => 'manufactured.currentCrop.prevWeek',
                    5 => 'manufactured.currentCrop.toDate',
                ];

                $num = function ($form1, $path) {
                    return \App\Swep\Helpers\Helper::sanitizeAutonum((string) data_get($form1, $path, '0'));
                };

                // '-' for null, empty, non-numeric, or anything that rounds to zero at the given decimals
                $dash = function ($value, $decimals = 4) {
                    if ($value === null || $value === '' || !is_numeric($value)) {
                        return '-';
                    }
                    $value = round($value, $decimals);
                    return $value == 0
                        ? '-'
                        : \App\Swep\Helpers\Helper::toNumber($value, $decimals, '-');
                };

                // LKG/TC = manufactured * 20 / gtcm, or null when gtcm is 0
                $ratio = function ($manufactured, $gtcm) {
                    return $gtcm != 0 ? ($manufactured * 20 / $gtcm) : null;
                };
            @endphp

            @foreach($millsArray as $group => $mills)
                @php $totals[$group] = $template; @endphp

                {{-- Group header --}}
                <tr class="text-strong">
                    <td></td>
                    <td style="background-color: #e9e9e9; text-align: center">{{ $group }}</td>
                    <td colspan="{{ 4 + count($template) }}"></td>
                </tr>

                @foreach($mills as $mill_code => $mill)
                    @php
                        $ct++;
                        $form1 = $mill['form1'] ?? [];
                        $hasData = !empty($form1);
                        $cells = [];
                        $lkgThisWeek = null;
                        $lkgToDate = null;

                        if ($hasData) {
                            foreach ($columns as $i => $path) {
                                $cells[$i] = $num($form1, $path);
                                $totals[$group][$i] += $cells[$i];
                            }
                            $lkgThisWeek = $num($form1, 'lkgtc_gross.currentCrop.thisWeek');
                            $lkgToDate   = $num($form1, 'lkgtc_gross.currentCrop.toDate');
                        }
                    @endphp

                    <tr>
                        <td>{{ $ct }}</td>
                        <td>{{ $mill_code }}</td>
                        <td></td>
                        <td></td>
                        @for($i = 0; $i < 6; $i++)
                            <td class="text-right">{{ $hasData ? $dash($cells[$i], 4) : '-' }}</td>
                        @endfor
                        <td class="text-right">{{ $hasData ? $dash($lkgThisWeek, 4) : '-' }}</td>
                        <td class="text-right">{{ $hasData ? $dash($lkgToDate, 4) : '-' }}</td>
                    </tr>
                @endforeach

                {{-- Group subtotal --}}
                <tr class="text-strong" style="background-color: #f8ffeb;">
                    <td colspan="2" class="text-right" style="background-color: #f8ffeb;">Subtotal</td>
                    <td style="background-color: #f8ffeb;"></td>
                    <td style="background-color: #f8ffeb;"></td>
                    @foreach($totals[$group] as $value)
                        <td class="text-right" style="background-color: #f8ffeb;">{{ $dash($value, 4) }}</td>
                    @endforeach
                    <td class="text-right" style="background-color: #f8ffeb;">{{ $dash($ratio($totals[$group][3], $totals[$group][0]), 3) }}</td>
                    <td class="text-right" style="background-color: #f8ffeb;">{{ $dash($ratio($totals[$group][5], $totals[$group][2]), 3) }}</td>
                </tr>
            @endforeach

            @php
                $grand = [];
                foreach ($template as $key => $val) {
                    $grand[$key] = array_sum(array_column($totals, $key));
                }
            @endphp
            <tr class="text-strong" style="background-color: #fff3a0;">
                <td colspan="2" style="background-color: #fff3a0;">TOTAL</td>
                <td style="background-color: #fff3a0;"></td>
                <td style="background-color: #fff3a0;"></td>
                @foreach($grand as $value)
                    <td class="text-right" style="background-color: #fff3a0;">{{ $dash($value, 3) }}</td>
                @endforeach
                <td class="text-right" style="background-color: #fff3a0;">{{ $dash($ratio($grand[3], $grand[0]), 3) }}</td>
                <td class="text-right" style="background-color: #fff3a0;">{{ $dash($ratio($grand[5], $grand[2]), 3) }}</td>
            </tr>
        @endif
        </tbody>
    </table>
@endsection