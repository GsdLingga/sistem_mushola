<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'absensi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_siswa',
        'status',
        'tgl',
    ];
}
