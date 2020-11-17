<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDataCenter extends Model
{
    use HasFactory;

    protected $table = 'detail_data_center';

    protected $fillable = [
        'id',
        'data_id',
        'nama',
        'alamat',
        'kota',
        'gps',
        'tanggal_lahir',
        'jenis_kelamin',
        'asal_sekolah',
        'pekerjaan_orang_tua',
    ];

}
