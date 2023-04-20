<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.home', [
            'title' => 'Sewa Supir - Home',
            'active' => 'home',
        ]);
    }

    public function sewa()
    {
        return view('user.sewa', [
            'title' => 'Sewa Supir - Buat Pesanan',
            'active' => 'pesanan',
        ]);
    }

    public function sewaSubmit(Request $request)
    {
        if($request->jenis=='Pulang-Pergi'){
            Pesanan::insert([
                'nama' => $request->nama,
                'kontak' => $request->kontak,
                'lokasi' => $request->lokasi,
                'tujuan' => $request->tujuan,
                'waktu' => $request->waktu,
                'kendaraan' => $request->kendaraan,
                'jenis' => $request->jenis,
                'durasi' => $request->durasi,
                'keterangan' => $request->keterangan,
            ]);
        }else{
            Pesanan::insert([
                'nama' => $request->nama,
                'kontak' => $request->kontak,
                'lokasi' => $request->lokasi,
                'tujuan' => $request->tujuan,
                'waktu' => $request->waktu,
                'kendaraan' => $request->kendaraan,
                'jenis' => $request->jenis,
                'keterangan' => $request->keterangan,
            ]);
        }
        
        return view('user.home', [
            'title' => 'Sewa Supir - Pesanan Saya',
            'active' => 'pesanan',
        ]);
    }
}
