<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $fillable = ['id','nama', 'id_pemesan', 'lokasi', 'tujuan', 'waktu', 'kontak','kendaraan','jenis','keterangan','tanggal_pulang','status','supir','harga','keterangan2','kontaksupir'];
}
