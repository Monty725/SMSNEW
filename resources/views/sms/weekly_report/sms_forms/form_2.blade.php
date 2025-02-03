<div class="form-title" style="background-color: #4e984a;">
    <h4>  WEEKLY REPORT ON REFINED SUGAR
    </h4>
</div>
<form id="form2">
    <button type="submit" hidden>SUBMIT</button>

{{--    LOUIS 1-24-2024 FORM 2 UI OLD--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <table class="table table-bordered preview-table" id="form2PreviewTable" style="transition: background-color 0.2s linear;">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th></th>--}}
{{--                    <th>Current Crop</th>--}}
{{--                    <th>Previous Crop</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                <tr>--}}
{{--                    <td colspan="3" class="text-center text-strong success">RAW SUGAR</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td class="text-strong">1. CARRY-OVER</td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('carryOver',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->carryOver ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_carryOver',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_carryOver ?? null) !!}--}}
{{--                    </td>--}}
{{--                </tr>--}}

{{--                <tr>--}}
{{--                    <td class="text-strong" colspan="3">2. RECEIPTS (For Refining)</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td colspan="3"><span class="indent"></span> 2.1 From Raw Mill</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td><span class="indent"></span><span class="indent"></span>2.1.1 Covered by SRO</td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('coveredBySro',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->coveredBySro ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_coveredBySro',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_coveredBySro ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td><span class="indent"></span><span class="indent"></span>2.1.2 Not Covered by SRO</td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('notCoveredBySro',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->notCoveredBySro ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_notCoveredBySro',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_notCoveredBySro ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                </tr>--}}

{{--                <tr>--}}
{{--                    <td><span class="indent"></span>2.2 Other Mills</td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('otherMills',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->otherMills ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_otherMills',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_otherMills ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                </tr>--}}

{{--                <tr>--}}
{{--                    <td><span class="indent"></span>2.3 Imported</td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('imported',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->imported ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_imported',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_imported ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr for="totalReceipts" class="computation">--}}
{{--                    <td class="text-right">TOTAL RECEIPTS</td>--}}
{{--                    <td class="text-right text-strong"></td>--}}
{{--                    <td class="text-right text-strong"></td>--}}
{{--                </tr>--}}

{{--                <tr>--}}
{{--                    <td class="text-strong">3. MELTED</td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('melted',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->melted ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_melted',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_melted ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td class="text-strong">4. WITHDRAWALS</td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('rawWithdrawals',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->rawWithdrawals ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_rawWithdrawals',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_rawWithdrawals ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                </tr>--}}

{{--                <tr for="rawBalance" class="computation">--}}
{{--                    <td class="text-strong">5. BALANCE RAW</td>--}}
{{--                    <td class="text-right text-strong"></td>--}}
{{--                    <td class="text-right text-strong"></td>--}}
{{--                </tr>--}}


{{--                <tr>--}}
{{--                    <td colspan="3" class="text-center text-strong info">REFINED SUGAR</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td class="text-strong" colspan="2">6. PRODUCTION/CARRY-OVER</td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_refinedCarryOver',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg',--}}
{{--                            'placeholder' => 'CARRY OVER, PREVIOUS CROP',--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_refinedCarryOver ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td class="text-strong"><span class="indent"></span> 6.1. DOMESTIC </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prodDomestic',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->prodDomestic ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_prodDomestic',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_prodDomestic ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td class="text-strong"><span class="indent"></span> 6.2. IMPORTED </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prodImported',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->prodImported ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_prodImported',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_prodImported ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}

{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td class="text-strong"><span class="indent"></span> 6.3. OVERAGES </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('overage',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->overage ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_overage',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_overage ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}

{{--                </tr>--}}
{{--                <tr for="totalRefined" class="computation">--}}
{{--                    <td class="text-strong text-right"> <i>TOTAL REFINED</i> </td>--}}
{{--                    <td class="text-right text-strong">0</td>--}}
{{--                    <td class="text-right text-strong">0</td>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td class="text-strong"><span class="indent"></span> 6.4. RETURN TO PROCESS </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prodReturn',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->prodReturn ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_prodReturn',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_lkg'--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_prodReturn ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                <tr for="totalProduction" class="computation">--}}
{{--                    <td class="text-strong text-right"> PRODUCTION NET </td>--}}
{{--                    <td class="text-right text-strong">0</td>--}}
{{--                    <td class="text-right text-strong">0</td>--}}
{{--                </tr>--}}

{{--                <tr>--}}
{{--                    <td class="text-strong" colspan="3">7. ISSUANCES</td>--}}
{{--                </tr>--}}


{{--                <tr for="issuancesDomestic" class="computation">--}}
{{--                    <td class="text-strong"><span class="indent"></span>7.1 DOMESTIC </td>--}}
{{--                    <td class="text-right"></td>--}}
{{--                    <td class="text-right"></td>--}}
{{--                </tr>--}}

{{--                <tr for="issuancesImported" class="computation">--}}
{{--                    <td class="text-strong"><span class="indent"></span>7.2 IMPORTED </td>--}}
{{--                    <td class="text-right"></td>--}}
{{--                    <td class="text-right"></td>--}}
{{--                </tr>--}}

{{--                <tr>--}}
{{--                    <td class="text-strong" colspan="3">8. WITHDRAWALS</td>--}}
{{--                </tr>--}}

{{--                <tr for="withdrawalsDomestic" class="computation">--}}
{{--                    <td class="text-strong"><span class="indent"></span>8.1 DOMESTIC </td>--}}
{{--                    <td class="text-right"></td>--}}
{{--                    <td class="text-right"></td>--}}
{{--                </tr>--}}

{{--                <tr for="withdrawalsImported" class="computation">--}}
{{--                    <td class="text-strong"><span class="indent"></span>8.2 IMPORTED </td>--}}
{{--                    <td class="text-right"></td>--}}
{{--                    <td class="text-right"></td>--}}
{{--                </tr>--}}

{{--                <tr for="stockBalance" class="computation">--}}
{{--                    <td class="text-strong">9. STOCK BALANCE </td>--}}
{{--                    <td class="text-right">0</td>--}}
{{--                    <td class="text-right">0</td>--}}
{{--                </tr>--}}
{{--                <tr  for="unquedanned" class="computation">--}}
{{--                    <td class="text-strong">10. UNQUEDANNED </td>--}}
{{--                    <td class="text-right">0</td>--}}
{{--                    <td class="text-right">0</td>--}}
{{--                </tr>--}}
{{--                <tr  for="stockOnHand" class="computation">--}}
{{--                    <td class="text-strong">11. STOCK ON HAND </td>--}}
{{--                    <td class="text-right">0</td>--}}
{{--                    <td class="text-right">0</td>--}}
{{--                </tr>--}}

{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}


    {{--    LOUIS 1-24-2024 FORM 2 UI NEW--}}
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered preview-table" id="form2PreviewTable" style="transition: background-color 0.2s linear;">
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
                <tr>
                    <td colspan="7" class="text-center text-strong success">RAW SUGAR</td>
                </tr>
                <tr>
                    <td class="text-strong">1. CARRY-OVER</td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('carryOver',[
                            'class' => 'form1-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->carryOver ?? null
                        ) !!}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('carryOver',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_mt',--}}
{{--                            'pattern' => '\d*',--}}
{{--                            'type' => 'number',--}}
{{--                            'step' => 'any',--}}
{{--                            'style' => '-moz-appearance:textfield; -webkit-appearance:none; appearance:none;'--}}
{{--                        ],--}}
{{--                        $wr->form2->carryOver ?? null--}}
{{--                        ) !!}--}}
                    </td>
                    <td class="text-strong text-right updatable" for="carryOver.currentCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="carryOver.currentCrop.toDate"></td>
                    <td>
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_carryOver',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_mt'--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_carryOver ?? null--}}
{{--                        ) !!}--}}
                    </td>
                    <td class="text-strong text-right updatable" for="carryOver.prevCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="carryOver.prevCrop.toDate"></td>
                </tr>

                <tr>
                    <td class="text-strong" colspan="7">2. RECEIPTS (For Refining)</td>
                </tr>
                <tr>
                    <td colspan="7"><span class="indent"></span> 2.1 From Raw Mill</td>
                </tr>
                <tr>
                    <td><span class="indent"></span><span class="indent"></span>2.1.1 Covered by SRO</td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('coveredBySro',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->coveredBySro ?? null
                        ) !!}
                    </td>
                    <td class="text-strong text-right updatable" for="coveredBySro.currentCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="coveredBySro.currentCrop.toDate"></td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_coveredBySro',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->prev_coveredBySro ?? null
                        ) !!}
                    </td>
                    <td class="text-strong text-right updatable" for="coveredBySro.prevCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="coveredBySro.prevCrop.toDate"></td>
                </tr>
                <tr>
                    <td><span class="indent"></span><span class="indent"></span>2.1.2 Not Covered by SRO</td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('notCoveredBySro',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->notCoveredBySro ?? null
                        ) !!}
                    </td>
                    <td class="text-strong text-right updatable" for="notCoveredBySro.currentCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="notCoveredBySro.currentCrop.toDate"></td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_notCoveredBySro',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->prev_notCoveredBySro ?? null
                        ) !!}
                    </td>
                    <td class="text-strong text-right updatable" for="notCoveredBySro.prevCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="notCoveredBySro.prevCrop.toDate"></td>
                </tr>

                <tr>
                    <td><span class="indent"></span>2.2 Other Mills</td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('otherMills',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->otherMills ?? null
                        ) !!}
                    </td>
                    <td class="text-strong text-right updatable" for="otherMills.currentCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="otherMills.currentCrop.toDate"></td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_otherMills',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->prev_otherMills ?? null
                        ) !!}
                    </td>
                    <td class="text-strong text-right updatable" for="otherMills.prevCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="otherMills.prevCrop.toDate"></td>
                </tr>

                <tr>
                    <td><span class="indent"></span>2.3 Imported</td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('imported',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->imported ?? null
                        ) !!}
                    </td>
                    <td class="text-strong text-right updatable" for="imported.currentCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="imported.currentCrop.toDate"></td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_imported',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->prev_imported ?? null
                        ) !!}
                    </td>
                    <td class="text-strong text-right updatable" for="imported.prevCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="imported.prevCrop.toDate"></td>
                </tr>
                <tr for="totalReceipts" class="computation">
                    <td class="text-right">TOTAL RECEIPTS</td>
                    <td class="text-strong text-right updatable" for="totalReceipt.currentCrop.thisWeek"></td>
                    <td class="text-strong text-right updatable" for="totalReceipt.currentCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="totalReceipt.currentCrop.toDate"></td>
                    <td class="text-strong text-right updatable" for="totalReceipt.prevCrop.thisWeek"></td>
                    <td class="text-strong text-right updatable" for="totalReceipt.prevCrop.prevWeek"></td>
                    <td class="text-strong text-right updatable" for="totalReceipt.prevCrop.toDate"></td>
                </tr>

                <tr>
                    <td class="text-strong">3. MELTED</td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('melted',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->melted ?? null
                        ) !!}
                    </td>
                    <td class="text-right updatable" for="melted.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="melted.currentCrop.toDate"></td>

