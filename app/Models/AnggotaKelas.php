<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKelas extends Model
{
    use HasFactory;
    protected $table = 'anggota_kelas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kelas',
        'id_siswa',
        'id_semester'
    ];
}
