<div class="form-title" style="background-color: #4477a3;">
    <h4> MOLASSES RELEASE ORDER AND DELIVERY REPORT
    </h4>
</div>

@php
    $totals = [
        'issuanceTotal' => 0,
        'withdrawalsTotal' => 0,
        'qtyStandard' => 0,
        'qtyPremium' => 0,
    ];
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                    <p class="no-margin">Issuances of MRO <small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>

                <div class="box-body" style="">
                    <button type="button" data-target="#add_form3b_issuances_modal" data-toggle="modal" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add Issuances</button>
                    <br>
                    <br>
                    <table style="width: 100%;" class="table table-condensed table-bordered" id="form3b_issuance_table">
                        <thead>
                        <tr>
                            <th>Date of Issue</th>
                            <th>MRO No.</th>
                            <th>Trader/Owner</th>
                            <th>Liens OR</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total:</strong></td>
                            <td id="totalMROQty" class="text-right"><strong>0.000</strong></td>
                            <td colspan="1"></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{--<div class="row">--}}
{{--    <div class="col-md-12">--}}
{{--        <div class="panel">--}}
{{--            <div class="box box-sm box-default box-solid">--}}
{{--                <div class="box-header with-border"  style="background-color: #4e984a;color: white;">--}}
{{--                    <p class="no-margin">Delivery<small id="filter-notifier" class="label bg-blue blink"></small></p>--}}
{{--                </div>--}}

{{--                <div class="box-body" style="">--}}
{{--                    <button type="button" data-target="#add_form3b_deliveries_modal" data-toggle="modal" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add Delivery</button>--}}
{{--                    <br>--}}
{{--                    <br>--}}
{{--                    <table style="width: 100%;" class="table table-condensed table-bordered" id="form3b_deliveries_table">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Date of Withdrawal</th>--}}
{{--                            <th>MRO No.</th>--}}
{{--                            <th>Trader/Owner</th>--}}
{{--                            <th>Qty</th>--}}
{{--                            <th>Remarks</th>--}}
{{--                            <th>Action</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}

{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #4e984a;color: white;">
                    <p class="no-margin">Delivery<small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>

                <div class="box-body" style="">
                    <button type="button" data-target="#add_form3b_deliveries_modal" data-toggle="modal" class="btn btn-success btn-sm pull-right">
                        <i class="fa fa-plus"></i> Add Delivery
                    </button>
                    <br><br>

                    <table style="width: 100%;" class="table table-condensed table-bordered" id="form3b_deliveries_table">
                        <thead>
                        <tr>
                            <th>Date of Withdrawal</th>
                            <th>MRO No.</th>
                            <th>Trader/Owner</th>
                            <th>Qty</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Data Rows will be inserted here dynamically -->
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total:</strong></td>
                            <td id="totalQty" class="text-right"><strong>0.000</strong></td>
                            <td colspan="2"></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #ac7123;color: white;">
                    <p class="no-margin">Served MRO<small id="filter-notifier" class="label bg-blue blink"></small></p>
                </div>

                <div class="box-body" style="">
                    <button type="button" data-target="#add_form3b_servedSros_modal" data-toggle="modal" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add Served MRO</button>
                    <br>
                    <br>
                    <table style="width: 100%;" class="table table-condensed table-bordered" id="form3b_servedSros_table">
                        <thead>
                        <tr>
                            <th>Ref. SRO SN.</th>
                            <th>Trader/Tollee</th>
                            <th>No. of Pcs of Storage Cert.</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>