{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_melted',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_mt'--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_melted ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}

                    <td class="text-right updatable" for="melted.prevCrop.thisWeek"></td>
                    <td class="text-right updatable" for="melted.prevCrop.prevWeek"></td>
                    <td class="text-right updatable" for="melted.prevCrop.toDate"></td>
                </tr>
                <tr>
                    <td class="text-strong">4. WITHDRAWALS</td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('rawWithdrawals',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->rawWithdrawals ?? null
                        ) !!}
                    </td>
                    <td class="text-right updatable" for="rawWithdrawals.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="rawWithdrawals.currentCrop.toDate"></td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_rawWithdrawals',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->prev_rawWithdrawals ?? null
                        ) !!}
                    </td>
                    <td class="text-right updatable" for="rawWithdrawals.prevCrop.prevWeek"></td>
                    <td class="text-right updatable" for="rawWithdrawals.prevCrop.toDate"></td>
                </tr>

                <tr for="rawBalance" class="computation">
                    <td class="text-strong">5. BALANCE RAW</td>
{{--                    <td class="text-right updatable" for="balanceRaw.currentCrop.thisWeek"></td>--}}
                    <td></td>
                    <td class="text-right updatable" for="balanceRaw.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="balanceRaw.currentCrop.toDate"></td>
{{--                    <td class="text-right updatable" for="balanceRaw.prevCrop.thisWeek"></td>--}}
                    <td></td>
                    <td class="text-right updatable" for="balanceRaw.prevCrop.prevWeek"></td>
                    <td class="text-right updatable" for="balanceRaw.prevCrop.toDate"></td>
                </tr>


                <tr>
                    <td colspan="7" class="text-center text-strong info">REFINED SUGAR</td>
                </tr>
                <tr>
                    <td class="text-strong" colspan="6">6. PRODUCTION/CARRY-OVER</td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_refinedCarryOver',[
                            'class' => 'form2-input input-sm text-right autonumber_mt',
                            'placeholder' => 'CARRY OVER, PREVIOUS CROP',
                        ],
                        $wr->form2->prev_refinedCarryOver ?? null
                        ) !!}
                    </td>
                </tr>
                <tr>
                    <td class="text-strong"><span class="indent"></span> 6.1. DOMESTIC </td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prodDomestic',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->prodDomestic ?? null
                        ) !!}
                    </td>
                    <td class="text-right updatable" for="prodDomestic.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="prodDomestic.currentCrop.toDate"></td>

                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_prodDomestic',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->prev_prodDomestic ?? null
                        ) !!}
                    </td>

