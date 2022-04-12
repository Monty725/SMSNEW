@extends('layouts.admin-master')

@section('content')
    <style>
        .pad5{
            padding: 5px;
        }

        .pad5 span{
            font-weight: bold;
        }

        .scrolling-wrapper {
            overflow-x: scroll;
            overflow-y: hidden;
            white-space: nowrap;
            padding-top: 15px;
            padding-left: 15px;

        }

        .scrolling-card {
            display: inline-block;
        }

        .scrolling-li{
            padding: 10px;

        }
        .scrolling-li:hover {
            cursor: pointer;
            box-shadow: 5px 10px 18px #888888;
            -webkit-transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            transform: scale(1.1, 1.1);
        }


    </style>

    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-widget widget-user">

                    <div class="widget-user-header bg-aqua-active">
                        <h3 class="widget-user-username">
                            {{(!empty($user->employee) ? $user->employee->lastname : $user->lastname)}},
                            {{(!empty($user->employee) ? $user->employee->firstname : $user->firstname)}}
                        </h3>
                        <h5 class="widget-user-desc">
                            {{(!empty($user->employee) ? $user->employee->position : $user->position)}}
                        </h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{asset('images/avatar.jpeg')}}" alt="User Avatar">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{$user->username}}</h5>
                                    <span class="description-text">USERNAME</span>
                                </div>

                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{$user->employee_no}}</h5>
                                    <span class="description-text">EMPLOYEE NO</span>
                                </div>

                            </div>

                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">{{(!empty($user->employee) ? $user->employee->biometric_user_id : '')}}</h5>
                                    <span class="description-text">BIOMETRIC USER ID</span>
                                </div>

                            </div>

                        </div>
                        <ul class="nav nav-stacked">
                            <li class="bg-orange pad5">
                                    <center>Account details</center>
                            </li>
                            <li class="pad5">First name <span class="pull-right">{{(!empty($user->employee) ? $user->employee->firstname : $user->firstname)}}</span></li>
                            <li class="pad5">Middle name <span class="pull-right">{{(!empty($user->employee) ? $user->employee->middlename : $user->middlename)}}</span></li>
                            <li class="pad5">Last name <span class="pull-right">{{(!empty($user->employee) ? $user->employee->lastname : $user->lastname)}}</span></li>
                            <li class="pad5">Birthday <span class="pull-right">{{(!empty($user->employee) ? Carbon::parse($user->employee->date_of_birth)->format('F d, Y') :'N/A')}}</span></li>
                            <li class="pad5">Age <span class="pull-right">{{(!empty($user->employee) ? Carbon::parse($user->employee->date_of_birth)->age :'N/A')}} years old</span></li>
                            <li class="pad5">Sex <span class="pull-right">{{(!empty($user->employee) ? $user->employee->sex:'N/A')}}</span></li>
                            <li class="pad5">Email address <span class="pull-right">{{(!empty($user->employee) ? $user->employee->email:'N/A')}}</span></li>

                            <li class="bg-green" style="padding: 5px">
                                <center>Employement Details</center>
                                <li class="pad5">Location <span class="pull-right">{{(!empty($user->employee) ? $user->employee->locations : $user->locations)}}</span></li>
                                @if(!empty($user->employee))
                                    @if($user->employee->locations != 'RETIREE' && $user->employee->locations != 'COS')
                                        <li class="pad5">Position <span class="pull-right">{{$user->employee->position}}</span></li>
                                        <li class="pad5">Job Grade <span class="pull-right">{{$user->employee->salary_grade}}</span></li>
                                        <li class="pad5">Step <span class="pull-right">{{$user->employee->step_inc}}</span></li>
                                        <li class="pad5">Monthly basic <span class="pull-right">{{number_format($user->employee->monthly_basic,2)}}</span></li>
                                        @if($user->employee->ra != 0.00)
                                            <li class="pad5">Representation Allowance <span class="pull-right">{{number_format($user->employee->ra,2)}}</span></li>
                                        @endif
                                        @if($user->employee->ta != 0.00)
                                            <li class="pad5">Transportation Allowance <span class="pull-right">{{number_format($user->employee->ta,2)}}</span></li>
                                        @endif
                                        <li class="pad5">First day in Government <span class="pull-right">{{Carbon::parse($user->employee->firstday_gov)->format('F d, Y')}}</span></li>
                                        <li class="pad5">First day in SRA <span class="pull-right">{{Carbon::parse($user->employee->firstday_sra)->format('F d, Y')}}</span></li>
                                        <li class="pad5">Date of last promotion <span class="pull-right">{{Carbon::parse($user->employee->adjustment_date)->format('F d, Y')}}</span></li>
                                    @endif
                                    @if($user->employee->locations == 'COS')
                                        <li class="pad5">Position <span class="pull-right">{{$user->employee->position}}</span></li>
                                        <li class="pad5">Monthly basic <span class="pull-right">{{number_format($user->employee->monthly_basic,2)}}</span></li>
                                        @endif
                                @endif
                            </li>
                            <li class="bg-blue pad5">
                                <center>Activity</center>
                            </li>
                            <li class="pad5">Last activity on <span class="pull-right">{{$user->last_activity_machine}}</span></li>
                            <li class="pad5">Last login IP <span class="pull-right">{{$user->last_login_ip}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        @if(!empty(\Illuminate\Support\Facades\Auth::user()->employee))
                            <li class="active"><a href="#tab_acc" data-toggle="tab" aria-expanded="true"><i class="fa fa-wrench"></i> Account Settings</a></li>
                            <li class=""><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa icon-family"></i> Family Information</a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa icon-service-record"></i> Service Records</a></li>
                            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false"><i class="fa icon-seminar"></i> Trainings/Seminars</a></li>
                            <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false"><i class="fa icon-seminar"></i> Credentials</a></li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_acc">
                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                Select theme:
                            </p>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="scrolling-wrapper">
                                        @foreach(\App\Swep\Helpers\Helper::user_colors() as $display => $code)
                                            <div class="scrolling-card" data="sidebar-mini skin-blue">
                                                <ul class="mailbox-attachments clearfix">
                                                    <li for="{{$display}}" class="scrolling-li {{($code == \Illuminate\Support\Facades\Auth::user()->color) ? 'bg-success' : ''}}" data="{{$code}}" >
                                                        <span class="mailbox-attachment-icon has-img">
                                                            <img src="{{asset('swep/skins/')}}/{{$code}}.jpg" style="vertical-align: middle"></span>
                                                        <div class="mailbox-attachment-info">
                                                            <a href="#" class="mailbox-attachment-name">
                                                                {{$display}}
                                                                <span class="pull-right check text-green" >
                                                                    <i class="{{($code == \Illuminate\Support\Facades\Auth::user()->color) ? 'fa fa-check' : ''}} iconer" for="{{$display}}"></i>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>

                        </div>
                        @if(!empty(\Illuminate\Support\Facades\Auth::user()->employee))
                            @php($emp = \Illuminate\Support\Facades\Auth::user()->employee)
                            <div class="tab-pane" id="tab_1">

                                <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1; padding-bottom: 6px">
                                    Father's Information
                                    <span class="pull-right">
                                    <button class="btn btn-xs btn-success" id="enable_family_btn" type="button">Enable editing</button>
                                </span>
                                </p>
                                <form id="family_form">
                                    <fieldset id="family_fieldset" disabled="disabled">

                                        @php($family_detail = \Illuminate\Support\Facades\Auth::user()->employee->employeeFamilyDetail)
                                        <div class="row">
                                            {!! \App\Swep\ViewHelpers\__form2::textbox('father_firstname',[
                                                'cols' => 3,
                                                'label' => "Father's First name:",
                                            ],
                                            $family_detail) !!}
                                            {!! \App\Swep\ViewHelpers\__form2::textbox('father_middlename',[
                                                'cols' => 3,
                                                'label' => "Father's Middle name:",
                                            ],
                                            $family_detail) !!}
                                            {!! \App\Swep\ViewHelpers\__form2::textbox('father_lastname',[
                                                'cols' => 3,
                                                'label' => "Father's Last name:",
                                            ],
                                            $family_detail) !!}
                                            {!! \App\Swep\ViewHelpers\__form2::select('father_name_ext',[
                                                'cols' => 3,
                                                'label' => "Father's name extension:",
                                                'options' => \App\Swep\Helpers\Helper::name_extensions(),
                                            ],
                                            $family_detail) !!}
                                        </div>
                                        <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                            Mother's Information
                                        </p>
                                        <div class="row">
                                            {!! \App\Swep\ViewHelpers\__form2::textbox('mother_firstname',[
                                                'cols' => 3,
                                                'label' => "Mother's First name:",
                                            ],
                                            $family_detail) !!}
                                            {!! \App\Swep\ViewHelpers\__form2::textbox('mother_middlename',[
                                                'cols' => 3,
                                                'label' => "Mother's Middle name:",
                                            ],
                                            $family_detail) !!}
                                            {!! \App\Swep\ViewHelpers\__form2::textbox('mother_lastname',[
                                                'cols' => 3,
                                                'label' => "Mother's Last name:",
                                            ],
                                            $family_detail) !!}
                                            {!! \App\Swep\ViewHelpers\__form2::select('mother_name_ext',[
                                                'cols' => 3,
                                                'label' => "Mother's name extension:",
                                                'options' => \App\Swep\Helpers\Helper::name_extensions(),
                                            ],
                                            $family_detail) !!}
                                        </div>

                                        <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                            Spouse's Information
                                        </p>

                                        <div class="row">
                                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_firstname',[
                                                'cols' => 3,
                                                'label' => "Spouse's First name:",
                                            ],
                                            $family_detail) !!}
                                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_middlename',[
                                                'cols' => 3,
                                                'label' => "Spouse's Middle name:",
                                            ],
                                            $family_detail) !!}
                                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_lastname',[
                                                'cols' => 3,
                                                'label' => "Spouse's Last name:",
                                            ],
                                            $family_detail) !!}
                                            {!! \App\Swep\ViewHelpers\__form2::select('spouse_name_ext',[
                                                'cols' => 3,
                                                'label' => "Spouse's name extension:",
                                                'options' => \App\Swep\Helpers\Helper::name_extensions(),
                                            ],
                                            $family_detail) !!}
                                        </div>
                                        <div class="row">
                                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_birthdate',[
                                                'cols' => 3,
                                                'label' => "Spouse's Birthday:",
                                                'type' => 'date',
                                            ],
                                            $family_detail) !!}
                                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_occupation',[
                                                'cols' => 3,
                                                'label' => "Spouse's Occupation:",
                                            ],
                                            $family_detail) !!}
                                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_employer',[
                                                'cols' => 3,
                                                'label' => "Spouse's Employer:",
                                            ],
                                            $family_detail) !!}
                                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_business_address',[
                                                'cols' => 3,
                                                'label' => "Spouse's Business Address:",
                                            ],
                                            $family_detail) !!}
                                        </div>
                                        <div class="row">
                                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_tel_no',[
                                                'cols' => 3,
                                                'label' => "Spouse's Phone Number:",
                                            ],
                                            $family_detail) !!}
                                        </div>

                                        <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1">
                                            Children Information
                                        </p>
                                        <button id="add_child_btn" type="button" class="btn btn-xs btn-info pull-right" style="margin-bottom: 5px"><i class="fa fa-plus"></i> Add child</button>
                                        @php($children = \Illuminate\Support\Facades\Auth::user()->employee->employeeChildren)

                                        <table id="children_table" style="width: 100%" class="table table-bordered">
                                            <tbody>
                                                @if(!empty($children))
                                                    @if($children->count() > 0)
                                                        @foreach($children as $child)
                                                            <tr>
                                                                <td>
                                                                    <div class="row">
                                                                        {!! \App\Swep\ViewHelpers\__form2::textbox('fullname[]',[
                                                                            'cols' => 3,
                                                                            'label' => "Fullname:",
                                                                        ],
                                                                        $child->fullname) !!}
                                                                        {!! \App\Swep\ViewHelpers\__form2::textbox('date_of_birth[]',[
                                                                            'cols' => 3,
                                                                            'label' => "Birthday:",
                                                                            'type' => 'date',
                                                                        ],
                                                                        Carbon::parse($child->date_of_birth)->format('Y-m-d')) !!}
                                                                        {!! \App\Swep\ViewHelpers\__form2::textbox('school_company[]',[
                                                                            'cols' => 3,
                                                                            'label' => "School/Company:",
                                                                        ],
                                                                        $child->school_company) !!}
                                                                        {!! \App\Swep\ViewHelpers\__form2::select('civil_status[]',[
                                                                            'cols' => 3,
                                                                            'label' => "Civil Status:",
                                                                            'options' => \App\Swep\Helpers\Helper::civil_status(),
                                                                        ],
                                                                        $child->civil_status) !!}
                                                                    </div>
                                                                </td>
                                                                <td style="width: 50px; vertical-align: middle">
                                                                    <button class="btn btn-danger btn-sm remove_child_btn"><i class="fa fa-times"></i> </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td>
                                                                <div class="row">
                                                                    {!! \App\Swep\ViewHelpers\__form2::textbox("fullname[]",[
                                                                        "cols" => 3,
                                                                        "label" => "Fullname:",
                                                                    ]) !!}
                                                                    {!! \App\Swep\ViewHelpers\__form2::textbox("date_of_birth[]",[
                                                                        "cols" => 3,
                                                                        "label" => "Birthday:",
                                                                        "type" => "date",
                                                                    ]) !!}
                                                                    {!! \App\Swep\ViewHelpers\__form2::textbox("school_company[]",[
                                                                        "cols" => 3,
                                                                        "label" => "School/Company:",
                                                                    ]) !!}
                                                                    {!! \App\Swep\ViewHelpers\__form2::select("civil_status[]",[
                                                                        "cols" => 3,
                                                                        "label" => "Civil Status:",
                                                                        "options" => \App\Swep\Helpers\Helper::civil_status(),
                                                                    ]) !!}
                                                                </div>
                                                            </td>
                                                            <td style="width: 50px; vertical-align: middle">
                                                                <button class="btn btn-danger btn-sm remove_child_btn"><i class="fa fa-times"></i> </button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            </tbody>
                                        </table>

                                        <div class="row" id="save_family_btn_container" style="display: none">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-check"></i> Save</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button data-toggle="modal" data-target="#add_sr_modal" id="add_sr_btn" class="btn btn-primary btn-sm pull-right" style="margin-bottom: 10px"><i class="fa fa-plus"></i> Add Service Record</button>
                                    </div>
                                </div>
                                <div id="service_records_table_container" style="display: none">
                                    <table class="table table-bordered table-striped table-hover" id="service_records_table" style="width: 100% !important">
                                        <thead>
                                        <tr class="">
                                            <th >Seq #</th>
                                            <th>Date From</th>
                                            <th>Date To</th>
                                            <th>Position</th>
                                            <th>Appt. Status</th>
                                            <th>Salary</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="tbl_loader_2">
                                    <center>
                                        <img style="width: 100px" src="{{asset('images/loader.gif')}}">
                                    </center>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="btn-group pull-right btn-group-sm" role="group" aria-label="...">
                                            <button class="btn btn-primary pull-right btn-sm" data-toggle="modal" id="add_training_btn" data-target="#add_training_modal"><i class="fa fa-plus"></i> Add Training/Seminar</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div id="training_table_container" style="display: none">
                                    <table class="table table-bordered table-striped table-hover training" id="training_table" style="width: 100% !important">
                                        <thead>
                                        <tr class="">
                                            <th>Seq #</th>
                                            <th>Title</th>
                                            <th>Started</th>
                                            <th>Ended</th>
                                            <th>Detailed Period</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="tbl_loader_training">
                                    <center>
                                        <img style="width: 100px" src="{{asset('images/loader.gif')}}">
                                    </center>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_4">
                                <label>Credentials:</label>
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_educ" data-toggle="tab">Educational Background</a></li>
                                        <li><a href="#tab_elig" data-toggle="tab">Eligibilities</a></li>
                                        <li><a href="#tab_we" data-toggle="tab">Work Experience</a></li>
                                    </ul>
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="tab_educ">
                                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1; padding-bottom: 6px">
                                                Educational Background
                                                <span class="pull-right">
                                                    <button class="btn btn-xs btn-success" id="add_school_btn" type="button"><i class="fa fa-plus"></i> Add</button>
                                                </span>
                                            </p>
                                            <form id="educ_bg_form">
                                                <table class="table table-bordered table-striped" id="educational_background_table">
                                                    <tbody>
                                                    @if(!empty($emp->employeeEducationalBackground))
                                                        @if($emp->employeeEducationalBackground()->count() > 0)
                                                            @foreach($emp->employeeEducationalBackground as $educ_bg)
                                                                @include('ajax.employee.add_school',['data' => $educ_bg])
                                                            @endforeach
                                                        @else
                                                            @include('ajax.employee.add_school')
                                                        @endif
                                                    @endif
                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-check"></i> Save Educational Background</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-pane" id="tab_elig">
                                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1; padding-bottom: 6px">
                                                Eligibilities
                                                <span class="pull-right">
                                                    <button class="btn btn-xs btn-success" id="add_elig_btn" type="button"><i class="fa fa-plus"></i> Add</button>
                                                </span>
                                            </p>
                                            <form id="elig_form">
                                                <table class="table table-bordered table-striped" id="elig_table">
                                                    <tbody>
                                                        @if(!empty($emp->employeeEligibility))
                                                            @if($emp->employeeEligibility->count() > 0)
                                                                @foreach($emp->employeeEligibility as $elig)
                                                                    @include('ajax.employee.add_eligibility',['data' => $elig])
                                                                @endforeach
                                                            @else
                                                                @include('ajax.employee.add_eligibility')
                                                            @endif
                                                        @endif
                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-check"></i> Save Eligibilities</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-pane" id="tab_we">
                                            <p class="page-header-sm text-info" style="border-bottom: 1px solid #cedbe1; padding-bottom: 6px">
                                                Work Experience
                                                <span class="pull-right">
                                                    <button class="btn btn-xs btn-success" id="add_we_btn" type="button"><i class="fa fa-plus"></i> Add</button>
                                                </span>
                                            </p>
                                            <form id="we_form">
                                                <table class="table table-bordered table-striped" id="we_table">
                                                    <tbody>
                                                    @if(!empty($emp->employeeExperience))
                                                        @if($emp->employeeExperience->count() > 0)
                                                            @foreach($emp->employeeExperience as $we)
                                                                @include('ajax.employee.add_work_experience',['data' => $we])
                                                            @endforeach
                                                        @else
                                                            @include('ajax.employee.add_work_experience')
                                                        @endif
                                                    @endif
                                                    </tbody>
                                                </table>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary btn-sm pull-right"><i class="fa fa-check"></i> Save Work Experience</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                </div>
                            </div>

                        @endif




                    </div>

                </div>
            </div>
        </div>
    </section>

