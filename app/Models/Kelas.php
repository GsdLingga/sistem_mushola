<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_kelas',
    ];
}
