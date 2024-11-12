<form id="form1">
    <button type="submit" hidden>Save as Draft</button>
    <div class="form-title" style="background-color: #4477a3;">
        <h4>  WEEKLY REPORT ON RAW SUGAR
        </h4>
    </div>

{{--    LOUIS 1-24-2024 FORM 1 UI OLD--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <table class="table table-bordered preview-table" id="form1PreviewTable" style="transition: background-color 0.2s linear;">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th></th>--}}
{{--                    <th>Current Crop</th>--}}
{{--                </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                        <th></th>--}}
{{--                        <th style="width: 200px;">This Week</th>--}}
{{--                        <th style="width: 200px;">Previous</th>--}}
{{--                        <th style="width: 200px;">To Date</th>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td class="text-strong">1. MANUFACTURED</td>--}}
{{--                        <td>--}}
{{--                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('manufactured',[--}}
{{--                                'class' => 'form1-input input-sm text-right autonumber_mt'--}}
{{--                            ],--}}
{{--                            $wr->form1->manufactured ?? null--}}
{{--                            ) !!}--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_manufactured',[--}}
{{--                                'class' => 'form1-input input-sm text-right autonumber_mt'--}}
{{--                            ],--}}
{{--                            $wr->form1->prev_manufactured ?? null) !!}--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr class="issuanceTr">--}}
{{--                        <td colspan="3" class="text-strong">--}}
{{--                            2. ISSUANCES/CARRY-OVER--}}
{{--                            <button class="btn btn-xs btn-success pull-right" id="addIssuanceButton" type="button"><i class="fa fa-plus"></i> ADD</button>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    @foreach(\App\Swep\Helpers\Arrays::sugarClasses() as $sugarClass)--}}
{{--                        @if(!empty($wr->form1->$sugarClass) || !empty($wr->form1->{'prev_'.$sugarClass}))--}}
{{--                            @include('sms.dynamic_rows.form1Issuances',[--}}
{{--                                'sugarClass' => $sugarClass,--}}
{{--                                'current' => $wr->form1->$sugarClass,--}}
{{--                                'prev' => $wr->form1->{'prev_'.$sugarClass},--}}
{{--                                ])--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                    <tr for="issuancesTotal" class="totalIssuanceTr computation">--}}
{{--                        <td class="text-strong text-right">--}}
{{--                            TOTAL--}}
{{--                        </td>--}}
{{--                        <td class="text-strong text-right"></td>--}}
{{--                        <td class="text-strong text-right"></td>--}}
{{--                    </tr>--}}

{{--                    <tr class="withdrawals">--}}
{{--                        <td colspan="3" class="text-strong">--}}
{{--                            3. WITHDRAWALS--}}
{{--                        </td>--}}
{{--                    </tr>--}}

{{--                    <tr for="withdrawalsTotal" class="computation">--}}
{{--                        <td class="text-strong text-right">--}}
{{--                            TOTAL--}}
{{--                        </td>--}}
{{--                        <td class="text-right text-strong"></td>--}}
{{--                        <td class="text-right text-strong"></td>--}}
{{--                    </tr>--}}

{{--                    <tr class="">--}}
{{--                        <td colspan="3" class="text-strong">--}}
{{--                            4. BALANCES--}}
{{--                        </td>--}}
{{--                    </tr>--}}

{{--                    <tr for="balancesTotal" class="computation">--}}
{{--                        <td class="text-strong text-right">--}}
{{--                            TOTAL--}}
{{--                        </td>--}}
{{--                        <td class="text-right text-strong"></td>--}}
{{--                        <td class="text-right text-strong"></td>--}}
{{--                    </tr>--}}


{{--                    <tr for="unquedanned" class="computation">--}}
{{--                        <td class="text-strong">--}}
{{--                            5. UNQUEDANNED--}}
{{--                        </td>--}}
{{--                        <td class="text-right"></td>--}}
{{--                        <td class="text-right"></td>--}}
{{--                    </tr>--}}
{{--                    <tr for="stockBalance" class="computation">--}}
{{--                        <td class="text-strong">--}}
{{--                            6. STOCK BALANCE--}}
{{--                        </td>--}}
{{--                        <td class="text-right"></td>--}}
{{--                        <td class="text-right"></td>--}}
{{--                    </tr>--}}

