<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $table = 'kelas';
    protected $primarykey = 'id_kelas';
    public $timestamps = false;
    protected $fillable = ['nama_kelas','jurusan','angkatan'];

    use HasFactory;
}

