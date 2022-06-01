<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    protected $table = 'siswa';
    protected $primarykey = 'nisn';
    public $timestamps = false;
    protected $fillable = ['nis','nama','id_kelas','alamat','no_tlp'];

    use HasFactory;
}
