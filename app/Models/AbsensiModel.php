<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'absensi';

    protected $fillable = [
        'id',
        'id_semester',
        'id_mahasiswa',
        'jumlah_kehadiran',
        'semester',
    ];
}