{{--                    <td class="text-right updatable" for="prodDomestic.prevCrop.thisWeek"></td>--}}
                    <td class="text-right updatable" for="prodDomestic.prevCrop.prevWeek"></td>
                    <td class="text-right updatable" for="prodDomestic.prevCrop.toDate"></td>
                </tr>
                <tr>
                    <td class="text-strong"><span class="indent"></span> 6.2. IMPORTED </td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prodImported',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->prodImported ?? null
                        ) !!}
                    </td>
                    <td class="text-right updatable" for="prodImported.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="prodImported.currentCrop.toDate"></td>

                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_prodImported',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->prev_prodImported ?? null
                        ) !!}
                    </td>

{{--                    <td class="text-right updatable" for="prodImported.prevCrop.thisWeek"></td>--}}
                    <td class="text-right updatable" for="prodImported.prevCrop.prevWeek"></td>
                    <td class="text-right updatable" for="prodImported.prevCrop.toDate"></td>
                </tr>
                <tr>
                    <td class="text-strong"><span class="indent"></span> 6.3. OVERAGES </td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('overage',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->overage ?? null
                        ) !!}
                    </td>
                    <td class="text-right updatable" for="overage.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="overage.currentCrop.toDate"></td>

                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_overage',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->prev_overage ?? null
                        ) !!}
                    </td>

