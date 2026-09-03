<div id="form5" style="break-after: page">
    @php
        $sugarClasses = $wr->form5Deliveries()->groupBy('sugar_class')->get();
        $usedSugarClassesArray = ['A','B','C'];
        if(!empty($sugarClasses)){
            foreach ($sugarClasses as $sugarClass){
                if(!in_array($sugarClass->sugar_class,$usedSugarClassesArray)){
                    array_push($usedSugarClassesArray,$sugarClass->sugar_class);
                }
            }
        }

    @endphp
    @include('sms.printables.forms.header',['formName' => 'SMS Form No. 5'])
    <h4 class="no-margin"><b>SUGAR RELEASE ORDER AND DELIVERY REPORT - RAW</b> </h4>
    <p class="no-margin"><i>(Figures in 50-Kg Bags)</i></p>

    <p class="text-left">A. Issuances of SRO</p>
    <table class="table-bordered details-top-right-table" style="width: 100%">
        <thead>
        <tr>
            <th class="text-center">SRO No.</th>
            <th class="text-center">Trader/Owner</th>
            <th class="text-center">CEAs, COCs, Etc.</th>
            <th class="text-center">Date of Issue</th>
            <th class="text-center">Liens OR #.</th>
            <th class="text-center">Sugar Class</th>
            <th class="text-center">Qty 50-Kg Bags</th>
{{--            <th class="text-center">Qty LKG</th>--}}
        </tr>
        </thead>
        <tbody>
        @php($total = 0)
        @if(!empty($wr->form5IssuancesOfSro))
            @foreach($wr->form5IssuancesOfSro as $form5IssuancesOfSro)
                @php($total = $total + ($form5IssuancesOfSro->qty ?? $form5IssuancesOfSro->qty_prev))
                <tr>
                    <td>{{$form5IssuancesOfSro->sro_no}}</td>
                    <td>{{$form5IssuancesOfSro->trader}}</td>
                    <td>{{$form5IssuancesOfSro->cea}}</td>
                    <td class="text-center">{{Carbon::parse($form5IssuancesOfSro->date_of_issue)->format('m/d/Y')}}</td>
                    <td class="text-center">{{$form5IssuancesOfSro->liens_or}}</td>
                    <td class="text-center">
                        {{$form5IssuancesOfSro->sugar_class}} {{($form5IssuancesOfSro->refining == 1 ? ' - Refining' : '')}}
                        {{(!empty($form5IssuancesOfSro->qty_prev) ? ', Previous' : null)}}
                    </td>
                    <td class="text-right">{{number_format($form5IssuancesOfSro->qty ?? $form5IssuancesOfSro->qty_prev ,4)}}</td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td colspan="5" class="text-strong">
                TOTAL
            </td>
            <td class="text-strong text-right">
                {{number_format($total,4)}}
            </td>
        </tr>
        </tbody>
    </table>
    <br>

{{--OLD DELIVERIES START--}}

