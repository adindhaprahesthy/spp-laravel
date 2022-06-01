<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primarykey = 'id_pembayaran';
    public $timestamps = false;
    protected $fillable = ['id_petugas','nisn','tgl_bayar','bulan_spp','tahun_spp'];

    use HasFactory;
}
