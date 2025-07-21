@extends('layouts.admin-master')

@section('content')

    <section class="content-header">

    </section>
@endsection
@section('content2')

{{--    OLD CODE--}}
{{--    <section class="content">--}}
{{--        <div class="login-box">--}}
{{--            <div class="login-logo">--}}
{{--                Select Report No. & Crop Year--}}
{{--            </div>--}}
{{--            <div class="login-box-body">--}}
{{--                <form id="" method="GET" action="{{route('dashboard.reports.index')}}">--}}
{{--                    @csrf--}}
{{--                    <div class="row">--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::select('crop_year',[--}}
{{--                            'label' => 'Crop Year:*',--}}
{{--                            'cols' => 12,--}}
{{--                            'options' => \App\Swep\Helpers\Arrays::cropYears(),--}}
{{--                            'required' => 'required',--}}
{{--                        ]) !!}--}}
{{--                        {!! \App\Swep\ViewHelpers\__form2::textbox('report_no',[--}}
{{--                            'label' => 'Report No.:*',--}}
{{--                            'cols' => 12,--}}
{{--                            'type' => 'number',--}}
{{--                            'step' => 1,--}}
{{--                            'required' => 'required',--}}
{{--                        ]) !!}--}}
{{--                    </div>--}}
{{--                    <button type="submit" class="btn btn-primary btn-block btn-flat">--}}
{{--                        <i class="fa fa-search"> </i> FIND--}}
{{--                    </button>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    NEW CODE--}}
@if(!empty($calendar))
    @foreach(array_reverse(array_keys($calendar)) as $crop_year)
        <div class="panel">
            <div class="box box-sm box-default box-solid">
                <div class="box-header with-border">
                    <p class="no-margin">
                        {{$crop_year}}
                        <small id="filter-notifier-{{ $crop_year }}" class="label bg-blue blink"></small>
                    </p>
                </div>
                <div class="box-body" style="overflow: auto">
                    <table class="table table-bordered table-condensed">
                        <thead>
                        <tr>
                            @foreach($calendar[$crop_year] as $month => $weeks)
                                <th class="text-center">{{ strtoupper(\Illuminate\Support\Carbon::parse($month)->format('M')) }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($calendar[$crop_year] as $month => $weeks)
                                <td>
                                    <div class="row">
                                        @foreach($weeks as $week => $report_no)
                                            <div class="col-md-12">
                                                <form method="GET" action="{{ route('dashboard.reports.index') }}">
                                                    <input type="hidden" name="crop_year" value="{{ $crop_year }}">
                                                    <input type="hidden" name="report_no" value="{{ $report_no }}">
                                                    <button type="submit"
                                                            class="view_week_btn btn btn-sm {{ isset($submissions[$week]) ? 'btn-success' : 'btn-default'}}"
                                                            style="width: 100%; margin-bottom: 10px; font-family: Consolas"
                                                            {{ isset($submissions[$week]) ? '' : 'disabled' }}>
                                                        {{ $report_no }} : {{ \Carbon\Carbon::parse($week)->format('M d') }}
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
@endif

@endsection


@section('modals')

@endsection

@section('scripts')
    <script type="text/javascript">

    </script>
@endsection