{{--    <p class="text-left">B. Delivery</p>--}}
{{--    <table class="table-bordered details-top-right-table" style="width: 100%">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th rowspan="2" class="text-center">SRO No.</th>--}}
{{--            <th rowspan="2" class="text-center">Date of Withdrawal</th>--}}
{{--            <th rowspan="2" class="text-center">Trader/Owner</th>--}}
{{--            <th colspan="{{count($usedSugarClassesArray)}}" class="text-center">Sugar Class</th>--}}
{{--            <th rowspan="2" class="text-center">Remarks</th>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            @php($totals = [])--}}
{{--            @foreach($usedSugarClassesArray as $class)--}}
{{--                @php($totals[$class] = 0)--}}
{{--                <td class="text-center" style="width: 10%">--}}
{{--                    {{$class}}--}}
{{--                </td>--}}
{{--            @endforeach--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}

{{--        @if(!empty($wr->form5Deliveries))--}}
{{--            @foreach($wr->form5Deliveries as $form5Deliveries)--}}
{{--                <tr>--}}
{{--                    <td>{{$form5Deliveries->sro_no}}</td>--}}
{{--                    <td>--}}
{{--                        {{ \Illuminate\Support\Carbon::parse($form5Deliveries->start_of_withdrawal)->format('m/d/Y') }}--}}
{{--                        @if($form5Deliveries->end_of_withdrawal)--}}
{{--                            to {{ \Illuminate\Support\Carbon::parse($form5Deliveries->end_of_withdrawal)->format('m/d/Y') }}--}}
{{--                        @endif--}}
{{--                    </td>--}}
{{--                    <td>{{$form5Deliveries->trader}}</td>--}}
{{--                    @foreach($usedSugarClassesArray as $class)--}}
{{--                        @if($form5Deliveries->sugar_class == $class)--}}
{{--                            <td class="text-right">--}}

{{--                                @if($form5Deliveries->qty != null)--}}
{{--                                    @php($totals[$class] = $totals[$class] + $form5Deliveries->qty)--}}
{{--                                    {{number_format($form5Deliveries->qty,4)}}--}}
{{--                                @else--}}
{{--                                    @php($totals[$class] = $totals[$class] + $form5Deliveries->qty_prev)--}}
{{--                                    {{number_format($form5Deliveries->qty_prev,4)}}--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                        @else--}}
{{--                            <td></td>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                    <td>{{($form5Deliveries->refining == 1) ? 'For Refining':''}} {{$form5Deliveries->remarks}} {{$form5Deliveries->qty_prev != null ?  'PREVIOUS' : null}}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        @endif--}}
{{--        <tr>--}}
{{--            <td colspan="3"></td>--}}
{{--            @foreach($usedSugarClassesArray as $class)--}}
{{--                <td class="text-right">--}}
{{--                    {{number_format($totals[$class] , 4)}}--}}
{{--                </td>--}}
{{--            @endforeach--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}

{{--OLD DELIVERIES END--}}
{{--NEW DELIVERIES START--}}

    <p class="text-left">B. Delivery</p>

    <table class="table-bordered details-top-right-table" style="width: 100%">
        <thead>
        <tr>
            <th rowspan="2" class="text-center">SRO No.</th>
            <th rowspan="2" class="text-center">Date of Withdrawal</th>
            <th rowspan="2" class="text-center">Trader/Owner</th>

            <th colspan="{{ count($usedSugarClassesArray) + 1 }}" class="text-center">
                Sugar Class
            </th>

            <th rowspan="2" class="text-center">Remarks</th>
        </tr>

        <tr>
            @php($totals = [])
            @php($previousTotals = [])
            @php($refiningTotals = [])
            @php($previousRefiningTotals = [])

            @foreach($usedSugarClassesArray as $class)

                @php($totals[$class] = 0)
                @php($previousTotals[$class] = 0)

                <td class="text-center" style="width: 10%">
                    {{ $class }}
                </td>

                @if($class == 'B')

                    @php($refiningTotals[$class] = 0)
                    @php($previousRefiningTotals[$class] = 0)

                    <td class="text-center" style="width: 10%">
                        B-Refining
                    </td>

                @endif

            @endforeach
        </tr>
        </thead>

        <tbody>

        {{-- ===================================================== --}}
        {{-- CURRENT CROP DIVIDER --}}
        {{-- ===================================================== --}}

        <tr>
            <td colspan="{{ 5 + count($usedSugarClassesArray) }}"
                class="text-center"
                style="font-weight: bold; background-color: #f2f2f2;">
                CURRENT CROP
            </td>
        </tr>


        {{-- ===================================================== --}}
        {{-- CURRENT DELIVERIES --}}
        {{-- ===================================================== --}}

        @if(!empty($wr->form5Deliveries))

            @foreach($wr->form5Deliveries as $form5Deliveries)

                @if($form5Deliveries->qty_prev == null)

                    <tr>
                        <td>
                            {{ $form5Deliveries->sro_no }}
                        </td>

                        <td>
                            {{ \Illuminate\Support\Carbon::parse($form5Deliveries->start_of_withdrawal)->format('m/d/Y') }}

                            @if($form5Deliveries->end_of_withdrawal)
                                to
                                {{ \Illuminate\Support\Carbon::parse($form5Deliveries->end_of_withdrawal)->format('m/d/Y') }}
                            @endif
                        </td>

                        <td>
                            {{ $form5Deliveries->trader }}
                        </td>


                        @foreach($usedSugarClassesArray as $class)

                            {{-- NORMAL SUGAR CLASS --}}
                            @if(
                                $form5Deliveries->sugar_class == $class &&
                                !($class == 'B' && $form5Deliveries->refining == 1)
                            )

                                <td class="text-right">

                                    @if($form5Deliveries->qty != null)

                                        @php($totals[$class] += $form5Deliveries->qty)

                                        {{ number_format($form5Deliveries->qty, 4) }}

                                    @endif

                                </td>

                            @else

                                <td></td>

                            @endif


                            {{-- B-REFINING --}}
                            @if($class == 'B')

                                @if(
                                    $form5Deliveries->sugar_class == 'B' &&
                                    $form5Deliveries->refining == 1
                                )

                                    <td class="text-right">

                                        @if($form5Deliveries->qty != null)

                                            @php($refiningTotals['B'] += $form5Deliveries->qty)

                                            {{ number_format($form5Deliveries->qty, 4) }}

                                        @endif

                                    </td>

                                @else

                                    <td></td>

                                @endif

                            @endif

                        @endforeach


                        <td>
{{--                            {{ ($form5Deliveries->refining == 1) ? 'For Refining' : '' }}--}}
                            {{ $form5Deliveries->remarks }}
                        </td>

                    </tr>

                @endif

            @endforeach

        @endif


        {{-- ===================================================== --}}
        {{-- CURRENT TOTALS --}}
        {{-- ===================================================== --}}

        <tr>
            <td colspan="3"></td>

            @foreach($usedSugarClassesArray as $class)

                {{-- Normal Total --}}
                <td class="text-right">
                    <strong>
                        {{ number_format($totals[$class], 4) }}
                    </strong>
                </td>

                {{-- B-Refining Total --}}
                @if($class == 'B')

                    <td class="text-right">
                        <strong>
                            {{ number_format($refiningTotals['B'], 4) }}
                        </strong>
                    </td>

                @endif

            @endforeach

            <td></td>
        </tr>


        {{-- ===================================================== --}}
        {{-- PREVIOUS CROP DIVIDER --}}
        {{-- ===================================================== --}}

        <tr>
            <td colspan="{{ 5 + count($usedSugarClassesArray) }}"
                class="text-center"
                style="font-weight: bold; background-color: #f2f2f2;">
                PREVIOUS
            </td>
        </tr>


        {{-- ===================================================== --}}
        {{-- PREVIOUS DELIVERIES --}}
        {{-- ===================================================== --}}

        @if(!empty($wr->form5Deliveries))

            @foreach($wr->form5Deliveries as $form5Deliveries)

                @if($form5Deliveries->qty_prev != null)

                    <tr>
                        <td>
                            {{ $form5Deliveries->sro_no }}
                        </td>

                        <td>
                            {{ \Illuminate\Support\Carbon::parse($form5Deliveries->start_of_withdrawal)->format('m/d/Y') }}

                            @if($form5Deliveries->end_of_withdrawal)
                                to
                                {{ \Illuminate\Support\Carbon::parse($form5Deliveries->end_of_withdrawal)->format('m/d/Y') }}
                            @endif
                        </td>

                        <td>
                            {{ $form5Deliveries->trader }}
                        </td>


                        @foreach($usedSugarClassesArray as $class)

                            {{-- NORMAL PREVIOUS SUGAR CLASS --}}
                            @if(
                                $form5Deliveries->sugar_class == $class &&
                                !($class == 'B' && $form5Deliveries->refining == 1)
                            )

                                <td class="text-right">

                                    @php($previousTotals[$class] += $form5Deliveries->qty_prev)

                                    {{ number_format($form5Deliveries->qty_prev, 4) }}

                                </td>

                            @else

                                <td></td>

                            @endif


                            {{-- B-REFINING --}}
                            @if($class == 'B')

                                @if(
                                    $form5Deliveries->sugar_class == 'B' &&
                                    $form5Deliveries->refining == 1
                                )

                                    <td class="text-right">

                                        @php($previousRefiningTotals['B'] += $form5Deliveries->qty_prev)

                                        {{ number_format($form5Deliveries->qty_prev, 4) }}

                                    </td>

                                @else

                                    <td></td>

                                @endif

                            @endif

                        @endforeach


                        <td>
{{--                            {{ ($form5Deliveries->refining == 1) ? 'For Refining' : '' }}--}}
                            {{ $form5Deliveries->remarks }}
                        </td>

                    </tr>

                @endif

            @endforeach

        @endif


        {{-- ===================================================== --}}
        {{-- PREVIOUS TOTALS --}}
        {{-- ===================================================== --}}

        <tr>
            <td colspan="3"></td>

            @foreach($usedSugarClassesArray as $class)

                {{-- Normal Previous Total --}}
                <td class="text-right">
                    <strong>
                        {{ number_format($previousTotals[$class], 4) }}
                    </strong>
                </td>

                {{-- B-Refining Previous Total --}}
                @if($class == 'B')

                    <td class="text-right">
                        <strong>
                            {{ number_format($previousRefiningTotals['B'], 4) }}
                        </strong>
                    </td>

                @endif

            @endforeach

            <td></td>
        </tr>


        {{-- ===================================================== --}}
        {{-- OVERALL TOTAL --}}
        {{-- ===================================================== --}}

        <tr style="font-weight: bold; border-top: 2px solid #000;">

            <td colspan="3">
                <strong>OVERALL TOTAL</strong>
            </td>

            @foreach($usedSugarClassesArray as $class)

                {{-- Normal Overall Total --}}
                <td class="text-right">
                    <strong>
                        {{ number_format(
                            $totals[$class] + $previousTotals[$class],
                            4
                        ) }}
                    </strong>
                </td>

                {{-- B-Refining Overall Total --}}
                @if($class == 'B')

                    <td class="text-right">
                        <strong>
                            {{ number_format(
                                $refiningTotals['B'] + $previousRefiningTotals['B'],
                                4
                            ) }}
                        </strong>
                    </td>

                @endif

            @endforeach

            <td></td>

        </tr>

        </tbody>
    </table>

{{--    NEW DELIVERIES END--}}



    <br>
    <p class="text-left">C. Served SRO <small><i>(To be transmitted to SRA with Permit Portion, Ledger of Withdrawals & Listing*)</i></small></p>
    <table  class="table-bordered details-top-right-table" style="width: 100%">
        <thead>
        <tr>
            <th>SRO No. </th>
            <th>CEAs, COCs, Letter Authority, etc. </th>
            <th>Permit Portion No. of Pcs.</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($wr->form5ServedSros))
            @foreach($wr->form5ServedSros as $form5ServedSros)
                <tr>
                    <td>{{$form5ServedSros->sro_no}}</td>
                    <td>{{$form5ServedSros->cea}}</td>
                    <td>{{$form5ServedSros->permit_portion}}</td>
                </tr>
            @endforeach
        @endif
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
                <u>{{$signatories['form5']['sign1']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form5']['sign2']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form5']['sign3']['name'] ?? null}}</u>
            </td>
        </tr>
        <tr >
            <td>
                {{$signatories['form5']['sign1']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form5']['sign2']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form5']['sign3']['position'] ?? null}}
            </td>
        </tr>
    </table>
</div>