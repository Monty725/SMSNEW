<?php


namespace App\Http\Controllers\SMS\Admin;

use App\Http\Controllers\SMS\Admin\MyMillsController;
use App\Models\SMS\WeeklyReports;
use App\SMS\Services\WeeklyReportService;
use App\Models\SMS\SugarMills;
use App\Swep\Helpers\Get;
use Illuminate\Http\Request;
use App\SMS\Services\CalendarService;
use App\Swep\Helpers\Helper;
use App\Http\Controllers\Controller;




class ReportsController extends Controller
{
    protected $calendarService;
    protected $weeklyReportService;
    public function __construct(CalendarService $calendarService, WeeklyReportService $weeklyReportService)
    {
        $this->calendarService = $calendarService;
        $this->weeklyReportService = $weeklyReportService;
    }
    public function index(Request $request){

        $wrs = WeeklyReports::query()
//            ->where('mill_code','=',$mill_code)
            ->where('status','=',1)
            ->pluck('slug','week_ending');

        if(!$request->has('report_no') || !$request->has('crop_year')){
            return view('sms.admin.reports.pre_index')->with([
//                'mill_code' => $mill_code,
                'calendar' => $this->calendarService->byYear(),
                'submissions' => $wrs->toArray(),
            ]);
        }

        if($request->has('type') && $request->type == 'getContent'){
            return view('sms.admin.reports.content')->with([
               'report_no' => $request->report_no,
               'crop_year' => $request->crop_year,
            ]);
        }
        return view('sms.admin.reports.index');
    }
}