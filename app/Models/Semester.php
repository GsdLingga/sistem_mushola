<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'semester';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tahun_ajaran',
        'status'
    ];
}
