<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spp extends Model
{
    protected $table = 'spp';
    protected $primarykey = 'id_spp';
    public $timestamps = false;
    protected $fillable = ['angkatan','tahun','nominal'];

    use HasFactory;
}
