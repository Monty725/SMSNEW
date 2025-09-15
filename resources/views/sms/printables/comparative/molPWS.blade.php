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
                    $template = [];
                    for ($x = 0;$x <= 10; $x++){
                        $template[$x] = 0;
                    }
                @endphp
                @foreach($millsArray as $group => $mills)
                    @php
                        $totals[$group] = $template;
                    @endphp
                    @foreach($mills as $mill_code => $mill)
                        @php
                            $ct++;
                        @endphp
                        @if(!empty($mill['form1']))
                            @php
                                $prevManufactured = $mill['form1']['toDate']['manufactured']['prev'] ?? 0;
                                $currentManufactured = $mill['form1']['toDate']['manufactured']['current'] ?? 0;
                                $currentWithdrawals = $mill['form1']['toDate']['withdrawalsTotal']['current'] ?? 0;
                                $prevWithdrawals = $mill['form1']['toDate']['withdrawalsTotal']['prev'] ?? 0;
                                $currentTransfers = $mill['form1']['toDate']['transfersToRefinery']['current'] ?? 0;
                                $prevTransfers = $mill['form1']['toDate']['transfersToRefinery']['prev'] ?? 0;
                            @endphp
                        @else
                            @php
                                $prevManufactured = 0;
                                $currentManufactured = 0;
                                $currentWithdrawals = 0;
                                $prevWithdrawals = 0;
                                $currentTransfers = 0;
                                $prevTransfers = 0;
                            @endphp
                        @endif

                        <tr>
                            <td>{{$ct}}</td>
                            <td>{{$mill_code}}</td>
                            <td></td>
                            <td></td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][0] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['prevCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['prevCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][1] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['currentCrop']['thisWeek'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['currentCrop']['thisWeek']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][2] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['currentCrop']['prevWeek'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['currentCrop']['prevWeek']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][3] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['currentCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['currentCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][4] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['currentCrop']['thisWeek'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['currentCrop']['thisWeek']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][5] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['currentCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['currentCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][6] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['prevCrop']['thisWeek'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['prevCrop']['thisWeek']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][7] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['prevCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['prevCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][8] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['currentCrop']['toDate'] ?? 0)
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['currentCrop']['toDate'] ?? 0);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['currentCrop']['toDate'])
                                    - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['currentCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][9] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['prevCrop']['toDate'] ?? 0)
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['prevCrop']['toDate'] ?? 0);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['prevCrop']['toDate'])
                                    - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['prevCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][10] +=
                                        (Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['currentCrop']['toDate'] ?? 0)
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['currentCrop']['toDate'] ?? 0))
                                        + (Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['prevCrop']['toDate'] ?? 0)
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['prevCrop']['toDate'] ?? 0));
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(
                                        Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['currentCrop']['toDate'])
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['currentCrop']['toDate'])
                                        + (Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalProduction']['prevCrop']['toDate'])
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalOverallWith']['prevCrop']['toDate'])),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                {{$mill['form3']['thisWeek']['distFactor'] ?? ''}}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="text-strong">
                        <td colspan="2" class="text-right">
                            {{$group}} Subtotal
                        </td>
                        <td></td>
                        <td></td>
                        @if(!empty($totals[$group]))
                            @foreach($totals[$group] as $value)
                                <td class="text-right text-strong">{{number_format($value,3)}}</td>
                            @endforeach
                        @endif
                        <td></td>
                    </tr>
                @endforeach
                <tr class="text-strong">
                    <td colspan="2">TOTAL (LKG)</td>
                    <td></td>
                    <td></td>
                    @foreach($template as $key => $val)
                        <td class="text-right">{{number_format(array_sum(array_column($totals,$key)),3)}}</td>
                    @endforeach
                    <td></td>
                </tr>
            @endif
        </tbody>
    </table>

@endsection