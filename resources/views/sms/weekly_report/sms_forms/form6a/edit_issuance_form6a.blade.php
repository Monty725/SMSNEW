@php($rand = \Illuminate\Support\Str::random())
@extends('layouts.modal-content',['form_id' => 'form5a_issuance_form_'.$rand,'slug'=>$issuance->slug])

@section('modal-header')
    Edit Issuance
@endsection

@section('modal-body')
    @include('sms.weekly_report.sms_forms.form6a.issuance_form6a')
@endsection

@section('modal-footer')
    <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-check"></i> Save</button>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#form5a_issuance_form_{{$rand}}").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.form5a_issuanceOfSro.update",$issuance->slug)}}',
                data : form.serialize(),
                type: 'PATCH',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,true);
                    active_form5a_issuance = res.slug;
                    form5a_issuance_tbl.draw(false);
                    updateTradersList();
                    location.reload();
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })
        $("#form5a_issuance_form_{{$rand}} .iCheck").iCheck(iCheckRadioOptions);
    </script>
@endsection





{{--NEW--}}
{{--@php($rand = \Illuminate\Support\Str::random())--}}
{{--<div class="row">--}}
{{--    {!! \App\Swep\ViewHelpers\__form2::textbox('date_of_issue',[--}}
{{--        'label' => 'Date of Issue',--}}
{{--        'cols' => 4,--}}
{{--        'type' => 'date',--}}
{{--    ],--}}
{{--    (!empty($issuance)) ? $issuance : null--}}
{{--    ) !!}--}}
{{--    {!! \App\Swep\ViewHelpers\__form2::textbox('trader',[--}}
{{--        'label' => 'Trader/Tollee',--}}
{{--        'cols' => 8,--}}
{{--        'list' => 'traders',--}}
{{--    ],--}}
{{--    (!empty($issuance)) ? $issuance : null--}}
{{--    ) !!}--}}

{{--</div>--}}
{{--<div class="row">--}}
{{--    {!! \App\Swep\ViewHelpers\__form2::textbox('raw_sro_no',[--}}
{{--            'label' => 'RAW SRO:',--}}
{{--            'cols' => 6,--}}
{{--    ],--}}
{{--    (!empty($issuance)) ? $issuance : null--}}
{{--    ) !!}--}}

{{--    {!! \App\Swep\ViewHelpers\__form2::textbox('raw_qty',[--}}
{{--        'label' => 'Raw Qty',--}}
{{--        'cols' => 6,--}}
{{--        'class' => 'autonumber_mt_'.$rand,--}}
{{--    ],--}}
{{--    (!empty($issuance)) ? $issuance : null--}}
{{--    ) !!}--}}
{{--</div>--}}
{{--<div class="row">--}}
{{--    {!! \App\Swep\ViewHelpers\__form2::textbox('sro_no',[--}}
{{--        'label' => 'REFINED SRO:',--}}
{{--        'cols' => 6,--}}
{{--    ],--}}
{{--    (!empty($issuance)) ? $issuance : null--}}
{{--    ) !!}--}}

{{--    {!! \App\Swep\ViewHelpers\__form2::textbox('refined_qty',[--}}
{{--    'label' => 'Refined Qty',--}}
{{--    'cols' => 6,--}}
{{--    'class' => 'autonumber_mt_'.$rand,--}}
{{--],--}}
{{--$issuance->refined_qty ?? $issuance->prev_refined_qty ?? null--}}
{{--) !!}--}}

{{--</div>--}}
{{--<div class="row">--}}
{{--        {!! \App\Swep\ViewHelpers\__form2::textbox('monitoring_fee_or_no',[--}}
{{--            'label' => 'Monitoring Fee OR No.',--}}
{{--            'cols' => 4,--}}
{{--        ],--}}
{{--        (!empty($issuance)) ? $issuance : null--}}
{{--        ) !!}--}}
{{--    {!! \App\Swep\ViewHelpers\__form2::textbox('rsq_no',[--}}
{{--        'label' => 'RSQ No.',--}}
{{--        'cols' => 4,--}}
{{--    ],--}}
{{--    (!empty($issuance)) ? $issuance : null--}}
{{--    ) !!}--}}
{{--        {!! \App\Swep\ViewHelpers\__form2::textbox('liens_or',[--}}
{{--                'label' => 'Liens OR#:',--}}
{{--                'cols' => 4,--}}
{{--            ],--}}
{{--            $issuance->liens_or ?? null--}}
{{--            ) !!}--}}
{{--</div>--}}
{{--<div class="row">--}}

{{--        {!! \App\Swep\ViewHelpers\__form2::textbox('delivery_no',[--}}
{{--            'label' => 'Delivery #:',--}}
{{--            'cols' => 4,--}}
{{--        ],--}}
{{--        $issuance->delivery_no ?? null--}}
{{--        ) !!}--}}
{{--        {!! \App\Swep\ViewHelpers\__form2::textbox('mill_source',[--}}
{{--            'label' => 'Mill Source:',--}}
{{--            'cols' => 8,--}}
{{--        ],--}}
{{--        $issuance->mill_source ?? null--}}
{{--        ) !!}--}}
{{--</div>--}}

{{--<div class="row">--}}
{{--    {!! \App\Swep\ViewHelpers\__form2::iRadioH('consumption',[--}}
{{--        'cols' => 9,--}}
{{--        'label' => 'Domestic/Imported:',--}}
{{--        'options' => [--}}
{{--            'DOMESTIC' => 'Domestic',--}}
{{--            'IMPORTED' => 'Imported',--}}
{{--            'ADVANCE'  => 'Advance Refining',--}}
{{--        ]--}}
{{--    ],--}}
{{--    $issuance->consumption ?? 'DOMESTIC'--}}
{{--    ) !!}--}}

{{--    {!! \App\Swep\ViewHelpers\__form2::iRadioH('cropCharge',[--}}
{{--        'cols' => 6,--}}
{{--        'label' => 'Crop:',--}}
{{--        'options' => [--}}
{{--            'CURRENT' => 'Current Crop',--}}
{{--            'PREVIOUS' => 'Previous Crop',--}}
{{--        ]--}}
{{--    ],--}}
{{--     !empty($issuance->refined_qty) ? 'CURRENT' : 'PREVIOUS'--}}
{{--    ) !!}--}}
{{--</div>--}}

{{--<script>--}}
{{--    const autonumericElement_{{$rand}} =  AutoNumeric.multiple('.autonumber_mt_{{$rand}}',autonum_settings_mt);--}}
{{--</script>--}}