{{--                    <td class="text-right updatable" for="overage.prevCrop.thisWeek"></td>--}}
                    <td class="text-right updatable" for="overage.prevCrop.prevWeek"></td>
                    <td class="text-right updatable" for="overage.prevCrop.toDate"></td>
                </tr>
                <tr for="totalRefined" class="computation">
                    <td class="text-strong text-right"> <i>TOTAL REFINED</i> </td>
                    <td class="text-right updatable" for="totalRefined.currentCrop.thisWeek"></td>
                    <td class="text-right updatable" for="totalRefined.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="totalRefined.currentCrop.toDate"></td>
                    <td class="text-right updatable" for="totalRefined.prevCrop.thisWeek"></td>
                    <td class="text-right updatable" for="totalRefined.prevCrop.prevWeek"></td>
                    <td class="text-right updatable" for="totalRefined.prevCrop.toDate"></td>
                </tr>
                <tr>
                    <td class="text-strong"><span class="indent"></span> 6.4. RETURN TO PROCESS </td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prodReturn',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->prodReturn ?? null
                        ) !!}
                    </td>
                    <td class="text-right updatable" for="prodReturn.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="prodReturn.currentCrop.toDate"></td>
{{--                    <td>--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_prodReturn',[--}}
{{--                            'class' => 'form2-input input-sm text-right autonum_mt'--}}
{{--                        ],--}}
{{--                        $wr->form2->prev_prodReturn ?? null--}}
{{--                        ) !!}--}}
{{--                    </td>--}}
{{--                   <td class="text-right updatable" for="prodReturn.prevCrop.prevWeek"></td>--}}
{{--                   <td class="text-right updatable" for="prodReturn.prevCrop.toDate"></td>--}}
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr for="totalProduction" class="computation">
                    <td class="text-strong text-right"> PRODUCTION NET </td>
                    <td class="text-right updatable" for="prodNet.currentCrop.thisWeek"></td>
                    <td class="text-right updatable" for="prodNet.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="prodNet.currentCrop.toDate"></td>
{{--                    <td class="text-right updatable" for="prodNet.prevCrop.thisWeek"></td>--}}
{{--                    <td class="text-right updatable" for="prodNet.prevCrop.prevWeek"></td>--}}
{{--                    <td class="text-right updatable" for="prodNet.prevCrop.toDate"></td>--}}
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td class="text-strong" colspan="7">7. ISSUANCES</td>
                </tr>


                <tr for="issuancesDomestic" class="computation">
                    <td class="text-strong"><span class="indent"></span>7.1 DOMESTIC </td>
                    <td class="text-right updatable" for="totalIssuanceDomestic.currentCrop.thisWeek"></td>
                    <td class="text-right updatable" for="totalIssuanceDomestic.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="totalIssuanceDomestic.currentCrop.toDate"></td>
                    <td class="text-right updatable" for="totalIssuanceDomestic.prevCrop.thisWeek"></td>
                    <td class="text-right updatable" for="totalIssuanceDomestic.prevCrop.prevWeek"></td>
                    <td class="text-right updatable" for="totalIssuanceDomestic.prevCrop.toDate"></td>
                </tr>

                <tr for="totalIssuanceImported" class="computation">
                    <td class="text-strong"><span class="indent"></span>7.2 IMPORTED </td>
                    <td class="text-right updatable" for="totalIssuanceImported.currentCrop.thisWeek"></td>
                    <td class="text-right updatable" for="totalIssuanceImported.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="totalIssuanceImported.currentCrop.toDate"></td>
                    <td class="text-right updatable" for="totalIssuanceImported.prevCrop.thisWeek"></td>
                    <td class="text-right updatable" for="totalIssuanceImported.prevCrop.prevWeek"></td>
                    <td class="text-right updatable" for="totalIssuanceImported.prevCrop.toDate"></td>
                </tr>

                <tr>
                    <td class="text-strong" colspan="4">8. WITHDRAWALS</td>
                </tr>

                <tr for="withdrawalsDomestic" class="computation">
                    <td class="text-strong"><span class="indent"></span>8.1 DOMESTIC </td>
                    <td class="text-right updatable" for="totalWithdrawalDomestic.currentCrop.thisWeek"></td>
                    <td class="text-right updatable" for="totalWithdrawalDomestic.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="totalWithdrawalDomestic.currentCrop.toDate"></td>
                    <td class="text-right updatable" for="totalWithdrawalDomestic.prevCrop.thisWeek"></td>
                    <td class="text-right updatable" for="totalWithdrawalDomestic.prevCrop.prevWeek"></td>
                    <td class="text-right updatable" for="totalWithdrawalDomestic.prevCrop.toDate"></td>
                </tr>

                <tr for="withdrawalsImported" class="computation">
                    <td class="text-strong"><span class="indent"></span>8.2 IMPORTED </td>
                    <td class="text-right updatable" for="totalWithdrawalImported.currentCrop.thisWeek"></td>
                    <td class="text-right updatable" for="totalWithdrawalImported.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="totalWithdrawalImported.currentCrop.toDate"></td>
                    <td class="text-right updatable" for="totalWithdrawalImported.prevCrop.thisWeek"></td>
                    <td class="text-right updatable" for="totalWithdrawalImported.prevCrop.prevWeek"></td>
                    <td class="text-right updatable" for="totalWithdrawalImported.prevCrop.toDate"></td>
                </tr>

                <tr for="stockBalance" class="computation">
                    <td class="text-strong">9. STOCK BALANCE </td>
                    <td class="text-right updatable" for="stockBalance.currentCrop.thisWeek"></td>
                    <td class="text-right updatable" for="stockBalance.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="stockBalance.currentCrop.toDate"></td>
                    <td class="text-right updatable" for="stockBalance.prevCrop.thisWeek"></td>
                    <td class="text-right updatable" for="stockBalance.prevCrop.prevWeek"></td>
                    <td class="text-right updatable" for="stockBalance.prevCrop.toDate"></td>
                </tr>
                <tr  for="form2_unquedanned" class="computation">
                    <td class="text-strong">10. UNQUEDANNED </td>
                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('form2_unquedanned',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->form2_unquedanned ?? null
                        ) !!}
                    </td>
{{--                    <td class="text-right updatable" for="form2_unquedanned.currentCrop.thisWeek"></td>--}}
                    <td class="text-right updatable" for="form2_unquedanned.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="form2_unquedanned.currentCrop.toDate"></td>

                    <td>
                        {!! \App\Swep\ViewHelpers\__form2::textboxOnly('form2_prev_unquedanned',[
                            'class' => 'form2-input input-sm text-right autonumber_mt'
                        ],
                        $wr->form2->form2_prev_unquedanned ?? null
                        ) !!}
                    </td>
{{--                    <td class="text-right updatable" for="unquedanned.prevCrop.thisWeek"></td>--}}
                    <td class="text-right updatable" for="form2_unquedanned.prevCrop.prevWeek"></td>
                    <td class="text-right updatable" for="form2_unquedanned.prevCrop.toDate"></td>
                </tr>
                <tr  for="stockOnHand" class="computation">
                    <td class="text-strong">11. STOCK ON HAND </td>
                    <td class="text-right updatable" for="stockOnHand.currentCrop.thisWeek"></td>
                    <td class="text-right updatable" for="stockOnHand.currentCrop.prevWeek"></td>
                    <td class="text-right updatable" for="stockOnHand.currentCrop.toDate"></td>
                    <td class="text-right updatable" for="stockOnHand.prevCrop.thisWeek"></td>
                    <td class="text-right updatable" for="stockOnHand.prevCrop.prevWeek"></td>
                    <td class="text-right updatable" for="stockOnHand.prevCrop.toDate"></td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>

