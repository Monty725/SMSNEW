@php
    $rand = \Illuminate\Support\Str::random();
@endphp
@extends('layouts.modal-content')

@section('modal-header')
    {{$wr->mill_code}} | WE: {{\Illuminate\Support\Carbon::parse($wr->week_ending)->format('M. d, Y')}} | Report No. {{$wr->report_no}}
@endsection

@section('modal-body')
    <div class="row">
        <div class="col-md-12">
            Submitted at: {{ Carbon::parse($wr->submitted_at)->format('F d, Y | h:i A') }}

            <!-- Print Button -->
            <button class="btn btn-default pull-right btn-sm"
                    id="print_btn_{{$rand}}"
                    style="margin-bottom:10px;">
                <i class="fa fa-print"></i> Print
            </button>

            @if($wr->status == 2)
                <!-- Divider -->
                <span class="pull-right"
                      style="margin: 0 12px; border-left: 1px solid #ccc; height: 30px; margin-top: 5px;">
                </span>

                <!-- Approve -->
                <a href="#"
                   class="btn btn-success pull-right btn-sm approveBtn"
                   style="margin-bottom:10px; margin-right:5px;"
                   data-slug="{{ $wr->slug }}"
                   data-report-no="{{ $wr->report_no }}"
                   data-week-ending="{{ \Carbon\Carbon::parse($wr->week_ending)->format('F d, Y') }}"
                   data-crop-year="{{ $wr->crop_year ?? '' }}"
                   data-toggle="tooltip"
                   title="Approve weekly report">
                    <i class="fa fa-check"></i> Approve
                </a>

                <!-- Deny -->
                <a href="#"
                   class="btn btn-danger pull-right btn-sm denyBtn"
                   style="margin-bottom:10px; margin-right:5px;"
                   data-slug="{{ $wr->slug }}"
                   data-report-no="{{ $wr->report_no }}"
                   data-week-ending="{{ \Carbon\Carbon::parse($wr->week_ending)->format('F d, Y') }}"
                   data-crop-year="{{ $wr->crop_year ?? '' }}"
                   data-toggle="tooltip"
                   title="Deny weekly report">
                    <i class="fa fa-times"></i> Deny
                </a>
            @endif
        </div>
    </div>
    <div id="loaderContainer_{{$rand}}">
        <h1 class="text-center" style="font-size: 72px; padding: 150px">
            <i class="fa fa-spin fa-spinner"></i>
        </h1>
    </div>

    <div class="bs-example" id="printFrameContainer_{{$rand}}" hidden>
        <div class="embed-responsive embed-responsive-16by9" style="height: 1019.938px;">
            <iframe id="printFrame_{{$rand}}" class="embed-responsive-item" src="{{route("dashboard.weekly_report.print",$wr->slug)}}">
            </iframe>
        </div>
    </div>
@endsection

@section('modal-footer')

@endsection

@section('scripts')
    <script type="text/javascript">

        $("#printFrame_{{$rand}}").on('load',function () {
            $("#loaderContainer_{{$rand}}").fadeOut(function () {
                $("#printFrameContainer_{{$rand}}").show();
            })
        })

        $("#print_btn_{{$rand}}").click(function () {
            $("#printFrame_{{$rand}}").get(0).contentWindow.print();
        })

        // function confirmApprove() {
        //     return confirm("Are you sure you want to APPROVE this report?");
        // }

        $("body").on("click", ".approveBtn", function (e) {
            e.preventDefault();
            let btn = $(this);
            let slug = btn.data('slug');
            let reportNo = btn.data('report-no');
            let weekEnding = btn.data('week-ending');
            let cropYear = btn.data('crop-year');

            Swal.fire({
                title: 'Approve Weekly Report',
                html: '<div class="text-left"><b>Details</b>: <br>' +
                    'Report No.: ' + reportNo + '<br>' +
                    'Week Ending: ' + weekEnding + '<br>' +
                    'Crop Year: ' + cropYear + '<br>' +
                    '</div>',
                showCancelButton: true,
                confirmButtonText: 'Approve',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        url: '/weekly_report/' + slug + '/approve', // your route
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }).then(response => {
                        notify('Weekly report approved successfully.', 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                        return response;
                    }).catch(error => {
                        let message = error.responseJSON?.message || 'Request failed';
                        Swal.showValidationMessage('Request failed: ' + message);
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        });

        $("body").on("click", ".denyBtn", function (e) {
            e.preventDefault();
            let btn = $(this);
            let slug = btn.data('slug');
            let reportNo = btn.data('report-no');
            let weekEnding = btn.data('week-ending');
            let cropYear = btn.data('crop-year');

            Swal.fire({
                title: 'Deny Weekly Report',
                html: '<div class="text-left"><b>Details</b>: <br>' +
                    'Report No.: ' + reportNo + '<br>' +
                    'Week Ending: ' + weekEnding + '<br>' +
                    'Crop Year: ' + cropYear + '<br>' +
                    '</div>',
                showCancelButton: true,
                confirmButtonText: 'Deny',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        url: '/weekly_report/' + slug + '/deny', // your route
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }).then(response => {
                        notify('Weekly Report Denied.', 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                        return response;
                    }).catch(error => {
                        let message = error.responseJSON?.message || 'Request failed';
                        Swal.showValidationMessage('Request failed: ' + message);
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        });

        // function confirmDeny(event) {
        //     if (!confirm("Are you sure you want to DENY this report?")) {
        //         event.preventDefault();
        //     }
        // }
    </script>
@endsection

