@extends('layouts.main')

@section('container')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="pagetitle mt-3">
   <div class="container">
      <div class="row align-items-center">
         <div class="col">
            <h1>Form Pesanan</h1>
         </div>
      </div>
   </div>
</div>





<div class="row">
      <div class="card col-md-12 mt-2 pb-4">
         <div class="card-body">
            <form class="row g-3 mt-3" method="GET" action="{{ route('prosesPesananSubmit', ['id' => base64_encode($id)]) }}">
              <div class="col-md-12">
                <label for="status" class="form-label">Status :</label> 
                <select id="status" class="form-select" name="status" required>
                  <option>Pilih Status!</option>
                  <option value="Diterima">Diterima</option>
                  <option value="Ditolak">Ditolak</option>
                </select>
              </div>
              <div class="col-md-12"> <label for="supir" class="form-label">Supir :</label> <input type="text" class="form-control" id="supir" name="supir" value="{{ old('supir') }}" required></div>
              <div class="col-md-12"> <label for="harga" class="form-label">Kontak Supir :</label> <input type="text" class="form-control" id="kontaksupir" name="kontaksupir" value="{{ old('kontaksupir') }}" required></div>
              <div class="col-md-12"> <label for="harga" class="form-label">Harga :</label> <input type="text" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" required></div>
              <div class="col-md-12"> <label for="keterangan2" class="form-label">Keterangan :</label> <input type="text" class="form-control" id="keterangan2" name="keterangan2" value="{{ old('keterangan2') }}" required></div>
              <div class="text-center mb-5 mt-4"> <button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
          </form>
         </div>
      </div>
</div>
  
@endsection