{{--    <div class="subform-container" hidden>--}}
{{--        <h4>Raw Sugar</h4>--}}
{{--        <div class="subform-body">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="panel">--}}
{{--                        <div class="box box-sm box-default box-solid">--}}
{{--                            <div class="box-header with-border"  style="background-color: #987e4a;color: white;">--}}
{{--                                <p class="no-margin">1. Carry Over <small id="filter-notifier" class="label bg-blue blink"></small></p>--}}
{{--                            </div>--}}
{{--                            <div class="box-body" style="">--}}
{{--                                <table class="table table-bordered table-condensed sms_form2_table">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th></th>--}}
{{--                                        <th>Current Crop</th>--}}
{{--                                        <th>Previous Crop</th>--}}
{{--                                        <th>Action</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>Carry-over</td>--}}
{{--                                        <td>--}}
{{--                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current][carryOver]',[--}}
{{--                                                'class' => 'autonumber_mt',--}}
{{--                                                'autocomplete' => 'off',--}}
{{--                                                'container_class' => 'data_form2_current_carryOver',--}}
{{--                                            ],--}}
{{--                                            (isset($details_arr['form2']['carryOver'])) ? $details_arr['form2']['carryOver']->current_value : null--}}
{{--                                            ) !!}--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev][carryOver]',[--}}
{{--                                                'class' => 'autonumber_mt',--}}
{{--                                                'autocomplete' => 'off',--}}
{{--                                                'container_class' => 'data_form2_prev_carryOver',--}}
{{--                                            ],--}}
{{--                                            (isset($details_arr['form2']['carryOver'])) ? $details_arr['form2']['carryOver']->prev_value : null--}}
{{--                                            ) !!}--}}
{{--                                        </td>--}}
{{--                                        <td></td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-12">--}}
{{--                    <div class="panel">--}}
{{--                        <div class="box box-sm box-default box-solid">--}}
{{--                            <div class="box-header with-border"  style="background-color: #987e4a;color: white;">--}}
{{--                                <p class="no-margin">2. Receipts: (For Refining)<small id="filter-notifier" class="label bg-blue blink"></small></p>--}}
{{--                            </div>--}}
{{--                            <div class="box-body" style="">--}}
{{--                                <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1;font-size: 16px; font-weight: bold; margin-left: 20px">--}}
{{--                                    2.1 From Raw Mill--}}
{{--                                </p>--}}
{{--                                <table class="table table-bordered table-condensed sms_form2_table" style="margin-left: 20px">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th></th>--}}
{{--                                        <th>Current Crop</th>--}}
{{--                                        <th>Previous Crop</th>--}}
{{--                                        <th>Action</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>Covered by SRO</td>--}}
{{--                                        <td>--}}
{{--                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current][rawMillCoveredBySro]',[--}}
{{--                                                'class' => 'autonumber_mt',--}}
{{--                                                'autocomplete' => 'off',--}}
{{--                                                'container_class' => 'data_form2_current_rawMillCoveredBySro',--}}
{{--                                            ],--}}
{{--                                            (isset($details_arr['form2']['rawMillCoveredBySro'])) ? $details_arr['form2']['rawMillCoveredBySro']->current_value : null--}}
{{--                                            ) !!}--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev][rawMillCoveredBySro]',[--}}
{{--                                                'class' => 'autonumber_mt',--}}
{{--                                                'autocomplete' => 'off',--}}
{{--                                                'container_class' => 'data_form2_prev_rawMillNotCoveredBySro',--}}
{{--                                            ],--}}
{{--                                            (isset($details_arr['form2']['rawMillCoveredBySro'])) ? $details_arr['form2']['rawMillCoveredBySro']->prev_value : null--}}
{{--                                            ) !!}--}}
{{--                                        </td>--}}
{{--                                        <td></td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>Not Covered by SRO</td>--}}
{{--                                        <td>--}}
{{--                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current][rawMillNotCoveredBySro]',[--}}
{{--                                                'class' => 'autonumber_mt',--}}
{{--                                                'autocomplete' => 'off',--}}
{{--                                                'container_class' => 'data_form2_current_manufactured',--}}
{{--                                            ],--}}
{{--                                            (isset($details_arr['form2']['rawMillNotCoveredBySro'])) ? $details_arr['form2']['rawMillNotCoveredBySro']->current_value : null--}}
{{--                                            ) !!}--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev][rawMillNotCoveredBySro]',[--}}
{{--                                                'class' => 'autonumber_mt',--}}
{{--                                                'autocomplete' => 'off',--}}
{{--                                                'container_class' => 'data_form2_prev_manufactured',--}}
{{--                                            ],--}}
{{--                                            (isset($details_arr['form2']['rawMillNotCoveredBySro'])) ? $details_arr['form2']['rawMillNotCoveredBySro']->prev_value : null--}}
{{--                                            ) !!}--}}
{{--                                        </td>--}}
{{--                                        <td></td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                                <table class="table table-bordered table-condensed sms_form2_table">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th></th>--}}
{{--                                        <th>Current Crop</th>--}}
{{--                                        <th>Previous Crop</th>--}}
{{--                                        <th>Action</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>Other Mills</td>--}}
{{--                                        <td>--}}
{{--                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current][otherMills]',[--}}
{{--                                                'class' => 'autonumber_mt',--}}
{{--                                                'autocomplete' => 'off',--}}
{{--                                                'container_class' => 'data_form2_current_otherMills',--}}
{{--                                            ],--}}
{{--                                            (isset($details_arr['form2']['otherMills'])) ? $details_arr['form2']['otherMills']->current_value : null--}}
{{--                                            ) !!}--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev][otherMills]',[--}}
{{--                                                'class' => 'autonumber_mt',--}}
{{--                                                'autocomplete' => 'off',--}}
{{--                                                'container_class' => 'data_form2_prev_otherMills',--}}
{{--                                            ],--}}
{{--                                            (isset($details_arr['form2']['otherMills'])) ? $details_arr['form2']['otherMills']->prev_value : null--}}
{{--                                            ) !!}--}}
{{--                                        </td>--}}
{{--                                        <td></td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>Imported</td>--}}
{{--                                        <td>--}}
{{--                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current][imported]',[--}}
{{--                                                'class' => 'autonumber_mt',--}}
{{--                                                'autocomplete' => 'off',--}}
{{--                                                'container_class' => 'data_form2_current_imported',--}}
{{--                                            ],--}}
{{--                                            (isset($details_arr['form2']['imported'])) ? $details_arr['form2']['imported']->current_value : null--}}
{{--                                            ) !!}--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev][imported]',[--}}
{{--                                                'class' => 'autonumber_mt',--}}
{{--                                                'autocomplete' => 'off',--}}
{{--                                                'container_class' => 'data_form2_prev_imported',--}}
{{--                                            ],--}}
{{--                                            (isset($details_arr['form2']['imported'])) ? $details_arr['form2']['imported']->prev_value : null--}}
{{--                                            ) !!}--}}
{{--                                        </td>--}}
{{--                                        <td></td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


{{--                </div>--}}

{{--                @php--}}
{{--                    $inputFields = new \App\Models\SMS\InputFields;--}}
{{--                    $fn = $inputFields->getFields('refined_sugar_345')--}}
{{--                @endphp--}}
{{--                @foreach($fn as $f)--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="panel">--}}
{{--                            <div class="box box-sm box-default box-solid">--}}
{{--                                <div class="box-header with-border"  style="background-color: #987e4a;color: white;">--}}
{{--                                    <p class="no-margin">{{$f->prefix}} {{$f->display_name}}<small id="filter-notifier" class="label bg-blue blink"></small></p>--}}
{{--                                </div>--}}
{{--                                <div class="box-body" style="">--}}
{{--                                    <table class="table table-bordered table-condensed sms_form2_table">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th></th>--}}
{{--                                            <th>Current Crop</th>--}}
{{--                                            <th>Previous Crop</th>--}}
{{--                                            <th>Action</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$f->display_name}}</td>--}}
{{--                                            <td>--}}
{{--                                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current]['.$f->field.']',[--}}
{{--                                                    'class' => 'text-right autonumber_mt',--}}
{{--                                                    'container_class' => 'data_form2_current_'.$f->field,--}}
{{--                                                ],--}}
{{--                                                (isset($details_arr['form2'][$f->field])) ? $details_arr['form2'][$f->field]->current_value : null--}}
{{--                                                ) !!}--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev]['.$f->field.']',[--}}
{{--                                                    'class' => 'text-right autonumber_mt',--}}
{{--                                                    'container_class' => 'data_form2_prev_'.$f->field,--}}
{{--                                                ],--}}
{{--                                                (isset($details_arr['form2'][$f->field])) ? $details_arr['form2'][$f->field]->prev_value : null--}}
{{--                                                ) !!}--}}
{{--                                            </td>--}}
{{--                                            <td></td>--}}
{{--                                        </tr>--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--    <div class="subform-container" hidden>--}}
{{--        <h4>Refined Sugar</h4>--}}
{{--        <div class="subform-body">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="panel">--}}
{{--                        <div class="box box-sm box-default box-solid">--}}
{{--                            <div class="box-header with-border"  style="background-color: #4e984a;color: white;">--}}
{{--                                <p class="no-margin">Summary--}}
{{--                                    <small id="filter-notifier" class="label bg-blue blink"></small>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <div class="box-body" style="">--}}
{{--    --}}{{--                            @include('sms.weekly_report.previews.form2')--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--                <div class="col-md-12">--}}
{{--                    @php--}}
{{--                        $a = 'refinedSugarProduction';--}}
{{--                    @endphp--}}
{{--                    <div class="panel">--}}
{{--                        <div class="box box-sm box-default box-solid">--}}
{{--                            <div class="box-header with-border"  style="background-color: #4e984a;color: white;">--}}
{{--                                <p class="no-margin">6. Production/Carry-over--}}
{{--                                    <small id="filter-notifier" class="label bg-blue blink"></small>--}}
{{--                                    <button class="btn btn-xs pull-right btn-success add_btn"  style="background-color: #e3e3e3" data="form2_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <div class="box-body" style="">--}}
{{--                                <table class="table table-bordered table-condensed sms_form2_table table_dynamic" id="form2_{{$a}}">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th></th>--}}
{{--                                        <th>Current Crop</th>--}}
{{--                                        <th>Previous Crop</th>--}}
{{--                                        <th>Action</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @if( isset($details_arr['form2'][$a]) && count($details_arr['form2'][$a]) > 0)--}}
{{--                                        @foreach($details_arr['form2'][$a] as $$a)--}}
{{--                                            @include('sms.dynamic_rows.form2_'.$a,['item'=>$$a])--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-12">--}}
{{--                    <div class="panel">--}}
{{--                        <div class="box box-sm box-default box-solid">--}}
{{--                            <div class="box-header with-border"  style="background-color: #4e984a;color: white;">--}}
{{--                                <p class="no-margin">7. Issuances--}}
{{--                                    <small id="filter-notifier" class="label bg-blue blink"></small>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <div class="box-body" style="">--}}
{{--                                <table class="table table-bordered table-condensed sms_form2_table">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th></th>--}}
{{--                                        <th>Current Crop</th>--}}
{{--                                        <th>Previous Crop</th>--}}
{{--                                        <th>Action</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>Issuances</td>--}}
{{--                                        <td>--}}
{{--                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current][issuances]',[--}}
{{--                                                'class' => 'autonumber_mt',--}}
{{--                                                'autocomplete' => 'off',--}}
{{--                                                'container_class' => 'data_form2_current_issuances',--}}
{{--                                            ],--}}
{{--                                            (isset($details_arr['form2']['issuances'])) ? $details_arr['form2']['issuances']->current_value : null--}}
{{--                                            ) !!}--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev][issuances]',[--}}
{{--                                                'class' => 'autonumber_mt',--}}
{{--                                                'autocomplete' => 'off',--}}
{{--                                                'container_class' => 'data_form2_prev_issuances',--}}
{{--                                            ],--}}
{{--                                            (isset($details_arr['form2']['issuances'])) ? $details_arr['form2']['issuances']->prev_value : null--}}
{{--                                            ) !!}--}}
{{--                                        </td>--}}
{{--                                        <td></td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


{{--                </div>--}}

{{--                <div class="col-md-12">--}}
{{--                    @php--}}
{{--                        $a = 'refinedSugarWithdrawals';--}}
{{--                    @endphp--}}
{{--                    <div class="panel">--}}
{{--                        <div class="box box-sm box-default box-solid">--}}
{{--                            <div class="box-header with-border"  style="background-color: #4e984a;color: white;">--}}
{{--                                <p class="no-margin">8. Withdrawals--}}
{{--                                    <small id="filter-notifier" class="label bg-blue blink"></small>--}}
{{--                                    <button class="btn btn-xs pull-right btn-success add_btn" style="background-color: #e3e3e3" data="form2_{{$a}}" type="button"><i class="fa fa-plus"></i> ADD</button>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <div class="box-body" style="">--}}
{{--                                <table class="table table-bordered table-condensed sms_form2_table table_dynamic" id="form2_{{$a}}">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th></th>--}}
{{--                                        <th>Current Crop</th>--}}
{{--                                        <th>Previous Crop</th>--}}
{{--                                        <th>Action</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @if( isset($details_arr['form2'][$a]) && count($details_arr['form2'][$a]) > 0)--}}
{{--                                        @foreach($details_arr['form2'][$a] as $$a)--}}
{{--                                            @include('sms.dynamic_rows.form2_'.$a,['item'=>$$a])--}}
{{--                                        @endforeach--}}
{{--                                    @else--}}
{{--                                        @include('sms.dynamic_rows.form2_'.$a)--}}
{{--                                    @endif--}}

{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--                @php--}}
{{--                    $fn = $inputFields->getFields('refined_sugar_9_to_11')--}}
{{--                @endphp--}}
{{--                @foreach($fn as $f)--}}

{{--                        <div class="col-md-12">--}}
{{--                            <div class="panel">--}}
{{--                                <div class="box box-sm box-default box-solid">--}}
{{--                                    <div class="box-header with-border"  style="background-color: #4e984a;color: white;">--}}
{{--                                        <p class="no-margin">{{$f->prefix}} {{$f->display_name}}--}}
{{--                                            <small id="filter-notifier" class="label bg-blue blink"></small>--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                    <div class="box-body" style="">--}}
{{--                                        <table class="table table-bordered table-condensed sms_form2_table">--}}
{{--                                            <thead>--}}
{{--                                            <tr>--}}
{{--                                                <th></th>--}}
{{--                                                <th>Current Crop</th>--}}
{{--                                                <th>Previous Crop</th>--}}
{{--                                                <th>Action</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            <tr>--}}
{{--                                                <td>{{$f->display_name}}</td>--}}
{{--                                                <td>--}}
{{--                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][current]['.$f->field.']',[--}}
{{--                                                        'class' => 'text-right autonumber_mt',--}}
{{--                                                        'container_class' => 'data_form2_current_'.$f->field,--}}
{{--                                                    ],--}}
{{--                                                (isset($details_arr['form2'][$f->field])) ? $details_arr['form2'][$f->field]->current_value : null--}}
{{--                                                ) !!}--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    {!! \App\Swep\ViewHelpers\__form2::textboxOnly('data[form2][prev]['.$f->field.']',[--}}
{{--                                                        'class' => 'text-right autonumber_mt',--}}
{{--                                                        'container_class' => 'data_form2_prev_'.$f->field,--}}
{{--                                                    ],--}}
{{--                                                (isset($details_arr['form2'][$f->field])) ? $details_arr['form2'][$f->field]->prev_value : null--}}
{{--                                                ) !!}--}}
{{--                                                </td>--}}
{{--                                                <td></td>--}}
{{--                                            </tr>--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="row">
        <div class="col-md-12">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                    <p class="no-margin">
                        12. Quedan Issuances Series & No. of PCS.
                        <small id="filter-notifier" class="label bg-blue blink"></small>
                        <button class="btn btn-xs pull-right btn-success add_seriesNos_btn" for="REFINED" style="background-color: #e3e3e3" data="form2SeriesNos" type="button"><i class="fa fa-plus"></i> ADD</button>
                    </p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed sms_form1_table table_dynamic" id="form2SeriesNos">
                        <thead>
                        <tr>
                            <th>Sugar Class</th>
                            <th>Series From</th>
                            <th>Series To</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(!empty($seriesNos['REFINED']))
                            @foreach($seriesNos['REFINED'] as $seriesNo)
                                @include('sms.dynamic_rows.insertSeriesNos',[
                                    'for' => 'REFINED',
                                    'seriesNo' => $seriesNo,
                                ])
                            @endforeach
                        @else
                            @include('sms.dynamic_rows.insertSeriesNos',[
                                    'for' => 'REFINED',
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
                            'class' => 'form2-input',
                            'container_class' => 'remarks',
                        ],
                        $wr->form2->remarks ?? null
                        ) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


</form>