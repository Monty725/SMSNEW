<?php


namespace App\Http\Controllers;


use App\Http\Requests\MisRequests\MisRequestsFormRequest;
use App\Models\MisRequests;
use App\Models\MisRequestsNature;
use App\Models\MisRequestsStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class MisRequestsController extends Controller
{
    public function myRequests(){
        if(\request()->ajax() && \request()->has('draw')){
            $mis_requests = MisRequests::with('status')->where('user_created','=',Auth::user()->user_id);
            return DataTables::of($mis_requests)
                ->addColumn('action',function ($data){
                    if($data->cancelled_at != null){
                        return '<p class="text-muted no-margin">Cancelled</p>';
                    }
                    return '<div class="btn-group">
                            <button class="btn btn-default btn-sm status_btn" data="'.$data->slug.'" data-toggle="modal" data-target="#status_modal"><i class="fa fa-refresh"></i> Status</button>
                            <button class="btn btn-default btn-sm print_request_btn" data="'.$data->slug.'" text="Request no: <b>'.$data->request_no.'</b>"><i class="fa fa-print"></i> Print</button>
                        </div>';
                })
                ->addColumn('status', function ($data){
                   $status = $data->status()->orderBy('created_at','desc')->first();
                   if(!empty($status)){
                       return $status->status;
                   }
                })
                ->editColumn('created_at',function ($data){
                    return Carbon::parse($data->created_at)->format('M. d, Y | h:i A');
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }
        return view('dashboard.mis_requests.my_requests');
    }

    public  function store(MisRequestsFormRequest $request){
        $r = new MisRequests;
        $r->slug = Str::random(16);
        $r->request_no = $this->createNewRequstNo();;
        $r->nature_of_request = MisRequestsNature::query()->where('slug','=',$request->nature_of_request)->first()->nature_of_request;
        $r->requisitioner = Auth::user()->user_id;
        $r->request_details = $request->details;
        if($r->save()){
            return $r->only(['slug','request_no']);
        }
        abort(503,'Error creating request.');
    }


    private function createNewRequstNo(){

        $r = MisRequests::query()->orderBy('id','desc')->first();
        if(empty($r)){
            $new_no = Carbon::now()->format('Y').'-0001';
        }else{
            if(explode('-',$r->request_no)[0] == Carbon::now()->format('Y')){
                $new_no =  Carbon::now()->format('Y').'-'.str_pad(explode('-',$r->request_no)[1]+1,4,'0',STR_PAD_LEFT);
            }else{
                $new_no = Carbon::now()->format('Y').'-0001';
            }
        }
        return $new_no;
    }

    private  function findBySlug($slug){
        $r = MisRequests::with('status')->where('slug','=',$slug)->first();
        if(empty($r)){
            abort(503,'Service request not found.');
        }
        return $r;
    }

    public function cancelRequest(Request $request){
        $r = $this->findBySlug($request->id);
        $r->cancelled_at = Carbon::now();
        if($r->update()){
            return 'Request has been cancelled successfully.';
        }
        abort(503,'Service request not found.');
    }

    public function printRequestForm($slug){
        $r = $this->findBySlug($slug);
        return view('printables.mis_requests.print')->with([
            'r' => $r,
        ]);
    }

    public function index(){
        if(\request()->ajax() && \request()->has('draw')){
            $mis_requests = MisRequests::query();
            $request = \request();
            $table = DB::select('SELECT * FROM (
                        SELECT x.lastname, x.firstname, x.employee_no, users.user_id FROM (
                            SELECT hr_employees.lastname, hr_employees.firstname, hr_employees.employee_no FROM hr_employees WHERE hr_employees.employee_no != \'\'
                            UNION
                            SELECT hr_jo_employees.lastname, hr_jo_employees.firstname, hr_jo_employees.employee_no FROM hr_jo_employees
                        ) as x
                        LEFT JOIN users ON users.employee_no = x.employee_no
                        WHERE user_id != ""
                    ) as y
                    RIGHT JOIN mis_requests ON mis_requests.requisitioner = y.user_id;');

            return DataTables::of($table)
                ->addColumn('action',function ($data){

                    return '<div class="btn-group">
                            <button class="btn btn-default btn-sm print_request_btn" data="'.$data->slug.'" text="Request no: <b>'.$data->request_no.'</b>"><i class="fa fa-print"></i></button>
                            <button class="btn btn-default btn-sm status_btn" data="'.$data->slug.'" text="Request no: <b>'.$data->request_no.'</b>" data-target="#status_modal" data-toggle="modal" title="Status" data-placement="top" ><i class="fa fa-refresh"></i></button>
                            <button class="btn btn-default btn-sm edit_request_btn" data="'.$data->slug.'" data-target="#edit_request_modal" data-toggle="modal" ><i class="fa fa-edit"></i></button>
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                  <li><a href="#" default_text="'.$data->recommendations.'" class="update_status_btn" data="'.$data->slug.'" request_no="'.$data->request_no.'">Update Status</a></li>
                                  <li><a href="#" data-toggle="modal" data-target="#trainings_modal" class="mark_as_done_btn" data="'.$data->slug.'" request_no="'.$data->request_no.'">Mark as completed</a></li>
                                </ul>
                            </div>
                        </div>';
                })
                ->addColumn('status', function ($data){
                    $status = MisRequestsStatus::query()->where('request_slug','=',$data->slug)->orderBy('created_at','desc')->first();
                    if(!empty($status)){
                        return $status->status;
                    }
                })
                ->editColumn('created_at',function ($data){
                    return Carbon::parse($data->created_at)->format('M. d, Y | h:i A');
                })
                ->editColumn('fullname',function ($data){
                    if($data->lastname == '' && $data->firstname == ''){
                        $user = User::query()->where('user_id','=',$data->requisitioner)->first();
                        if(!empty($user)){
                            return $user->lastname.', '.$user->firstname;
                        }
                        return $data->requisitioner;
                    }
                    return $data->lastname.', '.$data->firstname;
                })
                ->editColumn('nature_of_request',function ($data){
                    $success = '';
                    if($data->completed_at != null){
                        $success = '<span class="text-success pull-right"><i class="fa  fa-check-circle"></i></span>';
                    }
                    if($data->request_details != ''){
                        return '<div>'.$data->nature_of_request.' '.$success.'
                                <div class="table-subdetail">
                                    '.$data->request_details.'
                                </div>
                            </div>';
                    }
                    return $data->nature_of_request.$success;
                })

                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }
        return view('dashboard.mis_requests.index');
    }

    private function findCreator($slug){
        $r =  $this->findBySlug($slug);
        if(!empty($r)){
            $requisitioner = $r->requisitioner;
            $user = User::query()->where('user_id','=',$requisitioner)->first();
            if(!empty($user)){
                if(!empty($user->employee)){
                    return $user->lastname.', '.$user->firstname;
                }
                if(!empty($user->joEmployee)){
                    return $user->lastname.', '.$user->firstname;
                }
            }
            return $requisitioner;
        }
    }

    public function update(Request $request,$slug){
        if($request->has('update_status') && $request->update_status == true){
            if($request->status == ''){
                abort(503,'This field is required');
            }
            $ts = $this->touchStatus($request->status,$slug);
            if($ts){
                return [
                    'slug' => $slug,
                ];
            }
        }

        if($request->has('mark_as_done') && $request->mark_as_done == true){
            $r = $this->findBySlug($slug);
            $r->completed_at = Carbon::now();
            $r->user_completed = Auth::user()->user_id;
            if($r->update()){
                $this->touchStatus('Service request ticket was closed.',$slug);
                return $r->only('slug');
            }
            abort(503,'Error marking as done.');
        }

        $r = $this->findBySlug($slug);
        $r->recommendations = $request->recommendations;
        $r->summary_of_diagnostics = $request->summary_of_diagnostics;
        $r->returned = $request->returned;
        $r->date_returned = $request->date_returned;
        if($r->update()){
            if(count($r->getChanges()) > 1){
                $changes = $r->getChanges();
                foreach ($changes as $field => $value){
                    $new_key = str_replace('_',' ',$field);
                    $new_key = ucwords($new_key);
                    if($field != 'updated_at' && $field != 'user_updated' && $field != 'ip_updated'){
                        $this->touchStatus($new_key.': '.$value,$slug);
                    }
                }
            }
            $return = [
                'slug' => $slug,
                'summary_of_diagnostics' => $r->summary_of_diagnostics,
                'returned'=> $r->returned,
                'date_returned' => $r->date_returned,
                'recommendations' => $r->recommendations,
                'status' => $r->status()->first()->status,
            ];
            return $return;

        }
        abort(503, 'Error updating data.');

    }

    private function touchStatus($status_text,$request_slug){
        $mis_r_s = new MisRequestsStatus;
        $mis_r_s->status = $status_text;
        $mis_r_s->slug = Str::random(16);
        $mis_r_s->request_slug = $request_slug;
        $mis_r_s->user_created = Auth::user()->user_id;
        $mis_r_s->ip_created = request()->ip();
        if($mis_r_s->save()){
            return $mis_r_s->only('slug');
        }
    }

    public function edit($slug){
        $r = $this->findBySlug($slug);
        $requisitioner = $this->findCreator($slug);
        return view('dashboard.mis_requests.edit')->with([
            'r' => $r,
            'requisitioner' => $requisitioner,
        ]);
    }

}