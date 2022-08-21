<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'nilai';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_anggota_kelas',
        'id_mata_pelajaran',
        'nilai',
    ];
}
