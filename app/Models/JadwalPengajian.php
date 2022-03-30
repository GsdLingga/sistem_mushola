<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPengajian extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'jadwal_pengajian';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'start',
    ];
}
