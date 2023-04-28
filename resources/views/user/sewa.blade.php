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

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif



<div class="row">
      <div class="card col-md-12 mt-2 pb-4">
         <div class="card-body">
          @if(isset($pesanan))
            <form class="row g-3 mt-3" method="GET" action="{{ route('editPesananSubmit', ['id' => base64_encode($id)]) }}">
          @else
            <form class="row g-3 mt-3" method="GET" action="{{route('sewaSubmit')}}">
          @endif
              <div class="col-md-12"> <label for="nama" class="form-label">Nama :</label> <input type="text" class="form-control" id="nama" name="nama" @if(isset($pesanan[0]->nama)) value="{{ $pesanan[0]->nama }}" @else value="{{ old('nama') }}" @endif required></div>
              <div class="col-md-12"> <label for="kontak" class="form-label">Kontak :</label> <input type="text" class="form-control" id="kontak" name="kontak" @if(isset($pesanan[0]->kontak)) value="{{ $pesanan[0]->kontak }}" @else value="{{ old('kontak') }}" @endif required></div>
              <div class="col-md-12"> <label for="lokasi" class="form-label">Lokasi penjemputan :</label> <input type="text" class="form-control" id="lokasi" name="lokasi" @if(isset($pesanan[0]->lokasi)) value="{{ $pesanan[0]->lokasi }}" @else value="{{ old('lokasi') }}" @endif required></div>
              <div class="col-md-12"> <label for="tujuan" class="form-label">Tujuan :</label> <input type="text" class="form-control" id="tujuan" name="tujuan" @if(isset($pesanan[0]->tujuan)) value="{{ $pesanan[0]->tujuan }}" @else value="{{ old('tujuan') }}" @endif required></div>
              <div class="col-md-12"> <label for="waktu" class="form-label">Waktu :</label> <input type="datetime-local" class="form-control" id="waktu" name="waktu" @if(isset($pesanan[0]->waktu)) value="{{ $pesanan[0]->waktu }}" @else value="{{ old('waktu') }}" @endif required></div>
              <div class="col-md-12">
                  <label for="kendaraan" class="form-label">Kendaraan :</label> 
                  <select id="kendaraan" class="form-select" name="kendaraan" required>
                    @if(isset($pesanan[0]->kendaraan))
                      <option value="Mobil" @if($pesanan[0]->kendaraan=="Mobil") selected @endif>Mobil</option>
                      <option value="Mobil Pick Up" @if($pesanan[0]->kendaraan=="Mobil Pick Up") selected @endif>Mobil Pick Up</option>
                      <option value="Minibus" @if($pesanan[0]->kendaraan=="Minibus") selected @endif>Minibus</option>
                      <option value="Bus" @if($pesanan[0]->kendaraan=="Bus") selected @endif>Bus</option>
                      <option value="Truk" @if($pesanan[0]->kendaraan=="Truk") selected @endif>Truk</option>
                    @else
                      <option>Pilih Jenis Kendaraan!</option>
                      <option value="Mobil">Mobil</option>
                      <option value="Mobil Pick Up">Mobil Pick Up</option>
                      <option value="Minibus">Minibus</option>
                      <option value="Bus">Bus</option>
                      <option value="Truk">Truk</option>
                    @endif
                  </select>
              </div>
              <div class="col-md-12">
                <label for="jenis" class="form-label">Jenis Jasa :</label> 
                <select id="jenis" class="form-select" name="jenis" required>
                  @if(isset($pesanan[0]->jenis))
                    <option value="Antar" @if($pesanan[0]->jenis=="Antar") selected @endif>Antar</option>
                    <option value="Pulang-Pergi" @if($pesanan[0]->jenis=="Pulang-Pergi") selected @endif>Pulang-Pergi</option>
                    <option value="Kirim Barang" @if($pesanan[0]->jenis=="Kirim Barang") selected @endif>Kirim Barang</option>
                  @else
                    <option>Pilih Jenis Jasa!</option>
                    <option value="Antar">Antar</option>
                    <option value="Pulang-Pergi">Pulang-Pergi</option>
                    <option value="Kirim Barang">Kirim Barang</option>
                  @endif
                </select>
            </div>
            <div class="col-md-12" id="cek"> <label for="tanggal_pulang" class="form-label">Tanggal pulang :</label> <input type="datetime-local" class="form-control" id="tanggal_pulang" name="tanggal_pulang" @if(isset($pesanan[0]->tanggal_pulang)) value="{{ $pesanan[0]->tanggal_pulang }}" @else value="{{ old('tanggal_pulang') }}" @endif required></div>
            <div class="col-md-12"> <label for="keterangan" class="form-label">Keterangan Tambahan :</label> <input type="text" class="form-control" id="keterangan" name="keterangan" @if(isset($pesanan[0]->keterangan)) value="{{ $pesanan[0]->keterangan }}" @else value="{{ old('keterangan') }}" @endif></div>
            <div class="text-center mb-5 mt-4"> <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin?')">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
          </form>
         </div>
      </div>
</div>
<script>
  const jenisSelect = document.querySelector('#jenis');
  const tanggalPulangInput = document.querySelector('#cek');
  
  // Check if the selected option is "Pulang-Pergi" on page load
  if (jenisSelect.value === 'Pulang-Pergi') {
    tanggalPulangInput.style.display = 'block';
    tanggalPulangInput.querySelector('input').setAttribute('required', 'required');
  } else {
    tanggalPulangInput.style.display = 'none';
    tanggalPulangInput.querySelector('input').removeAttribute('required');
    tanggalPulangInput.querySelector('input').value = '';
  }
  
  // Add event listener to jenisSelect
  jenisSelect.addEventListener('change', function() {
    // Check if the selected option is "Pulang-Pergi"
    if (this.value === 'Pulang-Pergi') {
      tanggalPulangInput.style.display = 'block';
      tanggalPulangInput.querySelector('input').setAttribute('required', 'required');
    } else {
      tanggalPulangInput.style.display = 'none';
      tanggalPulangInput.querySelector('input').removeAttribute('required');
      tanggalPulangInput.querySelector('input').value = '';
    }
  });
  </script>
  
@endsection