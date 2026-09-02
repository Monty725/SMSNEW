<div id="form2" style="break-after: page">
    @include('sms.printables.forms.header',['formName' => 'SMS Form No. 2'])
    <h4 class="no-margin"><b>WEEKLY REPORT ON REFINED SUGAR</b></h4>
    <p class="no-margin"><i>(Figures in 50-Kg Bags)</i></p>
{{--    <p class="no-margin"><i>(Figures in Metric Tons)</i></p>--}}
    <table class="table-bordered " style="width: 100%">
        <thead>
        <tr >
            <th rowspan="2"></th>
            <th colspan="3" class="text-center" style="width: 35%;">CURRENT CROP</th>
            <th colspan="3" class="text-center" style="width: 35%;">PREVIOUS CROP</th>
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
            <td colspan="7">RAW SUGAR</td>

        </tr>

        <tr>
            <td>1. CARRY-OVER</td>
            <td class="text-right">
{{--                OLD--}}
{{--                {{ \App\Swep\Helpers\Helper::toNumber($form2['carryOver']['current'] ?? null,3) }}--}}
                {{ \App\Swep\Helpers\Helper::toNumber($newform2['values']['carryOver.currentCrop.thisWeek']) }}
            </td>
            <td class="text-right">
                {{$newform2['values']['carryOver.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['carryOver.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{ \App\Swep\Helpers\Helper::toNumber($newform2['values']['carryOver.prevCrop.thisWeek']) }}
            </td>
            <td class="text-right">
                {{$newform2['values']['carryOver.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['carryOver.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>
        <tr>
            <td colspan="7">2. Receipts: (For Refining)</td>
        </tr>
        <tr>
            <td colspan="7"><span class="indent"></span> 2.1 From Raw Mill</td>
        </tr>
        <tr>

            <td colspan><span class="indent"></span><span class="indent"></span> 2.1.1 Covered by SRO</td>
            <td class="text-right">
                {{$newform2['values']['coveredBySro.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['coveredBySro.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['coveredBySro.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['coveredBySro.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['coveredBySro.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['coveredBySro.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>
        <tr>
            <td colspan><span class="indent"></span><span class="indent"></span> 2.1.2 Not Covered by SRO</td>
            <td class="text-right">
                {{$newform2['values']['notCoveredBySro.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['notCoveredBySro.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['notCoveredBySro.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['notCoveredBySro.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['notCoveredBySro.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['notCoveredBySro.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>
        <tr>
            <td colspan><span class="indent"></span> 2.2 Other Mills</td>
            <td class="text-right">
                {{$newform2['values']['otherMills.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['otherMills.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['otherMills.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['otherMills.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['otherMills.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['otherMills.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>
        <tr>
            <td colspan><span class="indent"></span> 2.3. Old Crop w/ SRO</td>
            <td class="text-right">
                {{$newform2['values']['oldCrop.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['oldCrop.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['oldCrop.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['oldCrop.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['oldCrop.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['oldCrop.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>
        <tr>
            <td colspan><span class="indent"></span> 2.4. Imported</td>
            <td class="text-right">
                {{$newform2['values']['imported.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['imported.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['imported.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['imported.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['imported.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['imported.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>

{{--        <tr>--}}
{{--            <td colspan><span class="indent"></span> 2.4. Advance</td>--}}
{{--            <td class="text-right">--}}
{{--                {{$newform2['values']['advanceRefining.currentCrop.thisWeek'] ?? 0 }}--}}
{{--            </td>--}}
{{--            <td class="text-right">--}}
{{--                {{$newform2['values']['advanceRefining.currentCrop.prevWeek'] ?? 0 }}--}}
{{--            </td>--}}
{{--            <td class="text-right">--}}
{{--                {{$newform2['values']['advanceRefining.currentCrop.toDate'] ?? 0 }}--}}
{{--            </td>--}}
{{--            <td class="text-right">--}}
{{--                {{$newform2['values']['advanceRefining.prevCrop.thisWeek'] ?? 0 }}--}}
{{--            </td>--}}
{{--            <td class="text-right">--}}
{{--                {{$newform2['values']['advanceRefining.prevCrop.prevWeek'] ?? 0 }}--}}
{{--            </td>--}}
{{--            <td class="text-right">--}}
{{--                {{$newform2['values']['advanceRefining.prevCrop.toDate'] ?? 0 }}--}}
{{--            </td>--}}
{{--        </tr>--}}

        <tr>
            <td colspan class="text-right text-strong"><span class="indent"></span> TOTAL RECEIPTS</td>
            <td class="text-right text-strong">
                {{$newform2['values']['totalReceipt.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['totalReceipt.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['totalReceipt.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['totalReceipt.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['totalReceipt.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['totalReceipt.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>

        <tr>
            <td> 3. MELTED</td>
            <td class="text-right">
                {{$newform2['values']['melted.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['melted.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['melted.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['melted.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['melted.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['melted.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>
        <tr>
            <td> 4. WITHDRAWALS</td>
            <td class="text-right">
                {{$newform2['values']['rawWithdrawals.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['rawWithdrawals.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['rawWithdrawals.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['rawWithdrawals.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['rawWithdrawals.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['rawWithdrawals.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>
        <tr>
            <td> 5. BALANCE RAW </td>
            <td class="text-right">
                {{$newform2['values']['balanceRaw.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['balanceRaw.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['balanceRaw.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['balanceRaw.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['balanceRaw.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['balanceRaw.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>


        <tr>
            <td colspan="7">REFINED SUGAR</td>
        </tr>
        <tr>
            <td colspan="4">6. PRODUCTION/CARRY-OVER</td>
            <td class="text-right text-strong">
                {{ \App\Swep\Helpers\Helper::toNumber($form2['refinedCarryOver']['prev'] ?? null,3)  }}
            </td>
            <td class="text-right text-strong">
                {{ \App\Swep\Helpers\Helper::toNumber($prevToDateForm2['refinedCarryOver']['prev'] ?? null,3)  }}
            </td>
            <td class="text-right text-strong">
                {{ \App\Swep\Helpers\Helper::toNumber($toDateForm2['refinedCarryOver']['prev'] ?? null,3)  }}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 6.1 DOMESTIC</td>
            <td class="text-right">
                {{$newform2['values']['prodDomestic.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodDomestic.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodDomestic.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodDomestic.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodDomestic.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodDomestic.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>

        <tr>
            <td><span class="indent"></span> 6.2 IMPORTED</td>
            <td class="text-right">
                {{$newform2['values']['prodImported.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodImported.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodImported.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodImported.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodImported.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodImported.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 6.3 OVERAGES</td>
            <td class="text-right">
                {{$newform2['values']['overage.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['overage.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['overage.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['overage.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['overage.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['overage.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>
        <tr>
            <td class="text-right text-strong">TOTAL REFINED</td>
            <td class="text-right text-strong">
                {{$newform2['values']['totalRefined.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['totalRefined.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['totalRefined.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['totalRefined.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['totalRefined.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['totalRefined.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 6.4 RETURN TO PROCESS</td>
            <td class="text-right">
                {{$newform2['values']['prodReturn.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodReturn.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodReturn.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodReturn.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodReturn.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['prodReturn.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>
        <tr>
            <td class="text-right text-strong">PRODUCTION (NET)</td>
            <td class="text-right text-strong">
                {{$newform2['values']['prodNet.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['prodNet.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['prodNet.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['prodNet.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['prodNet.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right text-strong">
                {{$newform2['values']['prodNet.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>

        <tr>
            <td>7. ISSUANCES</td>
            <td class="text-right">
            <td></td>
            <td></td>
            <td class="text-right">
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td><span class="indent"></span>7.1 DOMESTIC </td>
            <td class="text-right">
                {{$newform2['values']['totalIssuanceDomestic.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalIssuanceDomestic.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalIssuanceDomestic.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalIssuanceDomestic.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalIssuanceDomestic.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalIssuanceDomestic.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>

        <tr>
            <td><span class="indent"></span>7.2 IMPORTED </td>
            <td class="text-right">
                {{$newform2['values']['totalIssuanceImported.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalIssuanceImported.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalIssuanceImported.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalIssuanceImported.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalIssuanceImported.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalIssuanceImported.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>

{{--        OLD ISSUANCE FORM 2A--}}
{{--        @if(!empty($form2['issuances']) || !empty($prevToDateForm2['issuances']) ||  !empty($toDateForm2['issuances'] ))--}}
{{--            @php--}}
{{--                $common = array_merge($form2['issuances'] ?? [], $prevToDateForm2['issuances'] ?? [], $toDateForm2['issuances'] ?? []);--}}
{{--            @endphp--}}
{{--            @foreach($common as $k => $val)--}}
{{--                <tr>--}}
{{--                    <td><span class="indent"></span> 7.{{$loop->iteration}} {{strtoupper($k)}}</td>--}}
{{--                    <td class="text-right">--}}
{{--                        {{\App\Swep\Helpers\Helper::toNumber($form2['issuances'][$k]['current'] ?? null, 3)}}--}}
{{--                    </td>--}}
{{--                    <td class="text-right">--}}
{{--                        {{\App\Swep\Helpers\Helper::toNumber($prevToDateForm2['issuances'][$k]['current'] ?? null, 3)}}--}}
{{--                    </td>--}}
{{--                    <td class="text-right">--}}
{{--                        {{\App\Swep\Helpers\Helper::toNumber($toDateForm2['issuances'][$k]['current'] ?? null, 3)}}--}}
{{--                    </td>--}}
{{--                    <td class="text-right">--}}
{{--                        {{\App\Swep\Helpers\Helper::toNumber($form2['issuances'][$k]['prev'] ?? null, 3)}}--}}
{{--                    </td>--}}
{{--                    <td class="text-right">--}}
{{--                        {{\App\Swep\Helpers\Helper::toNumber($prevToDateForm2['issuances'][$k]['prev'] ?? null, 3)}}--}}
{{--                    </td>--}}
{{--                    <td class="text-right">--}}
{{--                        {{\App\Swep\Helpers\Helper::toNumber($toDateForm2['issuances'][$k]['prev'] ?? null, 3)}}--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        @endif--}}

        <tr>
            <td>8. WITHDRAWALS</td>
            <td class="text-right"></td>
            <td></td>
            <td></td>
            <td class="text-right"></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td><span class="indent"></span>7.1 DOMESTIC </td>
            <td class="text-right">
                {{$newform2['values']['totalWithdrawalDomestic.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalWithdrawalDomestic.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalWithdrawalDomestic.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalWithdrawalDomestic.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalWithdrawalDomestic.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalWithdrawalDomestic.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>

        <tr>
            <td><span class="indent"></span>7.2 IMPORTED </td>
            <td class="text-right">
                {{$newform2['values']['totalWithdrawalImported.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalWithdrawalImported.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalWithdrawalImported.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalWithdrawalImported.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalWithdrawalImported.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['totalWithdrawalImported.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>

{{--        OLD WITHDRAWAL FORM 2--}}
{{--        @if(isset($form2['withdrawals']) || isset($prevToDateForm2['withdrawals']) || isset($toDateForm2['withdrawals']))--}}
{{--            @php--}}
{{--                $common = array_keys(array_merge($form2['withdrawals'],$prevToDateForm2['withdrawals'] ?? [] ,$toDateForm2['withdrawals'] ));--}}
{{--                sort($common);--}}
{{--            @endphp--}}
{{--            @foreach($common as $value)--}}
{{--                <tr>--}}
{{--                    <td><span class="indent"></span> 8.{{$loop->iteration}}. {{strtoupper($value)}}</td>--}}
{{--                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form2['withdrawals'][$value]['current'] ?? null,3)}}</td>--}}
{{--                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm2['withdrawals'][$value]['current'] ?? null ,3)}}</td>--}}
{{--                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm2['withdrawals'][$value]['current'] ?? null ,3)}}</td>--}}
{{--                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($form2['withdrawals'][$value]['prev'] ?? null,3)}}</td>--}}
{{--                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($prevToDateForm2['withdrawals'][$value]['prev'] ?? null ,3)}}</td>--}}
{{--                    <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($toDateForm2['withdrawals'][$value]['prev'] ?? null ,3)}}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        @endif--}}


        <tr>
            <td>9. STOCK BALANCE</td>
            <td class="text-right">
                {{$newform2['values']['stockBalance.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['stockBalance.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['stockBalance.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['stockBalance.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['stockBalance.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['stockBalance.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>

        <tr>
            <td>10. UNQUEDANNED</td>
            <td class="text-right">
                {{$newform2['values']['form2_unquedanned.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['form2_unquedanned.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['form2_unquedanned.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['form2_unquedanned.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['form2_unquedanned.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['form2_unquedanned.prevCrop.toDate'] ?? 0 }}
            </td>
        </tr>

        <tr>
            <td>11. STOCK ON HAND</td>
            <td class="text-right">
                {{$newform2['values']['stockOnHand.currentCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['stockOnHand.currentCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['stockOnHand.currentCrop.toDate'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['stockOnHand.prevCrop.thisWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['stockOnHand.prevCrop.prevWeek'] ?? 0 }}
            </td>
            <td class="text-right">
                {{$newform2['values']['stockOnHand.prevCrop.toDate'] ?? 0 }}
        </tr>

        <tr>
            <td colspan="7">
                12. REFINED SUGAR QUEDAN ISSUANCES (SERIES & NO. OF PCS)
            </td>
        </tr>
        <tr>
            <td colspan="4"><span class="indent"></span>
                <span class="text-strong">STANDARD:</span>
                @if(!empty($details_arr['REFINED']['seriesNos']['STANDARD']))
                        @foreach($details_arr['REFINED']['seriesNos']['STANDARD'] as $sn)
                            {{$sn->seriesFrom}} - {{$sn->seriesTo}} ({{$sn->noOfPcs}}) pcs,
                        @endforeach
                @else

                @endif
            </td>

            <td colspan="3">
                <span class="text-strong">PREMIUM:</span>
                @if(!empty($details_arr['REFINED']['seriesNos']['PREMIUM']))
                    @foreach($details_arr['REFINED']['seriesNos']['PREMIUM'] as $sn)
                        {{$sn->seriesFrom}} - {{$sn->seriesTo}} ({{$sn->noOfPcs}}) pcs,
                    @endforeach
                @else

                @endif
            </td>

        </tr>
        <tr>
            <td>13. Remarks:</td>
            <td  colspan=6">
                {{ $wr->form2->remarks ?? null }}
            </td>

        </tr>


        </tbody>
    </table>

    <table class="sign-table cols-3">
        <tr>
            <td>Certified:</td>
            <td>Verified:</td>
            <td>Verfiied:</td>
        </tr>
        <tr >
            <td>
                <u>{{$signatories['form2']['sign1']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form2']['sign2']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form2']['sign3']['name'] ?? null}}</u>
            </td>
        </tr>
        <tr >
            <td>
                {{$signatories['form2']['sign1']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form2']['sign2']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form2']['sign3']['position'] ?? null}}
            </td>
        </tr>
    </table>
</div>