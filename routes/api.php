<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetForm1Controller;


// Employee
Route::get('/employee/serviceRecord/{slug}/edit', 'Api\ApiEmployeeController@editServiceRecord')
		->name('api.employee_serviceRecord_edit');


Route::get('/employee/training/{slug}/edit', 'Api\ApiEmployeeController@editTraining')
		->name('api.employee_training_edit');




// User
Route::get('/user/response_from_employee/{slug}', 'Api\ApiUserController@responseFromEmployee')
		->name('api.user_response_from_employee');




// Submenu
Route::get('/submenu/select_submenu_byMenuId/{menu_id}', 'Api\ApiSubmenuController@selectSubmenuByMenuId')
		->name('selectSubmenuByMenuId');




// Department Unit
Route::get('/department_unit/select_departmentUnit_byDeptName/{dept_name}', 'Api\ApiDepartmentUnitController@selectDepartmentUnitByDepartmentName')
		->name('selectDepartmentUnitByDepartmentName');


Route::get('/department_unit/select_departmentUnit_byDeptId/{dept_id}', 'Api\ApiDepartmentUnitController@selectDepartmentUnitByDepartmentId')
		->name('selectDepartmentUnitByDepartmentId');




// Project Code
Route::get('/project_code/select_projectCode_byDeptName/{dept_name}', 'Api\ApiProjectCodeController@selectProjectCodeByDepartmentName')
		->name('selectProjectCodeByDepartmentName');




// Department
Route::get('/department/textbox_department_ByDepartmentId/{dept_id}', 'Api\ApiDepartmentController@textboxDepartmentByDepartmentId')
		->name('textboxDepartmentByDepartmentId');


//API SMS FOR BULLETIN 10-14-2024 LOUIS
//use App\Http\Controllers\GetForm2Controller;
//Route::get('/form-data', [GetForm2Controller::class, 'getAllData']);

//API SMS FOR BULLETIN 11-13-2024 LOUIS
Route::get('/form1-data', [\App\Http\Controllers\Api\ApiForm1Controller::class, 'sendData']);