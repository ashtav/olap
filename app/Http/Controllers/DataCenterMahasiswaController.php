<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataCenter;
use App\Models\DetailDataCenter;
use App\Models\MahasiswaModel;
use App\Models\SemesterModel;
use App\Models\AbsensiModel;
use App\Models\AlumniModel;
use App\Libraries\Helpers;

class DataCenterMahasiswaController extends Controller
{
    public function index(Request $request){
        $data = MahasiswaModel::get();
        
        return view('dashboard.data_center_mahasiswa', compact('data')); // tampilkan halaman data center
    }

    public function destroy(){
        MahasiswaModel::truncate();
        AbsensiModel::truncate();
        SemesterModel::truncate();
        AlumniModel::truncate();
    }

    public function index1(){
        $dataMart = [];
        return view('dashboard.data_mart_absensi', compact('dataMart'));
    }
}
