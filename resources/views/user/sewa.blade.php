@extends('layouts.main')

@section('container')
<div class="pagetitle mt-3">
   <div class="container">
      <div class="row align-items-center">
         <div class="col">
            <h1>Form Pesanan</h1>
         </div>
      </div>
   </div>
</div>



@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row">
      <div class="card col-md-12 mt-2 pb-4">
         <div class="card-body">
             <form class="row g-3 mt-3" method="GET" action="">
              <div class="col-md-12"> <label for="nama" class="form-label">Nama :</label> <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}"></div>
              <div class="col-md-12"> <label for="kontak" class="form-label">Kontak :</label> <input type="text" class="form-control" id="kontak" name="kontak" value="{{ old('kontak') }}"></div>
              <div class="col-md-12"> <label for="lokasi" class="form-label">Lokasi penjemputan:</label> <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"></div>
              <div class="col-md-12"> <label for="tujuan" class="form-label">Tujuan :</label> <input type="text" class="form-control" id="tujuan" name="tujuan" value="{{ old('tujuan') }}"></div>
              <div class="col-md-12"> <label for="waktu" class="form-label">Waktu :</label> <input type="datetime" class="form-control" id="waktu" name="waktu" value="{{ old('waktu') }}"></div>
              <div class="col-md-12">
                  <label for="Kendaraan" class="form-label">Kendaraan :</label> 
                  <select id="Kendaraan" class="form-select" name="Kendaraan">
                      <option>Pilih Kendaraan!</option>
                      <option value="Mobil">Mobil</option>
                      <option value="Minibus">Minibus</option>
                      <option value="Bus">Bus</option>
                      <option value="Truk">Truk</option>
                  </select>
              </div>
              <div class="col-md-12">
                <label for="Kendaraan" class="form-label">Jenis :</label> 
                <select id="Kendaraan" class="form-select" name="Kendaraan">
                    <option>Pilih Jenis!</option>
                    <option value="Pergi">Pergi</option>
                    <option value="Pulang-Pergi">Pulang-Pergi</option>
                    <option value="Pulang-Pergi">Kirim Barang</option>
                </select>
            </div>
            <div class="col-md-12"> <label for="durasi" class="form-label">Durasi :</label> <input type="number" size="1" id="durasi" name="durasi" value="0"> Hari</div>
            <div class="col-md-12"> <label for="keterangan" class="form-label">Keterangan Tambahan :</label> <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan') }}"></div>
            <div class="text-center mb-5 mt-4"> <button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
          </form>
         </div>
      </div>
</div>
@endsection