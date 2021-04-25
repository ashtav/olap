<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataCenter;
use App\Models\DetailDataCenter;
use App\Models\TempModel;
use App\Models\MahasiswaModel;
use App\Models\SemesterModel;
use App\Models\AbsensiModel;
use App\Models\AlumniModel;
use App\Libraries\Helpers;

class DataCenterController extends Controller
{
    public function index(Request $request){

        $tahun = $request->has('tahun') ? $request->tahun : '2020';

        $dc = DataCenter::where(['tahun' => (int)$tahun])->first();
        $data = DetailDataCenter::where(['data_id' => $dc->id ?? 0])->get();
        
        return view('dashboard.data_center', compact('data', 'tahun')); // tampilkan halaman data center
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

    public function storeAbsensi(Request $request){
        // foreach (json_decode($request->data) as $key => $d) { // looping
        //     TempModel::create([
        //         'nim' => $d->nim,
        //         'nama_mahasiswa' => $d->nama_mahasiswa,
        //         'jenis_kelamin' => $d->jenis_kelamin,
        //         'kps1' => $d->kps1,
        //         'kps2' => $d->kps2,
        //         'kps3' => $d->kps3,
        //         'kps4' => $d->kps4,
        //         'kps5' => $d->kps5,
        //         'kps6' => $d->kps6,
        //         'kps7' => $d->kps7,
        //         'kps8' => $d->kps8
        //     ]); // simpan
        // }

        $data = TempModel::get();

        // get data mahasiswa
        // $mhs = [];
        $semester = [
            ['id' => 1, 'semester' => 1, 'tahun_ajaran' => 2011],
            ['id' => 2, 'semester' => 2, 'tahun_ajaran' => 2011],
            ['id' => 3, 'semester' => 3, 'tahun_ajaran' => 2012],
            ['id' => 4, 'semester' => 4, 'tahun_ajaran' => 2012],
            ['id' => 5, 'semester' => 5, 'tahun_ajaran' => 2013],
            ['id' => 6, 'semester' => 6, 'tahun_ajaran' => 2013],
            ['id' => 7, 'semester' => 7, 'tahun_ajaran' => 2014],
            ['id' => 8, 'semester' => 8, 'tahun_ajaran' => 2014]
        ];

        MahasiswaModel::truncate();
        AbsensiModel::truncate();
        SemesterModel::truncate();
        AlumniModel::truncate();

        foreach ($semester as $key => $d) {
            $smsInput = [
                'id' => $d['id'],
                'semester' => $d['semester'],
                'tahun_ajaran' => $d['tahun_ajaran'],
            ];

            SemesterModel::create($smsInput);
        }

        foreach ($data as $key => $d) {
            $mhsInput = [
                'nim' => $d->nim,
                'nama_mahasiswa' => $d->nama_mahasiswa,
                'jenis_kelamin' => $d->jenis_kelamin
            ];

            $mhs = MahasiswaModel::create($mhsInput);

            $k = [$d->kps1,$d->kps2,$d->kps3,$d->kps4,$d->kps5,$d->kps6,$d->kps7,$d->kps8];

            $lamaK = 0;
            // $jmlK = (array_sum($k) / 800) * 100;

            for ($i=0; $i < count($k); $i++) {
                $getSms = SemesterModel::where(['semester' => ($i + 1)])->first();

                $absInput = [
                        'id_semester' => $getSms->id,
                        'id_mahasiswa' => $mhs->id,
                        'jumlah_kehadiran' => $k[$i],
                        'semester' => $getSms->semester
                ];

                $abs = AbsensiModel::create($absInput);

                if($k[$i] != 0){
                    $lamaK++;
                }
            }

            $almInput = [
                'id_mahasiswa' => $mhs->id,
                'lama_kuliah' => $lamaK,
                'tahun_lulus' => 2014,
            ];

            if($lamaK >= 8){
                AlumniModel::create($almInput);
            }
        }

        // SemesterModel::truncate();

        foreach ($semester as $key => $d) {
            $smsInput = [
                'semester' => $d['semester'],
                'tahun_ajaran' => $d['tahun_ajaran'],
            ];
            // SemesterModel::create($smsInput);
        }





        return response()->json([
            'data' => $data,
            'message' => 'Data berhasil disimpan'
        ], 201);
    }
}
