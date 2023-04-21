<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;

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

    public function pesananSaya()
    {
        $email=session('email');
        $id = DB::table('users')
        ->where('email',$email)
        ->pluck('id')
        ->first();
        $pesanan = DB::table('pesanan')
        ->where('id_pemesan',$id)
        ->select('*')
        ->get();
        return view('user.pesananSaya', [
            'title' => 'Sewa Supir - Pesanan Saya',
            'active' => 'pesanan',
            'pesanan' => $pesanan,
        ]);
    }

    public function sewaSubmit(Request $request)
    {
        $email=session('email');
        $id = DB::table('users')
        ->where('email',$email)
        ->pluck('id')
        ->first();
        $waktu = date('Y-m-d H:i:s', strtotime($request->waktu));
        
        if($request->jenis=='Pulang-Pergi'){
            Pesanan::insert([
                'nama' => $request->nama,
                'id_pemesan' => $id,
                'kontak' => $request->kontak,
                'lokasi' => $request->lokasi,
                'tujuan' => $request->tujuan,
                'waktu' => $waktu,
                'kendaraan' => $request->kendaraan,
                'jenis' => $request->jenis,
                'tanggal_pulang' => $request->tanggal_pulang,
                'keterangan' => $request->keterangan,
            ]);
        }else{
            Pesanan::insert([
                'nama' => $request->nama,
                'id_pemesan' => $id,
                'kontak' => $request->kontak,
                'lokasi' => $request->lokasi,
                'tujuan' => $request->tujuan,
                'waktu' => $waktu,
                'kendaraan' => $request->kendaraan,
                'jenis' => $request->jenis,
                'tanggal_pulang' => '-',
                'keterangan' => $request->keterangan,
            ]);
        }
        
        return redirect('/pesananSaya')->with('success','Berhasil melakukan pemesanan');
    }
}
