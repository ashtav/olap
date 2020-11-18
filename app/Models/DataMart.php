<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMart extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'data_mart';

    protected $fillable = [
        'id',
        'judul',
        'berdasarkan',
        'data',
        'created_by'
    ];

    public function user(){
        return $this->hasOne('App\Models\UserDetails', 'user_id','created_by');
    }
}
