<div class="form-title" style="background-color: #4477a3;">
    <h4> QUEDAN REGISTRY
    </h4>
</div>
<div class="row">

</div>

<h4 class="text-strong">A. Raw Sugar Receipts</h4>
<table class="table table-bordered table-condensed">
    <thead>
        <tr class="bg-primary">
            <th>Delivery No.</th>
            <th>Trader/Tollee</th>
            <th>Source</th>
            <th>Raw SRO #</th>
            <th>SRA Liens OR #</th>
            <th>Qty LKG</th>
            <th>Refined Sugar Eq.</th>
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
                    $rawTotal = $rawTotal + $data->raw_qty;
                    $refinedTotal = $refinedTotal + $data->refined_qty;
                @endphp
                <tr>
                    <td>{{$data->delivery_no}}</td>
                    <td>{{$data->trader}}</td>
                    <td>{{$data->mill_source}}</td>
                    <td>{{$data->sro_no}}</td>
                    <td>{{$data->liens_or}}</td>
                    <td class="text-right">{{number_format($data->raw_qty,2)}}</td>
                    <td class="text-right">{{number_format($data->refined_qty,2)}}</td>
                </tr>
            @endforeach
            <tr class="bg-info">
                <td colspan="5" class="text-strong">TOTAL</td>
                <td class="text-right text-strong">{{number_format($rawTotal,2)}}</td>
                <td class="text-right text-strong">{{number_format($refinedTotal,2)}}</td>
            </tr>
        @endif
    </tbody>
</table>


<h4 class="text-strong">B. Quedan Registry <button type="button" data-target="#add_form6a_issuances_modal" data-toggle="modal" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add Quedan Registry</button></h4>

{{--OLD TABLE FORM 6A QUEDAN REGISTRY--}}
{{--<table class="table table-bordered table-condensed">--}}
{{--    <thead>--}}
{{--    <tr class="bg-primary">--}}
{{--        <th>Refined SRO No.</th>--}}
{{--        <th>Trader/Tollee</th>--}}
{{--        <th>Refined Quedan SN.</th>--}}
{{--        <th>Current Refined Sugar (Lkg)</th>--}}
{{--        <th>Previous Refined Sugar (Lkg)</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @if(!empty($wr->form5aIssuancesOfSro))--}}
{{--        @php--}}
{{--            $refinedTotal = 0;--}}
{{--            $prev_refinedTotal = 0;--}}
{{--        @endphp--}}
{{--        @foreach($wr->form5aIssuancesOfSro as $data)--}}
{{--            @php--}}
{{--                $refinedTotal = $refinedTotal + $data->refined_qty;--}}
{{--                $prev_refinedTotal = $prev_refinedTotal + $data->prev_refined_qty;--}}
{{--            @endphp--}}
{{--            <tr>--}}
{{--                <td>{{$data->sro_no}}</td>--}}
{{--                <td>{{$data->trader}}</td>--}}
{{--                <td>{{$data->rsq_no}}</td>--}}
{{--                <td class="text-right">{{number_format($data->refined_qty,2)}}</td>--}}
{{--                <td class="text-right">{{number_format($data->prev_refined_qty,2)}}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        <tr class="bg-info">--}}
{{--            <td colspan="3" class="text-strong">TOTAL</td>--}}
{{--            <td class="text-right text-strong">{{number_format($refinedTotal,2)}}</td>--}}
{{--            <td class="text-right text-strong">{{number_format($prev_refinedTotal,2)}}</td>--}}
{{--        </tr>--}}
{{--    @endif--}}
{{--    </tbody>--}}
{{--</table>--}}

{{--NEW TABLE FORM 6A QUEDAN REGISTRY--}}
<table class="table table-bordered table-condensed">
    <thead>
    <tr class="bg-primary">
        <th>Refined SRO No.</th>
        <th>Trader/Tollee</th>
        <th>Refined Quedan SN.</th>
        <th>Current Refined Sugar (Lkg)</th>
        <th>Previous Refined Sugar (Lkg)</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($wr->form5aIssuancesOfSro))
        @php
            $refinedTotal = 0;
            $prev_refinedTotal = 0;
            $refinedDisplayed = false;
        @endphp
        @foreach($wr->form5aIssuancesOfSro as $data)
            @if($data->refined_qty > 0 && !$refinedDisplayed)
                @php $refinedDisplayed = true; @endphp
                <tr class="bg-success text-center">
                    <td colspan="5" class="text-strong">CURRENT CROP YEAR</td>
                </tr>
            @endif

            @if($data->refined_qty > 0)
                @php
                    $refinedTotal += $data->refined_qty;
                @endphp
                <tr>
                    <td>{{$data->sro_no}}</td>
                    <td>{{$data->trader}}</td>
                    <td>{{$data->rsq_no}}</td>
                    <td class="text-right">{{number_format($data->refined_qty,2)}}</td>
                    <td class="text-right"></td>
                </tr>
            @endif
        @endforeach

        <tr class="bg-info">
            <td colspan="3" class="text-strong">TOTAL REFINED</td>
            <td class="text-right text-strong">{{number_format($refinedTotal,2)}}</td>
            <td class="text-right"></td>
        </tr>

        <tr class="bg-warning text-center">
            <td colspan="5" class="text-strong">PREVIOUS CROP YEAR</td>
        </tr>

        @foreach($wr->form5aIssuancesOfSro as $data)
            @if($data->prev_refined_qty > 0)
                @php
                    $prev_refinedTotal += $data->prev_refined_qty;
                @endphp
                <tr>
                    <td>{{$data->sro_no}}</td>
                    <td>{{$data->trader}}</td>
                    <td>{{$data->rsq_no}}</td>
                    <td class="text-right"></td>
                    <td class="text-right">{{number_format($data->prev_refined_qty,2)}}</td>
                </tr>
            @endif
        @endforeach

        <tr class="bg-info">
            <td colspan="3" class="text-strong">TOTAL PREVIOUS REFINED</td>
            <td class="text-right"></td>
            <td class="text-right text-strong">{{number_format($prev_refinedTotal,2)}}</td>
        </tr>
    @endif
    </tbody>
</table>



