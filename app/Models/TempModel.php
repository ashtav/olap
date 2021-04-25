<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'temp';

    protected $fillable = [
        'id',
        'nim',
        'nama_mahasiswa',
        'jenis_kelamin',
        'kps1',
        'kps2',
        'kps3',
        'kps4',
        'kps5',
        'kps6',
        'kps7',
        'kps8',
    ];
}
