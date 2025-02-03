<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GetForms\GetForm1Controller;

class ApiForm1Controller extends Controller
{
    public $getForm1Controller;
    public function __construct(GetForm1Controller $getForm1Controller){
        $this->getForm1Controller=$getForm1Controller;
    }
//    public function sendData(){
//        return $this->getForm1Controller->getForm1("I0v5BQSnSsNx2adL");
//    }

    public function sendData(){
        return $this->getForm1Controller->getForm1("InputDataHere");
    }
}