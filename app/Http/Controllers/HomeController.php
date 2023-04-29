<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\LogActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
        ->where('status','Belum Diproses')
        ->select('*')
        ->get();
        $pesanan2 = DB::table('pesanan')
        ->whereNot('status','Belum Diproses')
        ->select('*')
        ->get();
        return view('admin.home', [
            'title' => 'Sewa Supir - Home (Admin)',
            'active' => 'home',
            'pesanan' => $pesanan,
            'pesanan2' => $pesanan2,
        ]);
    }

    public function logActivity()
    {
        $logActivity = DB::table('logActivity')
        ->select('*')
        ->get();
        return view('admin.logActivity', [
            'title' => 'Sewa Supir - Log Activity',
            'active' => 'home',
            'logActivity' => $logActivity,
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
        ->where('status','Belum Diproses')
        ->select('*')
        ->get();
        $pesanan2 = DB::table('pesanan')
        ->where('id_pemesan',$id)
        ->whereNot('status','Belum Diproses')
        ->select('*')
        ->get();
        return view('user.pesananSaya', [
            'title' => 'Sewa Supir - Pesanan Saya',
            'active' => 'pesanan',
            'pesanan' => $pesanan,
            'pesanan2' => $pesanan2,
        ]);
    }

    public function sewaSubmit(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi ',
            'kendaraan.required' => 'Pilih Jenis Kendaraan!',
            'kendaraan.not_in' => 'Pilih Jenis Kendaraan!',
            'jenis.required' => 'Pilih Jenis Jasa!',
            'jenis.not_in' => 'Pilih Jenis Jasa!',
        ];
        $this->validate($request, [
        'kendaraan' => ['required', Rule::notIn(['Pilih Jenis Kendaraan!'])],
        'jenis' => ['required', Rule::notIn(['Pilih Jenis Jasa!'])],
        ], $messages);


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
                'status' => 'Belum Diproses',
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
                'status' => 'Belum Diproses',
            ]);
        }
        $id_pesanan = DB::table('pesanan')
        ->where('id_pemesan',$id)
        ->orderBy('id','desc')
        ->pluck('id')
        ->first();
        LogActivity::insert([
            'id_pesanan' => $id_pesanan,
            'activity' => 'Membuat Pesanan',
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
            'status' => 'Belum Diproses',
        ]);
        
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
        $pesananSebelum = DB::table('pesanan')
        ->where('id',$id)
        ->select('*')
        ->get();
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
        
        LogActivity::insert([
            'id_pesanan' => $id,
            'activity' => 'Mengedit Pesanan',
            'nama' => $pesananSebelum[0]->nama,
            'id_pemesan' => $id_pemesan,
            'kontak' => $pesananSebelum[0]->kontak,
            'lokasi' => $pesananSebelum[0]->lokasi,
            'tujuan' => $pesananSebelum[0]->tujuan,
            'waktu' => $pesananSebelum[0]->waktu,
            'kendaraan' => $pesananSebelum[0]->kendaraan,
            'jenis' => $pesananSebelum[0]->jenis,
            'tanggal_pulang' => $pesananSebelum[0]->tanggal_pulang,
            'keterangan' => $pesananSebelum[0]->keterangan,
            'status' => 'Belum Diproses',

            'nama2' => $request->nama,
            'kontak2' => $request->kontak,
            'lokasi2' => $request->lokasi,
            'tujuan2' => $request->tujuan,
            'waktu2' => $waktu,
            'kendaraan2' => $request->kendaraan,
            'jenis2' => $request->jenis,
            'tanggal_pulang2' => $tanggal_pulang,
            'keterangan2' => $request->keterangan,
            'status2' => 'Belum Diproses',
        ]);
        return redirect('/pesananSaya')->with('success','Berhasil mengedit pemesanan');
    }

    public function hapusPesanan($id)
    {
        $email=session('email');
        $role = DB::table('users')
        ->where('email', $email)
        ->pluck('role')
        ->first();
        $id = base64_decode($id);

        $pesanan = DB::table('pesanan')
        ->where('id',$id)
        ->select('*')
        ->get();

        LogActivity::insert([
            'id_pesanan' => $id,
            'activity' => 'Menghapus Pesanan',
            'nama' => $pesanan[0]->nama,
            'id_pemesan' => $id,
            'kontak' => $pesanan[0]->kontak,
            'lokasi' => $pesanan[0]->lokasi,
            'tujuan' => $pesanan[0]->tujuan,
            'waktu' => $pesanan[0]->waktu,
            'kendaraan' => $pesanan[0]->kendaraan,
            'jenis' => $pesanan[0]->jenis,
            'tanggal_pulang' => $pesanan[0]->tanggal_pulang,
            'keterangan' => $pesanan[0]->keterangan,
            'status' => 'Belum Diproses',
        ]);
        Pesanan::where('id', $id)->delete();

        if($role=="admin"){
            return redirect('/home/admin')->with('success','Berhasil menghapus pesanan');
        }else{
            return redirect('/pesananSaya')->with('success','Berhasil menghapus pesanan');
        }
    }

    public function prosesPesanan($id)
    {
        $id = base64_decode($id);
        $pesanan = DB::table('pesanan')
        ->where('id',$id)
        ->select('*')
        ->get();
        return view('admin.prosesPesanan', [
            'title' => 'Sewa Supir - Proses Pesanan',
            'active' => 'home',
            'pesanan' => $pesanan,
            'id' => $id,
        ]);
    }

    public function prosesPesananSubmit($id, Request $request)
    {
        $messages = [
                'required' => ':attribute wajib diisi ',
                'status.required' => 'Pilih Jenis status!',
                'status.not_in' => 'Pilih Jenis status!',
            ];
        $this->validate($request, [
        'status' => ['required', Rule::notIn(['Pilih Status!'])],
        ], $messages);

        $id = base64_decode($id);
        $pesanan = Pesanan::find($id);
        $pesanan->status = $request->status;
        $pesanan->supir = $request->supir;
        $pesanan->kontaksupir = $request->kontaksupir;
        $pesanan->harga = $request->harga;
        $pesanan->keterangan2 = $request->keterangan2;
        $pesanan->save();
        return redirect('/home/admin')->with('success','Berhasil memproses pesanan');
    }

    public function statusDiterima($id)
    {
        $id = base64_decode($id);
        $pesanan = Pesanan::find($id);
        $pesanan->status = 'Diterima';
        $pesanan->save();
        return redirect('/home/admin')->with('success','Berhasil mengupdate status');
    }

    public function statusDitolak($id)
    {
        $id = base64_decode($id);
        $pesanan = Pesanan::find($id);
        $pesanan->status = 'Ditolak';
        $pesanan->save();
        return redirect('/home/admin')->with('success','Berhasil mengupdate status');
    }
}
