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
             <form class="row g-3 mt-3" method="GET" action="{{route('sewaSubmit')}}">
              <div class="col-md-12"> <label for="nama" class="form-label">Nama :</label> <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required></div>
              <div class="col-md-12"> <label for="kontak" class="form-label">Kontak :</label> <input type="text" class="form-control" id="kontak" name="kontak" value="{{ old('kontak') }}" required></div>
              <div class="col-md-12"> <label for="lokasi" class="form-label">Lokasi penjemputan :</label> <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required></div>
              <div class="col-md-12"> <label for="tujuan" class="form-label">Tujuan :</label> <input type="text" class="form-control" id="tujuan" name="tujuan" value="{{ old('tujuan') }}" required></div>
              <div class="col-md-12"> <label for="waktu" class="form-label">Waktu :</label> <input type="datetime-local" class="form-control" id="waktu" name="waktu" value="{{ old('waktu') }}" required></div>
              <div class="col-md-12">
                  <label for="kendaraan" class="form-label">Kendaraan :</label> 
                  <select id="kendaraan" class="form-select" name="kendaraan" required>
                      <option>Pilih Kendaraan!</option>
                      <option value="Mobil">Mobil</option>
                      <option value="Mobil Pick Up">Mobil Pick Up</option>
                      <option value="Minibus">Minibus</option>
                      <option value="Bus">Bus</option>
                      <option value="Truk">Truk</option>
                  </select>
              </div>
              <div class="col-md-12">
                <label for="jenis" class="form-label">Jenis :</label> 
                <select id="jenis" class="form-select" name="jenis" required>
                    <option>Pilih Jenis!</option>
                    <option value="Pergi">Pergi</option>
                    <option value="Pulang-Pergi">Pulang-Pergi</option>
                    <option value="Kirim Barang">Kirim Barang</option>
                </select>
            </div>
            <div class="col-md-12" id="cek"> <label for="durasi" class="form-label">Durasi :</label> <input type="number" size="1" id="durasi" name="durasi" value="0" required> Hari</div>
            <div class="col-md-12"> <label for="keterangan" class="form-label">Keterangan Tambahan :</label> <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan') }}"></div>
            <div class="text-center mb-5 mt-4"> <button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
          </form>
         </div>
      </div>
</div>
<script>
const jenisSelect = document.querySelector('#jenis');
const durasiInput = document.querySelector('#cek');

// Hide the duration input initially
durasiInput.style.display = 'none';

// Add event listener to jenisSelect
jenisSelect.addEventListener('change', function() {
  // Check if the selected option is "Pulang-Pergi"
  if (this.value === 'Pulang-Pergi') {
    // Show the duration input
    durasiInput.style.display = 'block';
  } else {
    // Hide the duration input
    durasiInput.style.display = 'none';
  }
});

</script>
@endsection