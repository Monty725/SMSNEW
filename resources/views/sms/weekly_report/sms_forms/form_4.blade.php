

<div class="form-title" style="background-color: #6c565a;">
    <h4>  MILLSITE & SUBSIDIARY WAREHOUSE INVENTORY REPORT - RAW
    </h4>
</div>
<form id="form4">
    <button type="submit" hidden>submit</button>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th>Current Crop</th>
            <th>Previous Crop</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="3" class="text-strong info">MILL WAREHOUSE</td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.1 Production/Carry-over</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('carryOver',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt',
                    'id' => 'carryOver'
                ],
                $wr->form4->carryOver ?? null
                ) !!}
            </td>
{{--            <td></td>--}}
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_carryOver',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt',
                     'id' => 'prev_carryOver'
                ],
                $wr->form4->prev_carryOver ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.2 Receipts from other Mill</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('receipts',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt',
                     'id' => 'receipts'
                ],
                $wr->form4->receipts ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_receipts',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt',
                     'id' => 'prev_receipts'
                ],
                $wr->form4->prev_receipts ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.3 Withdrawals</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('withdrawals',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt',
                    'id' => 'withdrawals'
                ],
                $wr->form4->withdrawals ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_withdrawals',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt',
                    'id' => 'prev_withdrawals'
                ],
                $wr->form4->prev_withdrawals ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.4 Transfers to Refinery</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('transferToRefinery',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt',
                    'id' => 'transferToRefinery'
                ],
                $wr->form4->transferToRefinery ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_transferToRefinery',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt',
                    'id' => 'prev_transferToRefinery'
                ],
                $wr->form4->prev_transferToRefinery ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.5 Transfers to Subsidiary</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('transferToSubsidiary',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt',
                    'id' => 'transferToSubsidiary'
                ],
                $wr->form4->transferToSubsidiary ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_transferToSubsidiary',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt',
                    'id' => 'prev_transferToSubsidiary'
                ],
                $wr->form4->prev_transferToSubsidiary ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.6 Return to Millsite (from Subsidiary Warehouse)</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('transferFromSubsidiary',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt',
                    'id' => 'transferFromSubsidiary'
                ],
                $wr->form4->transferFromSubsidiary ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_transferFromSubsidiary',[
                    'class' => 'global-form-changer input-sm text-right autonumber_mt',
                    'id' => 'prev_transferFromSubsidiary'
                ],
                $wr->form4->prev_transferFromSubsidiary ?? null
                ) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.7 Stock Balance</td>
            <td class="text-right text-strong">
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('stockBalance',[
                    'class' => 'input-sm text-right',
                    'id' => 'stockBalance',
                    'readonly' => 'readonly'
                ], null) !!}
            <td class="text-right text-strong">
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_stockBalance',[
                    'class' => 'input-sm text-right',
                    'id' => 'prev_stockBalance',
                    'readonly' => 'readonly'
                ], null) !!}
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-strong success">
                SUBSIDIARY WAREHOUSES
                <button class="btn btn-xs btn-success pull-right form4_listOfWarehousesBtn" for="RAW" data-toggle="modal" data-target="#form4_listOfWarehousesModal"><i class="fa fa-list"></i> List of Subsidiary Warehouses</button>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.1 Carry Over
                <button class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="carryOver" sugarType="RAW" before="form4CarryOverTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['RAW']['carryOver']))
            @foreach($subsidiaries['RAW']['carryOver'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'carryOver',
                    'data' => $raw,
                    'sugarType' => 'RAW',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif

        <tr for="carryOver" class="computation form4CarryOverTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>


        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.2 Receipts
                <button class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="receipts"  sugarType="RAW" before="form4ReceiptsTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['RAW']['receipts']))
            @foreach($subsidiaries['RAW']['receipts'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'receipts',
                    'data' => $raw,
                    'sugarType' => 'RAW',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif


        <tr for="receipts" class="computation form4ReceiptsTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>

        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.3 Withdrawals
                <button class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="withdrawals" sugarType="RAW"  before="form4WithdrawalsTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['RAW']['withdrawals']))
            @foreach($subsidiaries['RAW']['withdrawals'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'withdrawals',
                    'data' => $raw,
                    'sugarType' => 'RAW',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif


        <tr for="withdrawals" class="computation form4WithdrawalsTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>

        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.4 Transfer To Millsite
                <button class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="transferToMillsite" sugarType="RAW" before="form4TransferToMillsite"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['RAW']['transferToMillsite']))
            @foreach($subsidiaries['RAW']['transferToMillsite'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'transferToMillsite',
                    'data' => $raw,
                    'sugarType' => 'RAW',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif

        <tr for="transferToMillsite" class="computation form4TransferToMillsite">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>

        </tbody>
    </table>
</form>

<script>
    function calculateStockBalance() {

        let carryOver = parseFloat($('#carryOver').val().replace(/,/g,'')) || 0;
        let receipts = parseFloat($('#receipts').val().replace(/,/g,'')) || 0;
        let withdrawals = parseFloat($('#withdrawals').val().replace(/,/g,'')) || 0;
        let transferToRefinery = parseFloat($('#transferToRefinery').val().replace(/,/g,'')) || 0;
        let transferToSubsidiary = parseFloat($('#transferToSubsidiary').val().replace(/,/g,'')) || 0;
        let transferFromSubsidiary = parseFloat($('#transferFromSubsidiary').val().replace(/,/g,'')) || 0;

        let prev_carryOver = parseFloat($('#prev_carryOver').val().replace(/,/g,'')) || 0;
        let prev_receipts = parseFloat($('#prev_receipts').val().replace(/,/g,'')) || 0;
        let prev_withdrawals = parseFloat($('#prev_withdrawals').val().replace(/,/g,'')) || 0;
        let prev_transferToRefinery = parseFloat($('#prev_transferToRefinery').val().replace(/,/g,'')) || 0;
        let prev_transferToSubsidiary = parseFloat($('#prev_transferToSubsidiary').val().replace(/,/g,'')) || 0;
        let prev_transferFromSubsidiary = parseFloat($('#prev_transferFromSubsidiary').val().replace(/,/g,'')) || 0;

        // Adjust signs if needed
        let total = carryOver
            + receipts
            + transferFromSubsidiary
            - withdrawals
            - transferToRefinery
            - transferToSubsidiary;

        let prev_total = prev_carryOver
            + prev_receipts
            + prev_transferFromSubsidiary
            - prev_withdrawals
            - prev_transferToRefinery
            - prev_transferToSubsidiary;

        $('#stockBalance').val(total.toFixed(4));
        $('#prev_stockBalance').val(prev_total.toFixed(4));
    }

    // Trigger when any input changes
    $('.global-form-changer').on('keyup change', function () {
        calculateStockBalance();
    });

    // Run once on page load
    $(document).ready(function () {
        calculateStockBalance();
    });
</script>