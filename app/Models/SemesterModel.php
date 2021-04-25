<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemesterModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'semester';

    protected $fillable = [
        'id',
        'semester',
        'tahun_ajaran',
    ];
}