<div id="temp_child" style="display: none">
    <table>
        <tr>
            <td>
                <div class="row">
                    {!! \App\Swep\ViewHelpers\__form2::textbox("fullname[]",[
                        "cols" => 3,
                        "label" => "Fullname:",
                    ]) !!}
                    {!! \App\Swep\ViewHelpers\__form2::textbox("date_of_birth[]",[
                        "cols" => 3,
                        "label" => "Birthday:",
                        "type" => "date",
                    ]) !!}
                    {!! \App\Swep\ViewHelpers\__form2::textbox("school_company[]",[
                        "cols" => 3,
                        "label" => "School/Company:",
                    ]) !!}
                    {!! \App\Swep\ViewHelpers\__form2::select("civil_status[]",[
                        "cols" => 3,
                        "label" => "Civil Status:",
                        "options" => \App\Swep\Helpers\Helper::civil_status(),
                    ]) !!}
                </div>
            </td>
            <td style="width: 50px; vertical-align: middle">
                <button class="btn btn-danger btn-sm remove_child_btn"><i class="fa fa-times"></i> </button>
            </td>
        </tr>
    </table>
</div>

@endsection


@section('modals')
    {!! \App\Swep\ViewHelpers\__html::blank_modal('add_sr_modal','') !!}
    {!! \App\Swep\ViewHelpers\__html::blank_modal('edit_sr_modal','') !!}

    {!! \App\Swep\ViewHelpers\__html::blank_modal('add_training_modal','') !!}
    {!! \App\Swep\ViewHelpers\__html::blank_modal('edit_training_modal','') !!}
