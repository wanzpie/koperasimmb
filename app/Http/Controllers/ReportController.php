<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
     public function __construct()
    {
        if(Session::get('id') == ''){
            Session::flush();
            redirect('godigital.metropolitanland.com');
        }
//        $this->middleware('auth');
    }


}
