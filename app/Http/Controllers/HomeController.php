<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DataCenter;

class HomeController extends Controller
{
    public function index(){
        $user = User::count();
        $center = DataCenter::count();

        return view('dashboard.home', compact('user','center'));
    }
}
