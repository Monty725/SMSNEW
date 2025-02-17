<div id="form5a" style="break-after: page">
    @include('sms.printables.forms.header',['formName' => 'SMS Form No. 6A'])

    <h4 class="no-margin"><b>QUEDAN REGISTRY</b> </h4>
    <p class="no-margin"><i>(Report on Raw Sugar Receipts, Refined Sugar Due and Refined Sugar Quedan Issuances)</i></p>

    <p class="text-left">A. Raw Sugar Receipts</p>

    <table class="table-bordered" style="width: 100%">
        <thead>
        <tr>
            <th rowspan="2">Delivery No.</th>
            <th rowspan="2">Trader/Tollee</th>
            <th colspan="4" class="text-center">RAW SUGAR RECEIPTS</th>
            <th rowspan="2">Refined Sugar Eq.</th>
        </tr>
        <tr>
            <th class="text-center">Source</th>
            <th class="text-center">Raw SRO #</th>
            <th class="text-center">SRA Liens OR #</th>
            <th class="text-center">Qty LKG</th>
        </tr>
        </thead>
        <tbody>
            @if(!empty($wr->form5aIssuancesOfSro))
                @php
                    $rawTotal = 0;
                    $refinedTotal = 0;
                @endphp
                @foreach($wr->form5aIssuancesOfSro as $data)
                    @php
                        $rawTotal = $rawTotal + $data->raw_qty + $data->prev_raw_qty;
                        $refinedTotal = $refinedTotal + $data->refined_qty + $data->prev_refined_qty;
                    @endphp
                    <tr>
                        <td>{{$data->delivery_no}}</td>
                        <td>{{$data->trader}}</td>
                        <td>{{$data->mill_source}}</td>
                        <td class="text-center">{{$data->raw_sro_no}}</td>
                        <td>{{$data->liens_or}}</td>
                        <td class="text-right">{{($data->raw_qty != null ? number_format($data->raw_qty,3) : number_format($data->prev_raw_qty,3) )}}</td>
                        <td class="text-right">{{($data->refined_qty != null ? number_format($data->refined_qty,3) : number_format($data->prev_refined_qty,3) )}}</td>
                    </tr>
                @endforeach
                <tr >
                    <td colspan="5" class="text-strong">TOTAL</td>
                    <td class="text-right text-strong">{{number_format($rawTotal,2)}}</td>
                    <td class="text-right text-strong">{{number_format($refinedTotal,2)}}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <br>
    <p class="text-left">B. Quedan Registry</p>

{{--    <table class="table-bordered" style="width: 100%">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>Ref SRO No.</th>--}}
{{--            <th>Trader/Tollee</th>--}}
{{--            <th>Refined Quedan SN.</th>--}}
{{--            <th>Refined Sugar (Lkg)</th>--}}
{{--        </tr>--}}
{{--            @if(!empty($wr->form5aIssuancesOfSro))--}}
{{--                @php--}}
{{--                    $refinedTotal = 0;--}}
{{--                @endphp--}}
{{--                @foreach($wr->form5aIssuancesOfSro as $data)--}}
{{--                    @php--}}
{{--                        $refinedTotal = $refinedTotal + $data->refined_qty + $data->prev_refined_qty;--}}
{{--                    @endphp--}}
{{--                    <tr>--}}
{{--                        <td>{{$data->sro_no}}</td>--}}
{{--                        <td>{{$data->trader}}</td>--}}
{{--                        <td>{{$data->rsq_no}}</td>--}}
{{--                        <td class="text-right">{{($data->refined_qty != null ? number_format($data->refined_qty,3) : number_format($data->prev_refined_qty,3) )}}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                <tr >--}}
{{--                    <td colspan="3" class="text-strong">TOTAL</td>--}}
{{--                    <td class="text-right text-strong">{{number_format($refinedTotal,2)}}</td>--}}
{{--                </tr>--}}
{{--            @endif--}}
{{--        </thead>--}}
{{--    </table>--}}

{{--    DRY RUN NEW UI LOUIS FORM 6a--}}
    <table class="table-bordered" style="width: 100%">
        <thead>
        <tr>
            <th>Ref SRO No.</th>
            <th>Trader/Tollee</th>
            <th>Refined Quedan SN.</th>
            <th>Refined Sugar (Lkg)</th>
        </tr>
        @if(!empty($wr->form5aIssuancesOfSro))
            @php
                $refinedTotal = 0;
            @endphp
            <tr>
                <td colspan="4"><strong>Current crop</strong></td>
            </tr>
            @foreach($wr->form5aIssuancesOfSro as $data)
                @php
                    $refinedTotal = $refinedTotal + $data->refined_qty + $data->prev_refined_qty;
                @endphp
                @if($data->refined_qty != null && $data->refined_qty != 0)
                    <tr>
                        <td>{{$data->sro_no}}</td>
                        <td>{{$data->trader}}</td>
                        <td>{{$data->rsq_no}}</td>
                        <td class="text-right">{{number_format($data->refined_qty, 3)}}</td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td colspan="4"><strong>Previous crop</strong></td>
            </tr>

            {{-- Display rows with only prev_refined_qty --}}
            @foreach($wr->form5aIssuancesOfSro as $data)
                @if($data->prev_refined_qty != null && $data->prev_refined_qty != 0)
                    <tr>
                        <td>{{$data->sro_no}}</td>
                        <td>{{$data->trader}}</td>
                        <td>{{$data->rsq_no}}</td>
                        <td class="text-right">{{number_format($data->prev_refined_qty, 3)}}</td>
                    </tr>
                @endif
            @endforeach
            <tr >
                <td colspan="3" class="text-strong">TOTAL</td>
                <td class="text-right text-strong">{{number_format($refinedTotal,2)}}</td>
            </tr>
        @endif
        </thead>
    </table>

    <table class="sign-table cols-3">
        <tr>
            <td>Certified:</td>
            <td>Verified:</td>
        </tr>

        <tr >
            <td>
                <u>{{$signatories['form6a']['sign1']['name'] ?? null}}</u>
            </td>
            <td>
                <u>{{$signatories['form6a']['sign2']['name'] ?? null}}</u>
            </td>

        </tr>
        <tr >
            <td>
                {{$signatories['form6a']['sign1']['position'] ?? null}}
            </td>
            <td>
                {{$signatories['form6a']['sign2']['position'] ?? null}}
            </td>
        </tr>
    </table>
</div>