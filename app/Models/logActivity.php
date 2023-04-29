<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logActivity extends Model
{
    use HasFactory;
    protected $table = 'logActivity';
    protected $fillable = ['id', 'waktusubmit', 'id_pesanan', 'activity','nama', 'id_pemesan', 'lokasi', 'tujuan', 'waktu', 'kontak','kendaraan','jenis','keterangan','tanggal_pulang','status','nama2', 'lokasi2', 'tujuan2', 'waktu2', 'kontak2','kendaraan2','jenis2','keterangan2','tanggal_pulang2','status2'];
}
