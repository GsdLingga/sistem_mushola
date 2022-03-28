<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zakat extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'zakat';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'tgl',
        'ket',
    ];
}
