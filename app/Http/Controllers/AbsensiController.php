<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataCenter;
use App\Models\DetailDataCenter;
use App\Libraries\Helpers;

class AbsensiController extends Controller
{
    public function index(Request $request){

        $tahun = $request->has('tahun') ? $request->tahun : '2020';

        $dc = DataCenter::where(['tahun' => (int)$tahun])->first();
        $data = DetailDataCenter::where(['data_id' => $dc->id ?? 0])->get();
        
        return view('dashboard.data_absensi', compact('data', 'tahun')); // tampilkan halaman data center
    }

    public function store(Request $request){ // simpan data
        try {
            $input = $request->except('data'); // get data kecuali property data
            $input['nama_file'] = ucwords($input['nama_file']); // set ucwords pada nama file

            $dc = DataCenter::where(['tahun' => $input['tahun']]);
            // $id_dc = $dc ?? $dc->first()->id;
            $id_dc;

            // UPDATE : jika data dengan tahun yang sama sudah ada pada database -> hapus
            if($dc->count() > 0){
                $id_dc = $dc->first()->id;

                DataCenter::where(['tahun' => $input['tahun']])->forceDelete();
                DetailDataCenter::where(['data_id' => $id_dc])->forceDelete(); // hapus detail data center
            }

            $data = DataCenter::create($input);

            $input = $request->only('data'); // get hanya property data
            foreach (json_decode($input['data']) as $key => $d) { // looping
                if($d->nama != null || $d->nama != ''){
                    DetailDataCenter::create([
                        'data_id' => $data->id ?? $id_dc,
                        'nama' => $d->nama,
                        'alamat' => $d->alamat,
                        'kota' => $d->kota,
                        'gps' => $d->gps,
                        'tanggal_lahir' => Helpers::excelDate($d->tanggal_lahir ?? 0),
                        'jenis_kelamin' => $d->jenis_kelamin,
                        'asal_sekolah' => $d->asal_sekolah,
                        'pekerjaan_orang_tua' => $d->pekerjaan_orang_tua
                    ]); // simpan
                }
            }

            return response()->json([ // pesan berhasil
                'message' => 'Data berhasil ditambahkan',
                'data' => $dc->count()
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400); // pesan gagal
        }
    }

    public function destroy($tahun){
        $id = DataCenter::where(['tahun' => $tahun == 'null' ? 2020 : $tahun])->first()->id ?? null;

        if(!$id){
            return response()->json([
                'message' => 'Tidak ada data tahun '.($tahun ?? '2020')
            ], 404);
        } 

        try {
            DataCenter::find($id)->forceDelete(); //hapus data center
            DetailDataCenter::where(['data_id' => $id])->delete(); // hapus detail data center

            return response()->json([
                'message' => 'Data berhasil dihapus'
            ], 201);

        } catch (\Throwable $th) {
            return response()->json(['error' => $e->getMessage()], 400); // pesan gagal
        }
    }
}
