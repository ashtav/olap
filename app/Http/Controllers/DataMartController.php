<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataMartController extends Controller
{
    public function index(){
        return view('dashboard.data_mart'); 
    }
}
