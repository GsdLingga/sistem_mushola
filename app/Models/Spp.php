<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'spp';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_siswa',
        'tgl',
    ];
}
