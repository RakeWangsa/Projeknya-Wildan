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

    public function homeAdmin()
    {
        $pesanan = DB::table('pesanan')
        ->select('*')
        ->get();
        return view('admin.home', [
            'title' => 'Sewa Supir - Home (Admin)',
            'active' => 'home',
            'pesanan' => $pesanan,
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
        $tanggal_pulang = date('Y-m-d H:i:s', strtotime($request->tanggal_pulang));
        
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
                'tanggal_pulang' => $tanggal_pulang,
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
                'keterangan' => $request->keterangan,
            ]);
        }
        
        return redirect('/pesananSaya')->with('success','Berhasil melakukan pemesanan');
    }

    public function editPesanan($id)
    {
        $id = base64_decode($id);
        $pesanan = DB::table('pesanan')
        ->where('id',$id)
        ->select('*')
        ->get();

        return view('user.sewa', [
            'title' => 'Sewa Supir - Edit Pesanan',
            'active' => 'pesanan',
            'pesanan' => $pesanan,
            'id' => $id,
        ]);
    }

    public function editPesananSubmit($id, Request $request)
    {
        $id = base64_decode($id);
        $email=session('email');
        $id_pemesan = DB::table('users')
        ->where('email',$email)
        ->pluck('id')
        ->first();
        $waktu = date('Y-m-d H:i:s', strtotime($request->waktu));
        $tanggal_pulang = date('Y-m-d H:i:s', strtotime($request->tanggal_pulang));
        $pesanan = Pesanan::findOrFail($id);
        
        if($request->jenis=='Pulang-Pergi'){
            $pesanan->nama = $request->nama;
            $pesanan->kontak = $request->kontak;
            $pesanan->lokasi = $request->lokasi;
            $pesanan->tujuan = $request->tujuan;
            $pesanan->waktu = $waktu;
            $pesanan->kendaraan = $request->kendaraan;
            $pesanan->jenis = $request->jenis;
            $pesanan->tanggal_pulang = $tanggal_pulang;
            $pesanan->keterangan = $request->keterangan;
            $pesanan->update();
        }else{
            $pesanan->nama = $request->nama;
            $pesanan->kontak = $request->kontak;
            $pesanan->lokasi = $request->lokasi;
            $pesanan->tujuan = $request->tujuan;
            $pesanan->waktu = $waktu;
            $pesanan->kendaraan = $request->kendaraan;
            $pesanan->jenis = $request->jenis;
            $pesanan->tanggal_pulang = NULL;
            $pesanan->keterangan = $request->keterangan;
            $pesanan->update();
        }
        
        return redirect('/pesananSaya')->with('success','Berhasil mengedit pemesanan');
    }

    public function hapusPesanan($id)
    {
        $id = base64_decode($id);
        Pesanan::where('id', $id)->delete();

        return redirect('/pesananSaya')->with('success','Berhasil menghapus pesanan');
    }
}