@endsection

@section('scripts')
    <script type="text/javascript">
        function dt_draw() {
            users_table.draw(false);
        }

        function filter_dt() {
            is_online = $(".filter_status").val();
            is_active = $(".filter_account").val();
            users_table.ajax.url("{{ route('dashboard.user.index') }}" + "?is_online=" + is_online + "&is_active=" + is_active).load();

            $(".filters").each(function (index, el) {
                if ($(this).val() != '') {
                    $(this).parent("div").addClass('has-success');
                    $(this).siblings('label').addClass('text-green');
                } else {
                    $(this).parent("div").removeClass('has-success');
                    $(this).siblings('label').removeClass('text-green');
                }
            });
        }
    </script>
    <script type="text/javascript">
        $("#enable_family_btn").click(function () {
            let attr = $("#family_fieldset").attr('disabled');

            if (typeof attr !== typeof undefined && attr !== false) {
                $("#family_fieldset").removeAttr('disabled');
                $(this).html('Cancel');
                $("#save_family_btn_container").slideDown();
            }else{
                $("#family_fieldset").attr('disabled','disabled');
                $(this).html('Enable editing');
                $("#save_family_btn_container").slideUp();
            }
        })

        $("#family_form").submit(function (e) {
           e.preventDefault();
           let form = $(this);
           loading_btn(form);
           $.ajax({
               url : '{{route("dashboard.profile.save_family_info")}}',
               data : form.serialize(),
               type: 'POST',
               headers: {
                   {!! __html::token_header() !!}
               },
               success: function (res) {
                  if(res == 1){
                      notify('Family information were saved successfully.','info')
                      $("#enable_family_btn").trigger('click');
                  }
                  remove_loading_btn(form);
               },
               error: function (res) {
                   errored(form,res);
               }
           })
        });
        
        $("body").on("click",".remove_child_btn",function () {
            $(this).parents('tr').remove();
        })
        $("#add_child_btn").click(function () {

            let new_child_tr = $("#temp_child tbody").html();
            console.log(new_child_tr);
            $("#children_table tbody").append(new_child_tr);
        })


        modal_loader = $("#modal_loader").parent('div').html();
        //Initialize DataTable
        sr_active = '';
        uri = "{{route('dashboard.profile.service_record')}}";
        service_records_tbl = $("#service_records_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : uri,
            "columns": [
                { "data": "sequence_no" },
                { "data": "from_date" },
                { "data": "to_date" },
                { "data": "position" },
                { "data": "appointment_status" },
                { "data": "salary" },
                { "data": "action" }
            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "columnDefs":[
                {
                    "targets" : 5,
                    "class" : 'text-right'
                },
                {
                    "targets" : 6,
                    "orderable" : false,
                    "class" : 'action-10p'
                },
            ],
            "order":[[0,'desc']],
            "responsive": false,
            "initComplete": function( settings, json ) {
                $('#tbl_loader_2').fadeOut(function(){
                    $("#service_records_table_container").fadeIn();
                    style_datatable("#service_records_table");

                    //Need to press enter to search
                    $('#service_records_table_filter input').unbind();
                    $('#service_records_table_filter input').bind('keyup', function (e) {
                        if (e.keyCode == 13) {
                            service_records_tbl.search(this.value).draw();
                        }
                    });
                });
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(sr_active != ''){
                    $("#service_records_table #"+sr_active).addClass('success');
                }
            }
        })


        trainings_active = '';
        uri = "{{route('dashboard.profile.training')}}";
        trainings_tbl = $("#training_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : uri,
            "columns": [
                { "data": "sequence_no" },
                { "data": "title" },
                { "data": "date_from" },
                { "data": "date_to" },
                { "data": "detailed_period" },
                { "data": "action" }
            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "columnDefs":[
                {
                    "targets" : 0,
                    "class" : 'w-6p'
                },
                {
                    "targets" : 1,
                    "class" : 'w-50p'
                },
                {
                    "targets" : [2,3],
                    "class" : 'w-8p'
                },
                {
                    "targets" : 4,
                    "class" : 'w-20p'
                },
                {
                    "targets" : 5,
                    "orderable" : false,
                    "class" : 'action-8p'
                },
            ],
            "order":[[0,'desc']],
            "responsive": false,
            "initComplete": function( settings, json ) {
                $('#tbl_loader_training').fadeOut(function(){
                    $("#training_table_container").fadeIn();
                    style_datatable("#training_table");

                    //Need to press enter to search
                    $('#training_table_filter input').unbind();
                    $('#training_table_filter input').bind('keyup', function (e) {
                        if (e.keyCode == 13) {
                            trainings_tbl.search(this.value).draw();
                        }
                    });
                });
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(trainings_active != ''){
                    $("#training_table #"+trainings_active).addClass('success');
                }
            }
        })



        $("#add_sr_btn").click(function () {
            btn = $(this);
            load_modal2(btn);
            uri = "{{route('dashboard.profile.service_record','slug')}}";
            uri = uri.replace('slug','{{\Illuminate\Support\Facades\Auth::user()->employee->slug}}');

            $.ajax({
                url : uri,
                data : {add: 1},
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    populate_modal2(btn,res);

                },
                error: function (res) {
                    notify('Ajax error.','danger');
                    console.log(res);
                }
            })
        })

        $("body").on('click','.edit_sr_btn',function () {
            btn = $(this);
            load_modal2(btn);
            var uri = "{{route('dashboard.profile.service_record')}}";
            $.ajax({
                url : uri,
                data : {edit : 1, sr : btn.attr('data')},
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    populate_modal2(btn,res);
                },
                error: function (res) {
                    populate_modal2_error(res);
                }
            })
        })

        $("#add_training_btn").click(function () {
            btn = $(this);
            load_modal2(btn);
            uri = "{{route('dashboard.profile.training')}}";
            $.ajax({
                url : uri,
                data : {add: 2},
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    populate_modal2(btn,res);

                },
                error: function (res) {
                    notify('Ajax error.','danger');
                    console.log(res);
                }
            })
        });

        $("body").on('click','.edit_training_btn',function () {
            btn = $(this);
            load_modal2(btn);
            var uri = "{{route('dashboard.profile.training')}}";
            $.ajax({
                url : uri,
                data : {edit : 1, training : btn.attr('data')},
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    populate_modal2(btn,res);
                },
                error: function (res) {
                    notify("Ajax error.","danger");
                    console.log(res);
                }
            })
        })

        $("#add_school_btn").click(function () {
            btn = $(this);
            wait_this_button(btn);
            $.ajax({
                url : '{{route("dashboard.ajax.get","educational_background")}}',
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                   $("#educational_background_table tbody").append(res);
                   unwait_this_button(btn);
                },
                error: function (res) {
                    notify('Error fetching data.','danger');
                }
            })
        })
        
        $("#educ_bg_form").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.profile.educ_bg_store")}}',
                data : form.serialize(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                   notify('Educational background successfully updated.');
                   remove_loading_btn(form);
                },
                error: function (res) {
                    errored(form,res)
                }
            })
        })


        $("#add_elig_btn").click(function () {
            btn = $(this);
            wait_this_button(btn);
            $.ajax({
                url : '{{route("dashboard.ajax.get","eligibility")}}',
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    $("#elig_table tbody").append(res);
                    unwait_this_button(btn);
                },
                error: function (res) {
                    notify('Error fetching data.','danger');
                }
            })
        })

        $("#elig_form").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.profile.eligibility_store")}}',
                data : form.serialize(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    notify('Eligibilities successfully updated.');
                   remove_loading_btn(form);
                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })

        $("#add_we_btn").click(function () {
            btn = $(this);
            wait_this_button(btn);
            $.ajax({
                url : '{{route("dashboard.ajax.get","work_experience")}}',
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    $("#we_table tbody").append(res.view);
                    $(".we_salary"+res.rand).each(function () {
                        new AutoNumeric(this,autonum_settings);
                    })
                    unwait_this_button(btn);
                },
                error: function (res) {
                    notify('Error fetching data.','danger');
                }
            })
        })

        $(".we_salary").each(function () {
            new AutoNumeric(this,autonum_settings);
        })

        $("#we_form").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.profile.work_experience_store")}}',
                data : form.serialize(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    notify('Work experience successfully updated.');
                    remove_loading_btn(form);


                },
                error: function (res) {
                    errored(form,res);
                }
            })
        })

        $(".scrolling-li").click(function () {
            let li = $(this);
            let theme = li.attr('data');
            let before = $('body').attr("theme");
            let cur_theme = '{{Auth::user()->color}}';
            $.ajax({
                url : '{{route("dashboard.profile.select_theme")}}',
                data : {theme : theme},
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                   console.log(res);
                   $("body").removeClass(before);
                   $("body").addClass(theme);
                   $("body").attr("theme",theme);

                   $(".scrolling-li").each(function () {
                       $(this).removeClass('bg-success');
                   })
                    $(".iconer").each(function () {
                        $(this).removeClass('fa fa-check');
                    })
                    $(".scrolling-li[for='"+res+"']").addClass('bg-success');
                    $("i[for='"+res+"']").addClass('fa fa-check');
                },
                error: function (res) {
                    console.log(res);
                }
            })
        })
    </script>
@endsection