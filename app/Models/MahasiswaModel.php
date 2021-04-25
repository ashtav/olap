<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'mahasiswa';

    protected $fillable = [
        'id',
        'nim',
        'nama_mahasiswa',
        'jenis_kelamin',
    ];
}