{{--                    <tr for="transfersToRefinery" class="computation">--}}
{{--                        <td class="text-strong">--}}
{{--                            7. TRANSFERS TO REFINERY--}}
{{--                        </td>--}}
{{--                        <td class="text-right"></td>--}}
{{--                        <td class="text-right"></td>--}}
{{--                    </tr>--}}
{{--                    <tr for="physicalStock" class="computation">--}}
{{--                        <td class="text-strong">--}}
{{--                            8. PHYSICAL STOCK--}}
{{--                        </td>--}}
{{--                        <td class="text-right"></td>--}}
{{--                        <td class="text-right"></td>--}}
{{--                    </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}

    {{--    LOUIS 1-24-2024 FORM 1 UI NEW--}}
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            updateForm1Data();
            updateForm2Data();
            updateForm3Data();
        });
    </script>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered preview-table" id="form1PreviewTable" style="transition: background-color 0.2s linear;">
                <thead>
                       <tr>
                           <th></th>
{{--                           <th>Current Crop</th>--}}
                           <td colspan="3" class="text-strong text-center">CURRENT CROP</td>
                           <td colspan="3" class="text-strong text-center">PREVIOUS CROP</td>
                       </tr>
                </thead>
                <tbody>
                <tr>
                    <th style="width: 200px;"></th>
                    <th style="width: 200px;">This Week</th>
                    <th style="width: 200px;">Previous</th>
                    <th style="width: 200px;">To Date</th>
                    <th style="width: 200px;">This Week</th>
                    <th style="width: 200px;">Previous</th>
                    <th style="width: 200px;">To Date</th>
                </tr>
                <tr class="manufactured_header">
                    <td class="text-strong">1. MANUFACTURED</td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('manufactured',[
                            'class' => 'form1-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form1->manufactured ?? null
                        ) !!}
                    </td>
                    {{--LOUIS 3-15-2024 To Date in Weekly Report Edit--}}
                    <td class="text-right updatable" for="manufactured.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="manufactured.currentCrop.toDate"></td>
                    <td>
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_manufactured',[--}}
{{--                            'class' => 'form1-input input-sm text-right autonumber_mt'--}}
{{--                        ],--}}
{{--                        $wr->form1->prev_manufactured ?? null--}}
{{--                        ) !!}--}}
                    </td>
                    <td> </td>
                    <td class="text-right updatable" for="manufactured.prevCrop.toDate"></td>
                </tr>
                <tr class="issuanceTr issuances_header">
                    <td colspan="7" class="text-strong">
                        2. ISSUANCES/CARRY-OVER
                        <button class="btn btn-xs btn-success pull-right" id="addIssuanceButton" type="button"><i class="fa fa-plus"></i> ADD</button>
                    </td>
                </tr>
                @foreach(\App\Swep\Helpers\Arrays::sugarClasses() as $sugarClass)
                    @if(!empty($wr->form1->$sugarClass) || !empty($wr->form1->{'prev_'.$sugarClass}))
                        @include('sms.dynamic_rows.form1Issuances',[
                            'sugarClass' => $sugarClass,
                            'current' => $wr->form1->$sugarClass,
                            'prev' => $wr->form1->{'prev_'.$sugarClass},
//                            'current_prevweek' => $wr->form1ToDateAsOf($wr->report_no-1)->$sugarClass,
//                            'prev' => $wr->form1ToDateAsOf($wr->report_no)->$sugarClass,
                            ])
                    @endif
                @endforeach
                <tr for="issuancesTotal" class="totalIssuanceTr computation">
                    <td class="text-strong text-right">
                        TOTAL
                    </td>
                    <td class="text-strong text-right updatable" for="totalIssuances.currentCrop.thisWeek"></td>
                    <td class="text-strong text-right updatable" for="totalIssuances.currentCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="totalIssuances.currentCrop.toDate"></td>
                    <td></td>
                    <td></td>
                    <td class="text-strong text-right updatable" for="totalIssuances.prevCrop.toDate"></td>
                </tr>

                <tr class="withdrawals">
                    <td colspan="7" class="text-strong">
                        3. WITHDRAWALS
                    </td>
                </tr>

                <tr class="withdrawals_header">
                    <td colspan="7"><span class="indent"></span> 3.1. Exports/Domestic/World</td>
                </tr>
                <tr for="withdrawalsTotal" class="computation">
                    <td class="text-strong text-right">
                        3.1 TOTAL
                    </td>
                    <td class="text-strong text-right updatable" for="totalWithdraw.currentCrop.thisWeek"></td>
                    <td class="text-strong text-right updatable" for="totalWithdraw.currentCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="totalWithdraw.currentCrop.toDate"></td>
                    <td class="text-strong text-right updatable" for="totalWithdraw.prevCrop.thisWeek"></td>
                    <td class="text-strong text-right updatable" for="totalWithdraw.prevCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="totalWithdraw.prevCrop.toDate"></td>
                </tr>

                <tr  class="withdrawals_for_refining_header">
                    <td colspan="7"><span class="indent"></span>3.2. For Refining:</td>
                </tr>
                <tr for="withdrawalsTotal" class="computation">
                    <td class="text-strong text-right">
                        3.2 TOTAL
                    </td>
                    <td class="text-strong text-right updatable" for="totalWithdrawRef.currentCrop.thisWeek"></td>
                    <td class="text-strong text-right updatable" for="totalWithdrawRef.currentCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="totalWithdrawRef.currentCrop.toDate"></td>
                    <td class="text-strong text-right updatable" for="totalWithdrawRef.prevCrop.thisWeek"></td>
                    <td class="text-strong text-right updatable" for="totalWithdrawRef.prevCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="totalWithdrawRef.prevCrop.toDate"></td>
                </tr>
                <tr for="withdrawalsTotal" class="computation">
                    <td class="text-strong text-right">
                        TOTAL WITHDRAWALS
                    </td>
                    <td class="text-strong text-right updatable" for="totalAllWithdraw.currentCrop.thisWeek"></td>
                    <td class="text-strong text-right updatable" for="totalAllWithdraw.currentCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="totalAllWithdraw.currentCrop.toDate"></td>
                    <td class="text-strong text-right updatable" for="totalAllWithdraw.prevCrop.thisWeek"></td>
                    <td class="text-strong text-right updatable" for="totalAllWithdraw.prevCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="totalAllWithdraw.prevCrop.toDate"></td>
                </tr>
                <tr class="balance_header">
                    <td colspan="7" class="text-strong">
                        4. BALANCES
                    </td>
                </tr>

                <tr for="balancesTotal" class="computation">
                    <td class="text-strong text-right">
                        TOTAL
                    </td>
                    <td></td>
                    <td class="text-right text-strong updatable" for="totalBalance.currentCrop.prevWeek"></td>
                    <td class="text-right text-strong updatable" for="totalBalance.currentCrop.toDate"></td>
                    <td></td>
                    <td class="text-strong text-right updatable" for="totalBalance.prevCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="totalBalance.prevCrop.toDate"></td>
                </tr>


                <tr for="unquedanned" class="computation">
                    <td class="text-strong">
                        5. UNQUEDANNED
                    </td>
                    <td class="text-right updatable" for="unquedanned.currentCrop.thisWeek"></td>
                    <td class="text-right updatable" for="unquedanned.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="unquedanned.currentCrop.toDate"></td>
                    <td class="text-strong text-right updatable" for="unquedanned.prevCrop.thisWeek"></td>
                    <td class="text-strong text-right updatable" for="unquedanned.prevCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="unquedanned.prevCrop.toDate"></td>
                </tr>
                <tr for="stockBalance" class="computation">
                    <td class="text-strong">
                        6. STOCK BALANCE
                    </td>
                    <td class="text-right updatable" for="stockBal.currentCrop.thisWeek"></td>
                    <td class="text-right updatable" for="stockBal.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="stockBal.currentCrop.toDate"></td>
                    <td class="text-strong text-right updatable" for="stockBal.prevCrop.thisWeek"></td>
                    <td class="text-strong text-right updatable" for="stockBal.prevCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="stockBal.prevCrop.toDate"></td>
                </tr>

                <tr for="transfersToRefinery" class="computation">
                    <td class="text-strong">
                        7. TRANSFERS TO REFINERY
                    </td>
                    <td class="text-right updatable" for="transfersToRef.currentCrop.thisWeek"></td>
                    <td class="text-right updatable" for="transfersToRef.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="transfersToRef.currentCrop.toDate"></td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_transfers_to_refinery',[
                            'class' => 'form1-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form1->prev_transfers_to_refinery ?? null
                        ) !!}
                    </td>
{{--                    <td class="text-strong text-right updatable" for="transfersToRef.prevCrop.thisWeek"></td>--}}
                    <td class="text-strong text-right updatable" for="transfersToRef.prevCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="transfersToRef.prevCrop.toDate"></td>
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('manufactured',[--}}
{{--                            'class' => 'form1-input input-sm text-right autonumber_mt'--}}
{{--                        ],--}}
{{--                        $wr->form1->manufactured ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                    <td class="text-right"></td>--}}
{{--                    <td class="text-right"></td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('manufactured',[--}}
{{--                            'class' => 'form1-input input-sm text-right autonumber_mt'--}}
{{--                        ],--}}
{{--                        $wr->form1->manufactured ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                    <td class="text-strong text-right"></td>--}}
{{--                    <td class="text-strong text-right"></td>--}}
                </tr>
                <tr for="physicalStock" class="computation">
                    <td class="text-strong">
                        8. PHYSICAL STOCK
                    </td>
                    <td class="text-right updatable" for="physicalStock.currentCrop.thisWeek"></td>
                    <td class="text-right updatable" for="physicalStock.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="physicalStock.currentCrop.toDate"></td>
                    <td class="text-strong text-right updatable" for="physicalStock.prevCrop.thisWeek"></td>
                    <td class="text-strong text-right updatable" for="physicalStock.prevCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="physicalStock.prevCrop.toDate"></td>

                    {{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('physicalStock',[--}}
{{--                            'class' => 'form1-input input-sm text-right autonumber_mt'--}}
{{--                        ],--}}
{{--                        $wr->form1->physicalStockPrev ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
                </tr>
                </tbody>
            </table>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="box box-sm box-default box-solid">
                            <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                                <p class="no-margin">
                                    Other Factory Statement Data
                                    <small id="filter-notifier" class="label bg-blue blink"></small>
                                </p>
                            </div>
                            <div class="box-body" style="">
                                <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                    <b>CANE</b>
                                    <span class="pull-right text-danger"><i class="fa fa-warning"></i> <b>Items 9-11: Units must be in METRIC TONS</b></span>
                                </p>

                                <div class="row">
                                    {!! \App\Swep\ViewHelpers\__form2::textbox('tdc',[
                                        'label' => "9. Tons Due Cane",
                                        'cols' => 4,
                                        'class' => 'form1-input text-right autonumber_mt',
                                        'container_class' => 'tdc',
                                    ],
                                    $wr->form1->tdc ?? null
                                    ) !!}
                                    {!! \App\Swep\ViewHelpers\__form2::textbox('gtcm',[
                                        'label' => "10. Gross Tons Cane Milled",
                                        'cols' => 4,
                                        'class' => 'form1-input text-right autonumber_mt',
                                        'container_class' => 'gtcm',
                                    ],
                                    $wr->form1->gtcm ?? null
                                    ) !!}
{{--                                    DRY RUN ADDITION--}}
                                    {!! \App\Swep\ViewHelpers\__form2::textbox('ntcm',[
                                        'label' => "10a. Net Tons Cane Milled",
                                        'cols' => 4,
                                        'class' => 'form1-input text-right autonumber_mt',
                                        'container_class' => 'ntcm',
                                    ],
                                    $wr->form1->ntcm ?? null
                                    ) !!}
                                </div>

                                <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                    <b>LKG/TC</b>
                                </p>

                                <div class="row">
                                    {!! \App\Swep\ViewHelpers\__form2::textbox('lkgtcGross',[
                                            'label' => "11A. LKG/TC Gross",
                                            'cols' => 4,
                                            'class' => 'form1-input text-right',
                                            'container_class' => 'lkgtc_gross',
                                            'readonly' => 'readonly',
                                        ],
                                        $wr->form1->lkgtc_gross ?? null
                                        ) !!}
{{--                                    DRY RUN ADDITION--}}
                                    {!! \App\Swep\ViewHelpers\__form2::textbox('lkgtcNet',[
                                        'label' => "11B. LKG/TC NET",
                                        'cols' => 4,
                                        'class' => 'form1-input text-right',
                                        'container_class' => 'lkgtc_net',
                                        'readonly' => 'readonly',
                                    ],
                                    $wr->form1->lkgtc_net ?? null
                                    ) !!}
                                </div>

                                @if($wr->sugarMill->syrup == 1)
                                    <p class="page-header-sm text-info" style="border-bottom: 1px solid #33a100">
                                        <b class="text-success">SYRUP</b>
                                        <span class="pull-right text-danger"><i class="fa fa-warning"></i> <b>Items 9-11: Units must be in METRIC TONS</b></span>
                                    </p>

                                    <div class="row">
                                        {!! \App\Swep\ViewHelpers\__form2::textbox('tds',[
                                            'label' => "9. Tons Due Syrup",
                                            'cols' => 4,
                                            'class' => 'form1-input text-right autonumber_mt',
                                            'container_class' => 'tds',
                                        ],
                                        $wr->form1->tds ?? null
                                        ) !!}
                                        {!! \App\Swep\ViewHelpers\__form2::textbox('egtcm',[
                                            'label' => "10. Equivalent Gross Tons Cane Milled",
                                            'cols' => 4,
                                            'class' => 'form1-input text-right autonumber_mt',
                                            'container_class' => 'egtcm',
                                        ],
                                        $wr->form1->egtcm ?? null
                                        ) !!}
                                        {!! \App\Swep\ViewHelpers\__form2::textbox('lkgtc_gross_syrup',[
                                            'label' => "11. LKG/TC Gross",
                                            'cols' => 4,
                                            'class' => 'form1-input text-right',
                                            'container_class' => 'lkgtc_gross_syrup',
                                            'readonly' => 'readonly',
                                        ],
                                        $wr->form1->lkgtc_gross_syrup ?? null
                                        ) !!}
                                    </div>
                                @endif


                                <p class="page-header-sm text-info" style="border-bottom: 1px solid #e0a800">
                                    <b class="text-warning">SHARE</b>
                                </p>
                                <div class="row">
                                    {!! \App\Swep\ViewHelpers\__form2::textbox('sharePlanter',[
                                       'label' => "12A. Planter's Share",
                                       'cols' => 4,
                                       'class' => 'form1-input text-right autonumber_mt',
                                       'container_class' => 'sharePlanter',
                                   ],
                                   $wr->form1->share_planter ?? null
                                   ) !!}
                                    {!! \App\Swep\ViewHelpers\__form2::textbox('shareMiller',[
                                        'label' => "12B. Miller's Share:",
                                        'cols' => 4,
                                        'class' => 'form1-input text-right autonumber_mt',
                                        'container_class' => 'shareMiller',
                                    ],
                                    $wr->form1->share_miller ?? null
                                    ) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    @php
                        $a = 'prices';
                    @endphp
                    <div class="panel">
                        <div class="box box-sm box-default box-solid">
                            <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                                <p class="no-margin">
                                    13. Mill District Price Monitoring
                                    <small id="filter-notifier" class="label bg-blue blink"></small>
                                </p>
                            </div>
                            <div class="box-body" style="">
                                <table class="table table-bordered table-condensed" id="form1_raw_sugar_{{$a}}">
                                    <thead>
                                    <tr>
                                        @foreach(\App\Swep\Helpers\Arrays::sugarClasses() as $sugarClass)
                                            <th class="text-center">{{$sugarClass}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        @foreach(\App\Swep\Helpers\Arrays::sugarClasses() as $sugarClass)
                                            <td>
                                                <div class="row">
                                                    @php
                                                        $col = 'price_'.$sugarClass;
                                                    @endphp
                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('price'.$sugarClass,[
                                                        'label' => "Peso / LKG",
                                                        'cols' => 12,
                                                        'class' => 'form1-input text-right autonumber',
                                                        'container_class' => 'price'.$sugarClass,
                                                    ],
                                                    $wr->form1->$col ?? null
                                                    ) !!}
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                                <br>
                                <table class="table table-bordered table-condensed sms_form1_table" id="">
                                    <thead>

                                    <tr>
                                        <th></th>
                                        <th>Wholesale</th>
                                        <th>Retail</th>
                                    </tr>

                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>RAW</td>
                                        <td>
                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('wholesaleRaw',[
                                                   'label' => "Wholesale raw price",
                                                   'cols' => 12,
                                                   'class' => 'form1-input text-right autonumber',
                                                   'container_class' => 'wholesaleRaw',
                                               ],
                                               $wr->form1->wholesale_raw ?? null
                                               ) !!}
                                        </td>
                                        <td>
                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('retailRaw',[
                                                   'label' => "Wholesale raw price",
                                                   'cols' => 12,
                                                   'class' => 'form1-input text-right autonumber',
                                                   'container_class' => 'retailRaw',
                                               ],
                                               $wr->form1->retail_raw ?? null
                                               ) !!}
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>REFINED</td>
                                        <td>
                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('wholesaleRefined',[
                                                   'label' => "Wholesale raw price",
                                                   'cols' => 12,
                                                   'class' => 'form1-input text-right autonumber',
                                                   'container_class' => 'wholesaleRefined',
                                               ],
                                               $wr->form1->wholesale_refined ?? null
                                               ) !!}
                                        </td>
                                        <td>
                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('retailRefined',[
                                                   'label' => "Wholesale raw price",
                                                   'cols' => 12,
                                                   'class' => 'form1-input text-right autonumber',
                                                   'container_class' => 'retailRefined',
                                               ],
                                               $wr->form1->retail_refined ?? null
                                               ) !!}
                                        </td>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                            <p class="no-margin">
                                14. Sugar Distribution Factor
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                            </p>
                        </div>
                        <div class="box-body" style="">
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('distFactor',[
                                'label' => "14. Distribution Factor:",
                                'cols' => 4,
                                'class' => 'form1-input text-right autonum_distFactor',
                                'container_class' => 'distFactor',
                                ],
                                $wr->form1->dist_factor ?? null
                                ) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                            <p class="no-margin">
                                15. Quedan Issuances Series & No. of PCS.
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                                <button class="btn btn-xs pull-right btn-success add_seriesNos_btn" for="RAW" style="background-color: #e3e3e3" data="form1SeriesNos" type="button"><i class="fa fa-plus"></i> ADD</button>
                            </p>
                        </div>
                        <div class="box-body" style="">
                            <table class="table table-bordered table-condensed sms_form1_table table_dynamic" id="form1SeriesNos">
                                <thead>
                                <tr>
                                    <th>Sugar Class</th>
                                    <th>Series From</th>
                                    <th>Series To</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($seriesNos['RAW']))
                                        @foreach($seriesNos['RAW'] as $seriesNo)
                                            @include('sms.dynamic_rows.insertSeriesNos',[
                                                'for' => 'RAW',
                                                'seriesNo' => $seriesNo,
                                            ])
                                        @endforeach
                                    @else
                                        @include('sms.dynamic_rows.insertSeriesNos',[
                                                'for' => 'RAW',
                                            ])
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                            <p class="no-margin">
                                Remarks
                                <small id="filter-notifier" class="label bg-blue blink"></small>
                            </p>
                        </div>
                        <div class="box-body" style="">
                            <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('remarks',[
                                    'label' => "Remarks:",
                                    'cols' => 12,
                                    'class' => 'form1-input',
                                    'container_class' => 'remarks',
                                ],
                                $wr->form1->remarks ?? null
                                ) !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>