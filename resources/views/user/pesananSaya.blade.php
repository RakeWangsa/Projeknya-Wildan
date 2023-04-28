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
          <h1>Pesanan Saya</h1>
       </div>
       <div class="col-auto">
          <a class="btn btn-primary" href="/pesananSaya/buatPesanan"><i class="bi bi-person-fill-add me-2"></i><span>Buat Pesanan</span></a>
       </div>
    </div>
 </div>
</div>


<style>
   .table-container {
     max-height: 300px;
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
             <h5 class="card-title">Daftar Pesanan Saya</h5>
             <div class="table-container border">
               <table>
                  <thead>
                    <tr>
                      <th scope="col" class="text-center">No</th>
                      <th scope="col" class="text-center">Nama</th>
                      <th scope="col" class="text-center">Tujuan</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                     @php($no=1)
                    @if(count($pesanan) > 0)
                      @foreach($pesanan as $item)
                        <tr>
                          <td scope="row" class="text-center">{{ $no++ }}</td>
                          <td class="text-center">{{ $item->nama }}</td>
                          <td class="text-center">{{ $item->tujuan }}</td>
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
                                 <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pesanan</h1>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
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
                              <div class="modal-footer">
                                 {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                 <a class="btn btn-primary" a href="{{ route('editPesanan', ['id' => base64_encode($item->id)]) }}">Edit</a>
                                 <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')" a href="{{ route('hapusPesanan', ['id' => base64_encode($item->id)]) }}">Batalkan Pesanan</a>
                              </div>
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
             {{-- <table>
                <thead>
                   <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Nama</th>
                    <th scope="col" class="text-center">Kontak</th>
                    <th scope="col" class="text-center">Lokasi Penjemputan</th>
                    <th scope="col" class="text-center">Tujuan</th>
                    <th scope="col" class="text-center">Waktu</th>
                    <th scope="col" class="text-center">Kendaraan</th>
                    <th scope="col" class="text-center">Jenis Jasa</th>
                    <th scope="col" class="text-center">Tanggal Pulang</th>
                    <th scope="col" class="text-center">Keterangan</th>
                    <th scope="col" class="text-center">Action</th>
                   </tr>
                </thead>
                
                <tbody>
                  @php($no=1)
                  @if(count($pesanan) > 0)
                  @foreach($pesanan as $item)
                   <tr>
                      <td scope="row" class="text-center">{{ $no++ }}</td>
                      <td class="text-center">{{ $item->nama }}</td>
                      <td class="text-center">{{ $item->kontak }}</td>
                      <td class="text-center">{{ $item->lokasi }}</td>
                      <td class="text-center">{{ $item->tujuan }}</td>
                      <td class="text-center">{{ $item->waktu }}</td>
                      <td class="text-center">{{ $item->kendaraan }}</td>
                      <td class="text-center">{{ $item->jenis }}</td>
                      @if(isset($item->tanggal_pulang))
                      <td class="text-center">{{ $item->tanggal_pulang }}</td>
                      @else
                      <td class="text-center">-</td>
                      @endif
                      @if(isset($item->keterangan))
                      <td class="text-center">{{ $item->keterangan }}</td>
                      @else
                      <td class="text-center">-</td>
                      @endif
                      <td class="text-center">
                        <a class="btn btn-warning" style="border-radius: 100px;" a href="{{ route('editPesanan', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-pencil-square text-white"></i></a>
                        <a class="btn btn-danger" style="border-radius: 100px;" onclick="return confirm('Apakah anda yakin?')" a href="{{ route('hapusPesanan', ['id' => base64_encode($item->id)]) }}"><i class="bi bi-trash"></i></a>
                     </td>
                   </tr>
                   @endforeach
                   @else
                   <tr>
                     <td colspan="12" class="text-center">Tidak ada pesanan</td>
                   </tr>
                   @endif
                </tbody>
             </table> --}}
            </div>
         </div>
      </div>
</div>

<div class="row">
   <div class="card col-md-12 mt-2 pb-4">
      <div class="card-body">
          <h5 class="card-title">Pesanan Selesai</h5>
          <div class="table-container border mt-4">
            <table>
               <thead>
                 <tr>
                   <th scope="col" class="text-center">No</th>
                   <th scope="col" class="text-center">Nama</th>
                   <th scope="col" class="text-center">Tujuan</th>
                   <th scope="col" class="text-center">Status</th>
                   <th scope="col" class="text-center">Action</th>
                 </tr>
               </thead>
               
               <tbody>
                  @php($no=1)
                 @if(count($pesanan2) > 0)
                   @foreach($pesanan2 as $item)
                     <tr>
                       <td scope="row" class="text-center">{{ $no++ }}</td>
                       <td class="text-center">{{ $item->nama }}</td>
                       <td class="text-center">{{ $item->tujuan }}</td>
                       <td class="text-center">{{ $item->status }}</td>
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
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pesanan</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
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
                              @if($item->status=='Diterima')
                              <p>Supir : {{ $item->supir }}</p>
                              <p>Kontak Supir : {{ $item->harga }}</p>
                              <p>Harga : {{ $item->harga }}</p>
                              <p>Keterangan (Supir) : {{ $item->keterangan2 }}</p>
                              @else
                              <p>Alasan Ditolak : {{ $item->keterangan2 }}</p>
                              @endif
                           </div>
                           <div class="modal-footer">
                              {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                              <button class="btn btn-primary" onclick="return alert('Pesanan sudah diproses, silahkan hubungi admin untuk melakukan perubahan')">Edit</button>
                              <button class="btn btn-danger" onclick="return alert('Pesanan sudah diproses, silahkan hubungi admin untuk menghapus pesanan')">Hapus Pesanan</button>
                           </div>
                        </div>
                        </div>
                     </div>
                   @endforeach
                 @else
                   <tr>
                     <td colspan="5" class="text-center">Tidak ada pesanan</td>
                   </tr>
                 @endif
               </tbody>
             </table>
         </div>
      </div>
   </div>
</div>

@endsection