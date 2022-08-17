<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pengajar';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user',
        'id_kelas',
        'id_semester',
    ];
}
