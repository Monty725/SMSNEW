@extends('printables.print_layouts.print_layout_main')


@section('wrapper')
    <table class="" style="width: 100%;">
        <tr>
            <td style="width: 30%" class="text-top">
                <p class="no-margin text-strong">THE ADMINISTRATOR</p>
                <p class="no-margin">SUGAR REGULATORY ADMINISTRATION</p>
                <p class="no-margin">SRA, DILIMAN, QUEZON CITY</p>
            </td>
            <td class="text-center" class="text-top">
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

{{--    <p class="text-strong">RAW SUGAR PRODUCTION, WITHDRAWALS & STOCK BALANCES IN (In LKG Bags)</p>--}}
    <p class="text-strong">RAW SUGAR PRODUCTION, WITHDRAWALS & STOCK BALANCES (In Metric Tons)</p>


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
                    $template = [];
                    for ($x = 0;$x < 11; $x++){
                        $template[$x] = 0;
                    }
                @endphp
                @foreach($comparativeArray as $group => $mills)
                    @php
                        $totals[$group] = $template;
                    @endphp
                    @foreach($mills as $mill_code => $mill)
                        @php
                            $ct++;
                        @endphp
                        @if(!empty($mill['newform1']))
                            @php
                                $prevManufactured = $mill_code['values']['manufactured']['prevCrop']['toDate'] ?? 0;
                                $currentManufactured = $mill_code['values']['manufactured']['currentCrop']['toDate'] ?? 0;
                                $currentWithdrawals = $mill_code['values']['totalAllWithdraw']['currentCrop']['toDate'] ?? 0;
                                $prevWithdrawals = $mill_code['values']['totalAllWithdraw']['prevCrop']['toDate'] ?? 0;
                                $currentTransfers = $mill_code['values']['transfersToRef']['currentCrop']['toDate'] ?? 0;
                                $prevTransfers = $mill_code['values']['transfersToRef']['prevCrop']['toDate'] ?? 0;
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
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php($totals[$group][0] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['manufactured']['prevCrop']['toDate']))
                                    {{\App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['manufactured']['prevCrop']['toDate']),3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php($totals[$group][1] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['manufactured']['currentCrop']['thisWeek']))
                                    {{\App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['manufactured']['currentCrop']['thisWeek']),3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php($totals[$group][2] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['manufactured']['currentCrop']['prevWeek']))
                                    {{\App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['manufactured']['currentCrop']['prevWeek']),3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php($totals[$group][3] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['manufactured']['currentCrop']['toDate']))
                                    {{\App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['manufactured']['currentCrop']['toDate']),3,'-')}}
                                @endif
                            </td>


                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php($totals[$group][4] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalAllWithdraw']['currentCrop']['toDate']))
                                    {{\App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalAllWithdraw']['currentCrop']['toDate']),3,'-')}}
                                @endif
                            </td>



                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php($totals[$group][5] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalAllWithdraw']['prevCrop']['toDate']))
                                    {{\App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalAllWithdraw']['prevCrop']['toDate']),3,'-')}}
                                @endif
                            </td>

                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php($totals[$group][6] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['stockBal']['currentCrop']['toDate']))
                                    {{\App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['stockBal']['currentCrop']['toDate']),3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
{{--                                    @dd(Helper::sanitize("(100,000.000)"));--}}
                                    @php($totals[$group][7] += Helper::sanitize($weeklyReportsArray[$mill_code]['values']['stockBal']['prevCrop']['toDate']))
                                    {{\App\Swep\Helpers\Helper::toNumber(Helper::sanitize($weeklyReportsArray[$mill_code]['values']['stockBal']['prevCrop']['toDate']),3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php($totals[$group][8] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['transfersToRef']['currentCrop']['toDate']))
                                    {{\App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['transfersToRef']['currentCrop']['toDate']),3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php($totals[$group][9] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['transfersToRef']['prevCrop']['toDate']))
                                    {{\App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['transfersToRef']['prevCrop']['toDate']),3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php($totals[$group][10] +=
                                        (Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['manufactured']['prevCrop']['toDate'] ?? 0)
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalAllWithdraw']['prevCrop']['toDate'] ?? 0)
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['transfersToRef']['prevCrop']['toDate'] ?? 0))
                                        + (Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['manufactured']['currentCrop']['toDate'] ?? 0)
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalAllWithdraw']['currentCrop']['toDate'] ?? 0)
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['transfersToRef']['currentCrop']['toDate'] ?? 0)))
                                    {{\App\Swep\Helpers\Helper::toNumber(
                                        Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['manufactured']['prevCrop']['toDate'])
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalAllWithdraw']['prevCrop']['toDate'])
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['transfersToRef']['prevCrop']['toDate'])
                                        + (Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['manufactured']['currentCrop']['toDate'])
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalAllWithdraw']['currentCrop']['toDate'])
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['transfersToRef']['currentCrop']['toDate'])),3,'-') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    <tr class="text-strong" style="background-color: #f8ffeb">
                        <td colspan="2" class="text-right">
                            {{$group}} Subtotal
                        </td>
                        @if(!empty($totals[$group]))
                            @foreach($totals[$group] as $value)
                                <td class="text-right">{{number_format($value,3)}}</td>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
                    <tr class="text-strong">
                        <td colspan="2">TOTAL (MT)</td>
                        @foreach($template as $key => $val)
                            <td class="text-right">{{number_format(array_sum(array_column($totals,$key)),3)}}</td>
                        @endforeach
                    </tr>
                <tr class="text-strong">
                    <td colspan="2">TOTAL (LKG)</td>
                    @foreach($template as $key => $val)
                        <td class="text-right">{{number_format(array_sum(array_column($totals,$key)) * 20,3)}}</td>
                    @endforeach
                </tr>
            @endif
        </tbody>
    </table>
@endsection