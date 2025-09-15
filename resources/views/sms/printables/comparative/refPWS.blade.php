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


                        <tr>
                            <td>{{$ct}}</td>
                            <td>{{$mill_code}}</td>
                            <td></td>
                            <td></td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][0] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['prodNet']['prevCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['prodNet']['prevCrop']['toDate']),3,'-') }}
                                @endif
                            </td>

                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][1] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['prodNet']['currentCrop']['thisWeek'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['prodNet']['currentCrop']['thisWeek']),3,'-') }}
                                @endif
                            </td>

                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][2] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['prodNet']['currentCrop']['prevWeek'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['prodNet']['currentCrop']['prevWeek']),3,'-') }}
                                @endif
                            </td>

                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][3] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['prodNet']['currentCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['prodNet']['currentCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][4] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalWithdrawalOverall']['currentCrop']['thisWeek'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalWithdrawalOverall']['currentCrop']['thisWeek']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][5] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalWithdrawalOverall']['currentCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalWithdrawalOverall']['currentCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][6] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalWithdrawalOverall']['prevCrop']['thisWeek'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalWithdrawalOverall']['prevCrop']['thisWeek']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][7] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalWithdrawalOverall']['prevCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalWithdrawalOverall']['prevCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][8] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['stockBalance']['currentCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['stockBalance']['currentCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][9] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['stockBalance']['prevCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['stockBalance']['prevCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][10] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['stockBalance']['currentCrop']['toDate'] ?? 0) + Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['stockBalance']['prevCrop']['toDate'] ?? 0);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['stockBalance']['currentCrop']['toDate'] ?? 0) + Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['stockBalance']['prevCrop']['toDate'] ?? 0),3,'-') }}
                                @endif
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
                    </tr>
                @endforeach
                <tr class="text-strong">
                    <td colspan="2">TOTAL (LKG)</td>
                    <td></td>
                    <td></td>
                    @foreach($template as $key => $val)
                        <td class="text-right">{{number_format(array_sum(array_column($totals,$key)),3)}}</td>
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
                    $template = [];
                    for ($x = 0;$x <= 14; $x++){
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


                        <tr>
                            <td>{{$ct}}</td>
                            <td>{{$mill_code}}</td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][0] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['carryOver']['prevCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['carryOver']['prevCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][1] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalReceipt']['currentCrop']['thisWeek'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalReceipt']['currentCrop']['thisWeek']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][2] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalReceipt']['currentCrop']['prevWeek'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalReceipt']['currentCrop']['prevWeek']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][3] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalReceipt']['currentCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalReceipt']['currentCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][4] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['currentCrop']['thisWeek'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['currentCrop']['thisWeek']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][5] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['currentCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['currentCrop']['toDate']),3,'-') }}
                                @endif
                            </td>

                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][6] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['prevCrop']['thisWeek'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['prevCrop']['thisWeek']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][7] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['prevCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['prevCrop']['toDate']),3,'-') }}
                                @endif
                            </td>


                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][8] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['currentCrop']['thisWeek'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['currentCrop']['thisWeek']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][9] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['currentCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['currentCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][10] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['prevCrop']['thisWeek'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['prevCrop']['thisWeek']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][11] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['prevCrop']['toDate'] ?? null);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['prevCrop']['toDate']),3,'-') }}
                                @endif
                            </td>


                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][12] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalReceipt']['currentCrop']['toDate'] ?? 0) - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['currentCrop']['toDate'] ?? 0) - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['currentCrop']['toDate'] ?? 0);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalReceipt']['currentCrop']['toDate']) - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['currentCrop']['toDate']) - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['currentCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][13] += Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalReceipt']['prevCrop']['toDate'] ?? 0)
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['prevCrop']['toDate'] ?? 0)
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['prevCrop']['toDate'] ?? 0);
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalReceipt']['prevCrop']['toDate'])
                                    - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['prevCrop']['toDate'])
                                    - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['prevCrop']['toDate']),3,'-') }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($weeklyReportsArray[$mill_code]))
                                    @php
                                        $totals[$group][14] +=
                                        (Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalReceipt']['currentCrop']['toDate'] ?? 0)
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['currentCrop']['toDate'] ?? 0)
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['currentCrop']['toDate'] ?? 0))
                                        + (Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalReceipt']['prevCrop']['toDate'] ?? 0)
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['prevCrop']['toDate'] ?? 0)
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['prevCrop']['toDate'] ?? 0));
                                    @endphp
                                    {{ \App\Swep\Helpers\Helper::toNumber(
                                        Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalReceipt']['currentCrop']['toDate'])
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['currentCrop']['toDate'])
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['currentCrop']['toDate'])
                                        + (Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['totalReceipt']['prevCrop']['toDate'])
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['melted']['prevCrop']['toDate'])
                                        - Helper::sanitizeAutonum($weeklyReportsArray[$mill_code]['values']['rawWithdrawals']['prevCrop']['toDate'])),3,'-') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr class="text-strong">
                        <td colspan="2" class="text-right">
                            {{$group}} Subtotal
                        </td>
                        @if(!empty($totals[$group]))
                            @foreach($totals[$group] as $value)
                                <td class="text-right text-strong">{{number_format($value,3)}}</td>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
                <tr class="text-strong">
                    <td colspan="2">TOTAL (LKG)</td>
                    @foreach($template as $key => $val)
                        <td class="text-right">{{number_format(array_sum(array_column($totals,$key)),3)}}</td>
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