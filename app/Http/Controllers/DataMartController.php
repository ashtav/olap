<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataCenter;
use App\Models\DetailDataCenter;
use App\Models\DataMart;
use Auth;

class DataMartController extends Controller
{
    public function index(){
        $dataCenter = DataCenter::get();
        $dataMart = DataMart::with('user')->latest()->get();
        return view('dashboard.data_mart', compact('dataCenter','dataMart')); 
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

    public function saveResult(Request $request){
        $input = $request->all();

        try {
            $input['created_by'] = Auth::id();

            DataMart::create($input);

            return response()->json([
                'message' => 'Berhasil disimpan'
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400); // pesan gagal
        }
    }
}
