<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataCenter;
use App\Models\DetailDataCenter;

class DataMartController extends Controller
{
    public function index(){
        $dataCenter = DataCenter::get();
        return view('dashboard.data_mart', compact('dataCenter')); 
    }

    public function chart(){
        return view('dashboard.chart_data_mart');
    }

    public function createChart(Request $request){
        try {
            $center = DataCenter::where(['tahun' => $request->tahun])->first();
            $detail = DetailDataCenter::where(['data_id' => $center->id])->get();

            return response()->json([
                'data' => $detail
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400); // pesan gagal
        }
    }
}
