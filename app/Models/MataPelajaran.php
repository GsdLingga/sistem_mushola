<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'mata_pelajaran';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_pelajaran',
    ];
}
