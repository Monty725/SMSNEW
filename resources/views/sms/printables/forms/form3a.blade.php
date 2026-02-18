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
            <td>1.1 Carry-Over</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['carryOver']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['carryOver']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['carryOver']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['carryOver']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['carryOver']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['carryOver']['prev'] ?? null,4)}}</td>
        </tr>
        <tr>
            <td>1.2 Net Production</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['netProd']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['netProd']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['netProd']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['netProd']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['netProd']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['netProd']['prev'] ?? null,4)}}</td>
        </tr>
        <tr>
            <td>1.3 Retention, Adjustment, Overages,etc.</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['rao']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['rao']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['rao']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['rao']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['rao']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['rao']['prev'] ?? null,4)}}</td>
        </tr>
        <tr>
            <td>1.4 Receipts</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['receipts']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['receipts']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['receipts']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['receipts']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['receipts']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['receipts']['prev'] ?? null,4)}}</td>
        </tr>
        <tr>
            <td>1.5 Withdrawals</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['withdrawals']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['withdrawals']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['withdrawals']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['withdrawals']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['withdrawals']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['withdrawals']['prev'] ?? null,4)}}</td>
        </tr>
        <tr>
            <td>1.6 Transfers to Subsidiary</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['transferToRefinery']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['transferToRefinery']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['transferToRefinery']['current'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form3a['transferToRefinery']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['transferToRefinery']['prev'] ?? null,4)}}</td>
            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['transferToRefinery']['prev'] ?? null,4)}}</td>
        </tr>
        <tr>
            <td>1.7 Stock Balance</td>
            <td class="text-right"></td>
            <td class="text-right"></td>
            <td class="text-right"></td>
            <td class="text-right"></td>
            <td class="text-right"></td>
            <td class="text-right"></td>
        </tr>
        <tr>
            <td colspan="7"><br></td>
        </tr>
        @if(count($form3a['subsidiaries']) > 0)
            @foreach($form3a['subsidiaries'] as $key => $subs)
                <tr>
                    <td colspan="7" class="text-strong">2.{{$loop->iteration}} {{\App\Swep\Helpers\Arrays::subsidiaryItems()[$key]}}</td>
                </tr>
                @php($total['current'] = 0)
                @php($total['prevCWeek'] = 0)
                @php($total['toCDate'] = 0)
                @php($total['prev'] = 0)
                @php($total['prevPWeek'] = 0)
                @php($total['toPDate'] = 0)
                @if(count($subs) > 0)
                    @foreach($subs as $alias => $sub)
                        @if(!empty($sub['obj']))
                            @if($sub['obj']->for == 'MOLASSES' )
                                @php($total['current'] = $total['current'] + ($sub['current'] ?? 0))
                                @php($total['prevCWeek'] += ($prevToDateForm3a['subsidiaries'][$key][$alias]['current'] ?? 0))
                                @php($total['toCDate'] += ($toDateForm3a['subsidiaries'][$key][$alias]['current'] ?? 0))
                                @php($total['prev'] = $total['prev'] + ($sub['prev'] ?? 0))
                                @php($total['prevPWeek'] += ($prevToDateForm3a['subsidiaries'][$key][$alias]['prev'] ?? 0))
                                @php($total['toPDate'] += ($toDateForm3a['subsidiaries'][$key][$alias]['prev'] ?? 0))
                                <tr>
{{--                                    UPDATE OF PREV WEEK AND TO DATE--}}
                                    <td><span class="indent"></span> {{$sub['obj']->name ?? null}} ({{$alias}})</td>
                                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($sub['current'] ?? null,3)}}</td>
                                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['subsidiaries'][$key][$alias]['current'] ?? 0,4)}}</td>
                                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['subsidiaries'][$key][$alias]['current'] ?? 0,4)}}</td>
                                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($sub['prev'] ?? null,3)}}</td>
                                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm3a['subsidiaries'][$key][$alias]['prev'] ?? 0,4)}}</td>
                                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm3a['subsidiaries'][$key][$alias]['prev'] ?? 0,4)}}</td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                    <tr>
                        <td class="text-right text-strong">TOTAL</td>
                        <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($total['current'],4)}}</td>
                        <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($total['prevCWeek'],4)}}</td>
                        <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($total['toCDate'],4)}}</td>
                        <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($total['prev'],4)}}</td>
                        <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($total['prevPWeek'],4)}}</td>
                        <td class="text-right text-strong">{{\App\Swep\Helpers\Helper::toNumber($total['toPDate'],4)}}</td>
                    </tr>
                @endif
            @endforeach
        @endif
        </tbody>
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