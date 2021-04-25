<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'alumni';

    protected $fillable = [
        'id',
        'id_absensi',
        'id_mahasiswa',
        'lama_kuliah',
        'tahun_lulus'
    ];
}
