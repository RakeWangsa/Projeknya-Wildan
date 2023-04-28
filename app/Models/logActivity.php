<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logActivity extends Model
{
    use HasFactory;
    protected $table = 'log_activity';
    protected $fillable = ['id', 'id_pesanan', 'activity','nama', 'id_pemesan', 'lokasi', 'tujuan', 'waktu', 'kontak','kendaraan','jenis','keterangan','tanggal_pulang','status'];
}
