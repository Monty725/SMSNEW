<div class="form-title" style="background-color: #5aa7b3;">
    <h4> MILLSITE AND SUBSIDIARY TANKS INVENTORY REPORT - MOLASSES
    </h4>
</div>


<form id="form3a">
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
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('carryOver',[--}}
{{--                    'class' => 'global-form-changer global-form-changer form3a-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3a->carryOver ?? null--}}
{{--                ) !!}--}}
{{--            </td>--}}
            <td></td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_carryOver',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt',
                    'id' => 'prev_carryOver3a'
                ],
                $wr->form3a->prev_carryOver ?? null) !!}
            </td>
        </tr>
{{--        NEW ROWS 13-10-2025 LOUIS--}}
        <tr>
            <td><span class="indent"></span> 1.2 Net Production</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('netProd',[
                    'class' => 'global-form-changer global-form-changer form3a-input input-sm text-right autonumber_mt',
                    'id' => 'netProd3a'
                ],
                $wr->form3a->netProd ?? null
                ) !!}
            </td>
            <td></td>
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_netProd',[--}}
{{--                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3a->prev_netProd ?? null) !!}--}}
{{--            </td>--}}
        </tr>
        <tr>
            <td><span class="indent"></span> 1.3 Retention, Adjustment, Overages,etc.</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('rao',[
                    'class' => 'global-form-changer global-form-changer form3a-input input-sm text-right autonumber_mt',
                    'id' => 'rao3a'
                ],
                $wr->form3a->rao ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_rao',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt',
                    'id' => 'prev_rao3a'
                ],
                $wr->form3a->prev_rao ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.4 Receipts</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('receipts',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt',
                    'id' => 'receipts3a'
                ],
                $wr->form3a->receipts ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_receipts',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt',
                    'id' => 'prev_receipts3a'
                ],
                $wr->form3a->prev_receipts ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.5 Withdrawals</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('withdrawals',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt',
                    'id' => 'withdrawals3a'
                ],
                $wr->form3a->withdrawals ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_withdrawals',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt',
                    'id' => 'prev_withdrawals3a'
                ],
                $wr->form3a->prev_withdrawals ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.6 Transfers to Subsidiary</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('transferToRefinery',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt',
                    'id' => 'transferToRefinery3a'
                ],
                $wr->form3a->transferToRefinery ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_transferToRefinery',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt',
                    'id' => 'prev_transferToRefinery3a'
                ],
                $wr->form3a->prev_transferToRefinery ?? null) !!}
            </td>
        </tr>
        <tr>
            <td><span class="indent"></span> 1.7 Return to Millsite (from Subsidiary Warehouse)</td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('transferFromSubsidiary',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt',
                    'id' => 'transferFromSubsidiary3a'
                ],
                $wr->form3a->transferFromSubsidiary ?? null
                ) !!}
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_transferFromSubsidiary',[
                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt',
                    'id' => 'prev_transferFromSubsidiary3a'
                ],
                $wr->form3a->prev_transferFromSubsidiary ?? null) !!}
            </td>
        </tr>
{{--        <tr>--}}
{{--            <td><span class="indent"></span> 1.5 Etc</td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('etc',[--}}
{{--                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3a->etc ?? null--}}
{{--                ) !!}--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_etc',[--}}
{{--                    'class' => 'global-form-changer form3a-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3a->prev_etc ?? null) !!}--}}
{{--            </td>--}}
{{--        </tr>--}}
        <tr>
            <td><span class="indent"></span> 1.8 Stock Balance</td>
            <td class="text-right text-strong">
            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('stockBalance',[
                'class' => 'input-sm text-right',
                'id' => 'stockBalance3a',
                'readonly' => 'readonly'
            ], null) !!}
            <td class="text-right text-strong">
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_stockBalance',[
                    'class' => 'input-sm text-right',
                    'id' => 'prev_stockBalance3a',
                    'readonly' => 'readonly'
                ], null) !!}
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-strong success">
                SUBSIDIARY TANKS
                <button type="button" class="btn btn-xs btn-success pull-right form4_listOfWarehousesBtn" for="MOLASSES" data-toggle="modal" data-target="#form4_listOfWarehousesModal"><i class="fa fa-list"></i> List of Subsidiary Tanks</button>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.1 Carry Over
                <button type="button" class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="carryOver" sugarType="MOLASSES" before="form3aCarryOverTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['MOLASSES']['carryOver']))
            @foreach($subsidiaries['MOLASSES']['carryOver'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'carryOver',
                    'data' => $raw,
                    'sugarType' => 'MOLASSES',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif

        <tr for="carryOver" class="computation form3aCarryOverTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>

        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.2 Retention, Adjustment, Overages, Etc.
                <button type="button" class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="rao"  sugarType="MOLASSES" before="form3aRaoTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['MOLASSES']['rao']))
            @foreach($subsidiaries['MOLASSES']['rao'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'rao',
                    'data' => $raw,
                    'sugarType' => 'MOLASSES',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif


        <tr for="rao" class="computation form3aRaoTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>

        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.3 Receipts
                <button type="button" class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="receipts"  sugarType="MOLASSES" before="form3aReceiptsTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['MOLASSES']['receipts']))
            @foreach($subsidiaries['MOLASSES']['receipts'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'receipts',
                    'data' => $raw,
                    'sugarType' => 'MOLASSES',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif


        <tr for="receipts" class="computation form3aReceiptsTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>

        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.4 Withdrawals
                <button type="button" class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="withdrawals" sugarType="MOLASSES"  before="form3aWithdrawalsTotal"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['MOLASSES']['withdrawals']))
            @foreach($subsidiaries['MOLASSES']['withdrawals'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'withdrawals',
                    'data' => $raw,
                    'sugarType' => 'MOLASSES',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif


        <tr for="withdrawals" class="computation form3aWithdrawalsTotal">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>

        <tr>
            <td colspan="3">
                <span class="indent"></span> 2.5 Transfer To Millsite
                <button type="button" class="btn btn-xs btn-default pull-right insertWarehouseBtn" transactionType="transferToMillsite" sugarType="MOLASSES"  before="form3aTransferToMillsite"><i class="fa fa-plus"></i> Add</button>
            </td>
        </tr>
        @if(!empty($subsidiaries['MOLASSES']['transferToMillsite']))
            @foreach($subsidiaries['MOLASSES']['transferToMillsite'] as $key => $raw)
                @include('sms.dynamic_rows.form4InsertWarehouse',[
                    'transactionType' => 'transferToMillsite',
                    'data' => $raw,
                    'sugarType' => 'MOLASSES',
                    'defaultWarehouse' => $raw,
                ])
            @endforeach
        @endif


        <tr for="transferToMillsite" class="computation form3aTransferToMillsite">
            <td class="text-strong text-right"> TOTAL</td>
            <td class="text-right text-strong"></td>
            <td class="text-right text-strong"></td>
        </tr>
        </tbody>
    </table>

    
</form>

<script>
    function calculateStockBalance3a() {

        // let carryOver4a = parseFloat($('#carryOver4a').val().replace(/,/g,'')) || 0;
        let netProd3a = parseFloat($('#netProd3a').val().replace(/,/g,'')) || 0;
        let rao3a = parseFloat($('#rao3a').val().replace(/,/g,'')) || 0;
        let receipts3a = parseFloat($('#receipts3a').val().replace(/,/g,'')) || 0;
        let withdrawals3a = parseFloat($('#withdrawals3a').val().replace(/,/g,'')) || 0;
        let transferToRefinery3a = parseFloat($('#transferToRefinery3a').val().replace(/,/g,'')) || 0;
        let transferFromSubsidiary3a = parseFloat($('#transferFromSubsidiary3a').val().replace(/,/g,'')) || 0;

        let prev_carryOver3a = parseFloat($('#prev_carryOver3a').val().replace(/,/g,'')) || 0;
        let prev_rao3a = parseFloat($('#prev_rao3a').val().replace(/,/g,'')) || 0;
        let prev_receipts3a = parseFloat($('#prev_receipts3a').val().replace(/,/g,'')) || 0;
        let prev_withdrawals3a = parseFloat($('#prev_withdrawals3a').val().replace(/,/g,'')) || 0;
        let prev_transferToRefinery3a = parseFloat($('#prev_transferToRefinery3a').val().replace(/,/g,'')) || 0;
        let prev_transferFromSubsidiary3a = parseFloat($('#prev_transferFromSubsidiary3a').val().replace(/,/g,'')) || 0;

        // Adjust signs if needed
        let total3a = netProd3a
            + rao3a
            + receipts3a
            + transferFromSubsidiary3a
            - withdrawals3a
            - transferToRefinery3a

        let prev_total3a = prev_carryOver3a
            + prev_rao3a
            + prev_receipts3a
            + prev_transferFromSubsidiary3a
            - prev_withdrawals3a
            - prev_transferToRefinery3a

        $('#stockBalance3a').val(total3a.toFixed(4));
        $('#prev_stockBalance3a').val(prev_total3a.toFixed(4));
    }

    // Trigger when any input changes
    $('.global-form-changer').on('keyup change', function () {
        calculateStockBalance3a();
    });

    // Run once on page load
    $(document).ready(function () {
        calculateStockBalance3a();
    });
</script>


