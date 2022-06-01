<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class petugas extends Model
{
    protected $table = 'petugas';
    protected $primarykey = 'id_petugas';
    public $timestamps = false;
    protected $fillable = ['username','password','nama_petugas','level'];

    use HasFactory;
}
