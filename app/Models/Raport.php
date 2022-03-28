<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'raport';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_siswa',
        'nilai_bacaan',
        'nilai_hafalan',
        'nilai_praktek',
        'nilai_pai',
    ];
}
