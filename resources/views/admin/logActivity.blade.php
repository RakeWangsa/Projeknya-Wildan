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
          <h1>Log Activity</h1>
       </div>
       {{-- <div class="col-auto">
          <a class="btn btn-primary" href="/pesananSaya/buatPesanan"><i class="bi bi-person-fill-add me-2"></i><span>Buat Pesanan</span></a>
       </div> --}}
    </div>
 </div>
</div>


<style>
   .table-container {
     max-height: 400px;
     overflow-y: scroll;
   }
   
   table {
     width: 100%;
     border-collapse: collapse;
   }
   
   th, td {
     padding: 8px;
     text-align: left;
     border-bottom: 1px solid #ddd;
   }
   
   th {
     background-color: #c3c3c3;
     position: sticky;
     top: 0;
   }
   
   </style>



<div class="row">
      <div class="card col-md-12 mt-2 pb-4">
         <div class="card-body">
             {{-- <h5 class="card-title">Log Activity</h5> --}}
             <div class="table-container border mt-4">
               <table>
                  <thead>
                    <tr>
                      <th scope="col" class="text-center">No</th>
                      <th scope="col" class="text-center">Nama</th>
                      <th scope="col" class="text-center">Activity</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                     @php($no=1)
                    @if(count($logActivity) > 0)
                      @foreach($logActivity as $item)
                        <tr>
                          <td scope="row" class="text-center">{{ $no++ }}</td>
                          <td class="text-center">{{ $item->nama }}</td>
                          <td class="text-center">{{ $item->activity }}</td>
                          <td class="text-center">
                           <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $item->id }}">
                              Detail
                            </button>
                          </td>
                        </tr>
                
                        <!-- Modal -->
                        <div class="modal fade" id="modal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 @if($item->activity == "Membuat Pesanan")
                                 <h1 class="modal-title fs-5" id="exampleModalLabel">Detail pesanan yang dibuat</h1>
                                 @elseif($item->activity == "Mengedit Pesanan")
                                 <h1 class="modal-title fs-5" id="exampleModalLabel">Detail pesanan yang diedit</h1>
                                 @elseif($item->activity == "Menghapus Pesanan")
                                 <h1 class="modal-title fs-5" id="exampleModalLabel">Detail pesanan yang dihapus</h1>
                                 @endif
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <p>ID Pesanan : {{ $item->id_pesanan }}</p>
                                 <p>Nama : {{ $item->nama }}</p>
                                 <p>Kontak : {{ $item->kontak }}</p>
                                 <p>Lokasi Penjemputan : {{ $item->lokasi }}</p>
                                 <p>Tujuan : {{ $item->tujuan }}</p>
                                 <p>Waktu : {{ $item->waktu }}</p>
                                 <p>Kendaraan : {{ $item->kendaraan }}</p>
                                 <p>Jenis Jasa : {{ $item->jenis }}</p>
                                 @if(isset($item->tanggal_pulang))
                                    <p>Tanggal Pulang : {{ $item->tanggal_pulang }}</p>
                                 @endif
                                 @if(isset($item->keterangan))
                                    <p>Keterangan : {{ $item->keterangan }}</p>
                                 @else
                                    <p>Keterangan : -</p>
                                 @endif
                                 <p>Status : {{ $item->status }}</p>
                              </div>
                              {{-- <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 <a class="btn btn-primary" a href="{{ route('prosesPesanan', ['id' => base64_encode($item->id)]) }}">Proses Pesanan</a>
                              </div> --}}
                           </div>
                           </div>
                        </div>
                      @endforeach
                    @else
                      <tr>
                        <td colspan="4" class="text-center">Tidak ada pesanan</td>
                      </tr>
                    @endif
                  </tbody>
                </table>
            </div>
         </div>
      </div>
</div>


 

@endsection