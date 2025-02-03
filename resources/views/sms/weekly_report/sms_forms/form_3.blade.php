<div class="form-title" style="background-color: #4e984a;">
    <h4>  WEEKLY REPORT ON MOLASSES
    </h4>
</div>
<form id="form3">
    <button type="submit" hidden>Submit</button>

{{--    LOUIS 1-31-2024 FORM 2 UI OLD--}}
{{--    <table class="table table-bordered preview-table" id="form3PreviewTable">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th></th>--}}
{{--            <th>Current Crop</th>--}}
{{--            <th>Previous Crop</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <td colspan="3" class="text-strong">1. PRODUCTION</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <span class="indent"> 1.1 Manufactued, Raw</span>--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('manufacturedRaw',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->manufacturedRaw ?? null--}}
{{--                ) !!}--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_manufacturedRaw',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->prev_manufacturedRaw ?? null) !!}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <span class="indent"> 1.2 Retention, Adj., Overages, etc.</span>--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('rao',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->rao ?? null--}}
{{--                ) !!}--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_rao',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->prev_rao ?? null) !!}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <span class="indent"> 1.3 Manufactued, Refined</span>--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('manufacturedRefined',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->manufacturedRefined ?? null--}}
{{--                ) !!}--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_manufacturedRefined',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->prev_manufacturedRefined ?? null) !!}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <span class="indent"> 1.4 Retention, Adj., Overages, etc. - Refined</span>--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('raoRefined',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->rao ?? null--}}
{{--                ) !!}--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_raoRefined',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->prev_rao ?? null) !!}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr class="computation" for="totalProduction">--}}
{{--            <td class="text-right text-strong">--}}
{{--                TOTAL--}}
{{--            </td>--}}
{{--            <td class="text-right text-strong"></td>--}}
{{--            <td class="text-right text-strong"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="3" class="text-strong">2. ISSUANCES/CARRY-OVER</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <span class="indent"> 2.1 Planter's Share</span>--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('sharePlanter',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->sharePlanter ?? null--}}
{{--                ) !!}--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_sharePlanter',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->prev_sharePlanter ?? null) !!}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <span class="indent"> 2.2 Mill Share</span>--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('shareMiller',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->shareMiller ?? null--}}
{{--                ) !!}--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_shareMiller',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->prev_shareMiller ?? null) !!}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td>--}}
{{--                <span class="indent"> 2.3 Refinery Molasses</span>--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('refineryMolasses',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->refineryMolasses ?? null--}}
{{--                ) !!}--}}
{{--            </td>--}}
{{--            <td>--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_refineryMolasses',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->prev_refineryMolasses ?? null) !!}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr class="computation" for="totalIssuances">--}}
{{--            <td class="text-right text-strong">--}}
{{--                TOTAL--}}
{{--            </td>--}}
{{--            <td class="text-strong text-right"></td>--}}
{{--            <td class="text-strong text-right"></td>--}}
{{--        </tr>--}}




{{--        <tr>--}}
{{--            <td colspan="3" class="text-strong">3. WITHDRAWALS</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="3" class="text-strong"><span class="indent"></span> RAW</td>--}}
{{--        </tr>--}}

{{--        <tr class="computation" for="totalWithdrawalsRaw">--}}
{{--            <td class="text-right">--}}
{{--                <i>TOTAL RAW</i>--}}
{{--            </td>--}}
{{--            <td class="text-right"></td>--}}
{{--            <td class="text-right"></td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="3" class="text-strong"><span class="indent"></span> REFINED</td>--}}
{{--        </tr>--}}

{{--        <tr class="computation" for="totalWithdrawalsRefined">--}}
{{--            <td class="text-right">--}}
{{--                <i>TOTAL REFINED</i>--}}
{{--            </td>--}}
{{--            <td class="text-right"></td>--}}
{{--            <td class="text-right"></td>--}}
{{--        </tr>--}}
{{--        <tr class="computation" for="totalWithdrawals">--}}
{{--            <td class="text-right text-strong">--}}
{{--                TOTAL WITHDRAWALS--}}
{{--            </td>--}}
{{--            <td class="text-right text-strong"></td>--}}
{{--            <td class="text-right text-strong"></td>--}}
{{--        </tr>--}}

{{--        <tr class="computation" for="notCoveredByMsc">--}}
{{--        <tr>--}}
{{--            <td class="text-strong">--}}
{{--                4. NOT COVERED BY MSC--}}
{{--            </td>--}}
{{--            <td class="text-strong text-right"></td>--}}
{{--            <td class="text-right except">--}}
{{--                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_notCoveredByMsc',[--}}
{{--                    'class' => 'form3-input input-sm text-right autonumber_mt'--}}
{{--                ],--}}
{{--                $wr->form3->prev_notCoveredByMsc ?? null) !!}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <td colspan="3" class="text-strong">5. BALANCE</td>--}}
{{--        </tr>--}}

{{--        <tr class="computation" for="balanceRaw">--}}
{{--            <td> <span class="indent"></span>--}}
{{--                5.1 Raw--}}
{{--            </td>--}}
{{--            <td class="text-right"></td>--}}
{{--            <td class="text-right"></td>--}}
{{--        </tr>--}}

{{--        <tr class="computation" for="balanceRefined">--}}
{{--            <td> <span class="indent"></span>--}}
{{--                5.2 Refined--}}
{{--            </td>--}}
{{--            <td class="text-right"></td>--}}
{{--            <td class="text-right"></td>--}}
{{--        </tr>--}}

{{--        <tr class="computation" for="totalBalance">--}}
{{--            <td class="text-right text-strong">--}}
{{--                TOTAL BALANCE--}}
{{--            </td>--}}
{{--            <td class="text-right text-strong"></td>--}}
{{--            <td class="text-right text-strong"></td>--}}
{{--        </tr>--}}

{{--        </tbody>--}}
{{--    </table>--}}


{{--    LOUIS 1-31-2024 FORM 2 UI NEW--}}
    <table class="table table-bordered preview-table" id="form3PreviewTable">
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
            <td colspan="4" class="text-strong">1. PRODUCTION</td>
        </tr>
        <tr>
            <td>
                <span class="indent"> 1.1 Manufactued, Raw</span>
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('manufacturedRaw',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->manufacturedRaw ?? null
                ) !!}
            </td>
            <td class="text-right updatable" for="manufacturedRaw.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="manufacturedRaw.currentCrop.toDate"></td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_manufacturedRaw',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_manufacturedRaw ?? null
                ) !!}
            </td>
            <td class="text-right updatable" for="manufacturedRaw.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="manufacturedRaw.prevCrop.toDate"></td>
        </tr>
        <tr>
            <td>
                <span class="indent"> 1.2 Retention, Adj., Overages, etc.</span>
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('rao',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->rao ?? null
                ) !!}
            </td>
            <td class="text-right updatable" for="rao.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="rao.currentCrop.toDate"></td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_rao',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_rao ?? null
                ) !!}
            </td>
            <td class="text-right updatable" for="rao.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="rao.prevCrop.toDate"></td>
        </tr>
        <tr>
            <td>
                <span class="indent"> 1.3 Manufactued, Refined</span>
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('manufacturedRefined',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->manufacturedRefined ?? null
                ) !!}
            </td>
            <td class="text-right updatable" for="manufacturedRefined.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="manufacturedRefined.currentCrop.toDate"></td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_manufacturedRefined',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_manufacturedRefined ?? null
                ) !!}
            </td>
            <td class="text-right updatable" for="manufacturedRefined.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="manufacturedRefined.prevCrop.toDate"></td>
        </tr>
        <tr>
            <td>
                <span class="indent"> 1.4 Retention, Adj., Overages, etc. - Refined</span>
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('raoRefined',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->raoRefined ?? null
                ) !!}
            </td>
            <td class="text-right updatable" for="raoRefined.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="raoRefined.currentCrop.toDate"></td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_raoRefined',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_raoRefined ?? null
                ) !!}
            </td>
            <td class="text-right updatable" for="raoRefined.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="raoRefined.prevCrop.toDate"></td>
        </tr>
        <tr class="computation" for="totalProduction">
            <td class="text-right text-strong">
                TOTAL
            </td>
            <td class="text-right updatable" for="totalProduction.currentCrop.thisWeek"></td>
            <td class="text-right updatable" for="totalProduction.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="totalProduction.currentCrop.toDate"></td>
            <td class="text-right updatable" for="totalProduction.prevCrop.thisWeek"></td>
            <td class="text-right updatable" for="totalProduction.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="totalProduction.prevCrop.toDate"></td>
        </tr>
        <tr>
            <td colspan="7" class="text-strong">2. ISSUANCES/CARRY-OVER</td>
        </tr>
        <tr>
            <td>
                <span class="indent"> 2.1 Planter's Share</span>
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('sharePlanter',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->sharePlanter ?? null
                ) !!}
            </td>
            <td class="text-right updatable" for="sharePlanter.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="sharePlanter.currentCrop.toDate"></td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_sharePlanter',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_sharePlanter ?? null
                ) !!}
            </td>
            <td class="text-right updatable" for="sharePlanter.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="sharePlanter.prevCrop.toDate"></td>
        </tr>
        <tr>
            <td>
                <span class="indent"> 2.2 Mill Share</span>
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('shareMiller',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->shareMiller ?? null
                ) !!}
            </td>
            <td class="text-right updatable" for="shareMiller.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="shareMiller.currentCrop.toDate"></td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_shareMiller',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_shareMiller ?? null
                ) !!}
            </td>
            <td class="text-right updatable" for="shareMiller.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="shareMiller.prevCrop.toDate"></td>
        </tr>
        <tr>
            <td>
                <span class="indent"> 2.3 Refinery Molasses</span>
            </td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('refineryMolasses',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->refineryMolasses ?? null
                ) !!}
            </td>
            <td class="text-right updatable" for="refineryMolasses.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="refineryMolasses.currentCrop.toDate"></td>
            <td>
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_refineryMolasses',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_refineryMolasses ?? null
                ) !!}
            </td>
            <td class="text-right updatable" for="refineryMolasses.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="refineryMolasses.prevCrop.toDate"></td>
        </tr>
        <tr class="computation" for="totalIssuances">
            <td class="text-right text-strong">
                TOTAL
            </td>
            <td class="text-right updatable" for="totalIssuance.currentCrop.thisWeek"></td>
            <td class="text-right updatable" for="totalIssuance.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="totalIssuance.currentCrop.toDate"></td>
            <td class="text-right updatable" for="totalIssuance.prevCrop.thisWeek"></td>
            <td class="text-right updatable" for="totalIssuance.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="totalIssuance.prevCrop.toDate"></td>
        </tr>




        <tr>
            <td colspan="7" class="text-strong">3. WITHDRAWALS</td>
        </tr>
        <tr>
            <td colspan="7" class="text-strong"><span class="indent"></span> RAW</td>
        </tr>

        <tr>
            <td> <span class="indent"></span>
                Distillery
            </td>
{{--            1-27-2025 REMOVED UPDATABLE TEMPORARILY LOUIS--}}
            <td class="text-right" for="withRawDistillery.currentCrop.thisWeek"></td>
            <td class="text-right" for="withRawDistillery.currentCrop.prevWeek"></td>
            <td class="text-right" for="withRawDistillery.currentCrop.toDate"></td>
            <td class="text-right" for="withRawDistillery.prevCrop.thisWeek"></td>
            <td class="text-right" for="withRawDistillery.prevCrop.prevWeek"></td>
            <td class="text-right" for="withRawDistillery.prevCrop.toDate"></td>
        </tr>
        <tr>
            <td> <span class="indent"></span>
                Domestic
            </td>
            <td class="text-right updatable" for="withRawDomestic.currentCrop.thisWeek"></td>
            <td class="text-right updatable" for="withRawDomestic.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="withRawDomestic.currentCrop.toDate"></td>
            <td class="text-right updatable" for="withRawDomestic.prevCrop.thisWeek"></td>
            <td class="text-right updatable" for="withRawDomestic.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="withRawDomestic.prevCrop.toDate"></td>
        </tr>
        <tr class="computation" for="totalWithdrawalsRaw">
            <td class="text-right">
                <i>TOTAL RAW</i>
            </td>
            <td class="text-right updatable" for="totalRawWith.currentCrop.thisWeek"></td>
            <td class="text-right updatable" for="totalRawWith.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="totalRawWith.currentCrop.toDate"></td>
            <td class="text-right updatable" for="totalRawWith.prevCrop.thisWeek"></td>
            <td class="text-right updatable" for="totalRawWith.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="totalRawWith.prevCrop.toDate"></td>
        </tr>

        <tr>
            <td colspan="7" class="text-strong"><span class="indent"></span> REFINED</td>
        </tr>
        <tr class="withRefinedDistillery_header">
            <td> <span class="indent"></span>
                Distillery
            </td>
            <td class="text-right updatable" for="withRefinedDistillery.currentCrop.thisWeek"></td>
            <td class="text-right updatable" for="withRefinedDistillery.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="withRefinedDistillery.currentCrop.toDate"></td>
            <td class="text-right updatable" for="withRefinedDistillery.prevCrop.thisWeek"></td>
            <td class="text-right updatable" for="withRefinedDistillery.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="withRefinedDistillery.prevCrop.toDate"></td>
        </tr>
        <tr class="withRefinedDomestic_header">
            <td> <span class="indent"></span>
                Domestic
            </td>
            <td class="text-right updatable" for="withRefinedDomestic.currentCrop.thisWeek"></td>
            <td class="text-right updatable" for="withRefinedDomestic.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="withRefinedDomestic.currentCrop.toDate"></td>
            <td class="text-right updatable" for="withRefinedDomestic.prevCrop.thisWeek"></td>
            <td class="text-right updatable" for="withRefinedDomestic.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="withRefinedDomestic.prevCrop.toDate"></td>
        </tr>

        <tr class="computation" for="totalWithdrawalsRefined">
            <td class="text-right">
                <i>TOTAL REFINED</i>
            </td>
            <td class="text-right updatable" for="totalRefinedWith.currentCrop.thisWeek"></td>
            <td class="text-right updatable" for="totalRefinedWith.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="totalRefinedWith.currentCrop.toDate"></td>
            <td class="text-right updatable" for="totalRefinedWith.prevCrop.thisWeek"></td>
            <td class="text-right updatable" for="totalRefinedWith.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="totalRefinedWith.prevCrop.toDate"></td>
        </tr>
        <tr class="computation" for="totalWithdrawals">
            <td class="text-right text-strong">
                TOTAL WITHDRAWALS
            </td>
            <td class="text-strong text-right updatable" for="totalOverallWith.currentCrop.thisWeek"></td>
            <td class="text-strong text-right updatable" for="totalOverallWith.currentCrop.prevWeek"></td>
            <td class="text-strong text-right updatable" for="totalOverallWith.currentCrop.toDate"></td>
            <td class="text-strong text-right updatable" for="totalOverallWith.prevCrop.thisWeek"></td>
            <td class="text-strong text-right updatable" for="totalOverallWith.prevCrop.prevWeek"></td>
            <td class="text-strong text-right updatable" for="totalOverallWith.prevCrop.toDate"></td>
        </tr>

        <tr class="computation" for="notCoveredByMsc">
        <tr>
            <td class="text-strong">
                4. NOT COVERED BY MSC
            </td>
            <td class="text-strong text-right updatable" for="notCoveredByMsc.currentCrop.thisWeek"></td>
            <td class="text-strong text-right updatable" for="notCoveredByMsc.currentCrop.prevWeek"></td>
            <td class="text-strong text-right updatable" for="notCoveredByMsc.currentCrop.toDate"></td>
            <td class="text-right except">
                {!! \App\Swep\ViewHelpers\__form2::textboxOnly('prev_notCoveredByMsc',[
                    'class' => 'form3-input input-sm text-right autonumber_mt'
                ],
                $wr->form3->prev_notCoveredByMsc ?? null) !!}
            </td>
            <td class="text-strong text-right updatable" for="notCoveredByMsc.prevCrop.prevWeek"></td>
            <td class="text-strong text-right updatable" for="notCoveredByMsc.prevCrop.toDate"></td>
        </tr>
        <tr>
            <td colspan="7" class="text-strong">5. BALANCE</td>
        </tr>

        <tr class="computation" for="balanceRaw">
            <td> <span class="indent"></span>
                5.1 Raw
            </td>
            <td class="text-right updatable" for="rawBalance.currentCrop.thisWeek"></td>
            <td class="text-right updatable" for="rawBalance.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="rawBalance.currentCrop.toDate"></td>
            <td class="text-right updatable" for="rawBalance.prevCrop.thisWeek"></td>
            <td class="text-right updatable" for="rawBalance.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="rawBalance.prevCrop.toDate"></td>
        </tr>

        <tr class="computation" for="balanceRefined">
            <td> <span class="indent"></span>
                5.2 Refined
            </td>
            <td class="text-right updatable" for="refinedBalance.currentCrop.thisWeek"></td>
            <td class="text-right updatable" for="refinedBalance.currentCrop.prevWeek"></td>
            <td class="text-right updatable" for="refinedBalance.currentCrop.toDate"></td>
            <td class="text-right updatable" for="refinedBalance.prevCrop.thisWeek"></td>
            <td class="text-right updatable" for="refinedBalance.prevCrop.prevWeek"></td>
            <td class="text-right updatable" for="refinedBalance.prevCrop.toDate"></td>
        </tr>

        <tr class="computation" for="totalBalance3">
            <td class="text-right text-strong">
                TOTAL BALANCE
            </td>
            <td class="text-strong text-right updatable" for="totalBalance3.currentCrop.thisWeek"></td>
            <td class="text-strong text-right updatable" for="totalBalance3.currentCrop.prevWeek"></td>
            <td class="text-strong text-right updatable" for="totalBalance3.currentCrop.toDate"></td>
            <td class="text-strong text-right updatable" for="totalBalance3.prevCrop.thisWeek"></td>
            <td class="text-strong text-right updatable" for="totalBalance3.prevCrop.prevWeek"></td>
            <td class="text-strong text-right updatable" for="totalBalance3.prevCrop.toDate"></td>
        </tr>

        </tbody>
    </table>


    <div class="callout callout-default">
        <h4>NOTICE!</h4>
        <p>Withdrawals of Molasses were transferred to <b>FORM 3B DELIVERIES</b></p>
    </div>


    <div class="box box-sm box-default box-solid">
        <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
            <p class="no-margin">
                7. Molasses Price:
                <small id="filter-notifier" class="label bg-blue blink"></small>
            </p>
        </div>
        <div class="box-body" style="">
            <div class="row">
                <div class="col-md-4">

                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('price',[
                            'label' => 'Price:',
                            'cols' => 12,
                            'class' => 'form3-input autonum',
                        ],
                        $wr->form3->price ?? null
                        ) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="row">
        <div class="col-md-12">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
                    <p class="no-margin">
                        6. Molasses Storage Certificates
                        <small id="filter-notifier" class="label bg-blue blink"></small>
                        <button class="btn btn-xs pull-right btn-success add_seriesNos_btn" for="MOLASSES" style="background-color: #e3e3e3" data="form3SeriesNos" type="button"><i class="fa fa-plus"></i> ADD</button>
                    </p>
                </div>
                <div class="box-body" style="">
                    <table class="table table-bordered table-condensed table_dynamic" id="form3SeriesNos">
                        <thead>
                        <tr>
                            <th>RAW/REF</th>
                            <th>Series From</th>
                            <th>Series To</th>
                            <th>Sugar Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($seriesNos['MOLASSES']))
                            @foreach($seriesNos['MOLASSES'] as $seriesNo)
                                @include('sms.dynamic_rows.insertSeriesNos',[
                                    'for' => 'MOLASSES',
                                    'seriesNo' => $seriesNo,
                                ])
                            @endforeach
                        @else
                            @include('sms.dynamic_rows.insertSeriesNos',[
                                    'for' => 'MOLASSES',
                                ])
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="box box-sm box-default box-solid">
        <div class="box-header with-border"  style="background-color: #4477a3;color: white;">
            <p class="no-margin">
                7. Molasses Distribution Factor:
                <small id="filter-notifier" class="label bg-blue blink"></small>
            </p>
        </div>
        <div class="box-body" style="">
            <div class="row">
                <div class="col-md-6">

                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('distFactor',[
                            'label' => 'Molasses Distribution Factor:',
                            'cols' => 12,
                            'class' => 'form3-input',
                        ],
                        $wr->form3->distFactor ?? null
                        ) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    'label' => 'Remarks:',
                    'cols' => 12,
                    'class' => 'form3-input',
                ],
                $wr->form3->remarks ?? null
                ) !!}
            </div>
        </div>
    </div>

</form>