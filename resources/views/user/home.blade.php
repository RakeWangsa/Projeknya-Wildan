@extends('layouts.main')

@section('container')
<div class="pagetitle mt-3">
   <div class="container">
      <div class="row align-items-center">
         <div class="col">
            <h1>Home</h1>
         </div>
      </div>
   </div>
</div>



{{-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}

<div class="row">
      <div class="card col-md-12 mt-2 pb-4">
         <div class="card-body">
             <h5 class="card-title">Tentang "Sewa Supir"</h5>
             <div class="table-container border" style="border-radius: 20px">
               <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                  <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                      aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                      aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                      aria-label="Slide 3"></button>
                  </div>
                  <div class="carousel-inner" style="border-radius: 20px">
                    <div class="carousel-item active">
                      <img src="{{asset('admintemplate/img/slide1.jpg')}}" class="d-block w-100" alt="gambar1" style="height:450px">
                      <div class="carousel-caption d-none d-md-block">
                        <h3 class="text-warning font-weight-bold" style="-webkit-text-stroke: 1px yellow; text-stroke: 1px yellow;">Kami menyediakan layanan penyewaan supir yang handal dan terlatih untuk mengantar anda ke tujuan.</h3>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <img src="{{asset('admintemplate/img/slide2.jpg')}}" class="d-block w-100" alt="gambar2" style="height:450px">
                      <div class="carousel-caption d-none d-md-block">
                        <h3 class="text-warning font-weight-bold" style="-webkit-text-stroke: 1px yellow; text-stroke: 1px yellow;">Kami memiliki tim supir yang profesional dan berpengalaman dalam mengemudikan berbagai jenis kendaraan, termasuk mobil pribadi, bus, minibus, dan kendaraan khusus. </h3>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <img src="{{asset('admintemplate/img/slide3.jpg')}}" class="d-block w-100" alt="gambar3" style="height:450px">
                      <div class="carousel-caption d-none d-md-block">
                        <h3 class="text-warning font-weight-bold" style="-webkit-text-stroke: 1px yellow; text-stroke: 1px yellow;">Kami juga memiliki jaringan supir yang luas dan terlatih di berbagai kota di Indonesia</h3>

                      </div>
                    </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
            </div>

            <div class="text-justify mt-4 mb-4 animate__animated animate__fadeIn">
               <p>Sewa Supir adalah solusi terbaik untuk kebutuhan transportasi Anda. Kami memahami bahwa perjalanan Anda adalah hal yang penting, oleh karena itu kami menyediakan layanan supir yang terlatih dan profesional untuk membantu Anda dalam perjalanan bisnis, perjalanan wisata, atau sekadar berkendara dengan aman dan nyaman.</p>
               
               <p>Kami memastikan bahwa setiap supir kami telah melalui seleksi yang ketat dan pelatihan yang intensif, sehingga mereka mampu mengemudikan kendaraan dengan aman dan terampil. Selain itu, kami juga memastikan bahwa kendaraan kami selalu dalam kondisi terbaik, sehingga Anda dapat merasa nyaman dan aman selama dalam perjalanan.</p>
               
               <p>Kami juga menawarkan opsi sewa kendaraan dengan berbagai jenis dan kapasitas, mulai dari mobil pribadi hingga bus dan kendaraan khusus. Kami juga menawarkan opsi sewa harian, mingguan, maupun bulanan, serta layanan antar jemput bandara dan pengemudi cadangan untuk memastikan kenyamanan dan keamanan Anda selama dalam perjalanan.</p>
               
               <p>Jadi, jika Anda membutuhkan layanan transportasi yang handal dan terpercaya, Sewa Supir siap membantu. Hubungi kami sekarang dan nikmati pengalaman berkendara yang aman dan nyaman dengan tim supir kami yang profesional dan terlatih.</p>
           </div>

           {{-- <h5 class="card-title">Cara Kerja "Sewa Supir"</h5> --}}
           <a class="btn btn-primary" href="/pesananSaya/buatPesanan">Sewa Sekarang!</a>
                 
         </div>
      </div>
</div>
@endsection