@extends('layout.main')
@section('title', 'Home | Perpustakaan Desa')
@section('content')
        <!-- Banner Area -->
        <div class="banner-area">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="banner-content">
                            <span data-aos="fade-up" data-aos-delay="900" data-aos-duration="1000" data-aos-once="true">FOR A BETTER FUTURE</span>
                            <h1 data-aos="fade-down" data-aos-delay="900" data-aos-duration="1000" data-aos-once="true">
                                Selamat Datang di Perpustakaan Desa "Cahaya Dunia"
                            </h1>
                            <p data-aos="fade-up" data-aos-delay="900" data-aos-duration="1000" data-aos-once="true">
                                Jangan lewatkan kesempatan untuk menjelajahi karya-karya menarik yang
                                banyak dibaca oleh masyarakat.
                            </p>
                            <div class="banner-form-area" data-aos="fade-down" data-aos-delay="900" data-aos-duration="1000" data-aos-once="true">
                                <form class="banner-form" id="searchForm" method="POST" action="{{ route('search.buku') }}">
                                    @csrf
                                    <input type="text" id="searchInput" class="form-control" placeholder="Cari Buku Anda" name="keyword" required autocomplete="off">
                                    <button class="default-btn" type="submit">
                                        <i class="ri-search-line"></i> Cari Buku
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="banner-img" data-speed="0.05" data-revert="true">
                            <img src="assets/images/home-one/man.png" data-aos="fade-up" data-aos-delay="900" data-aos-duration="1000" data-aos-once="true" alt="Man" />
                            <div class="bg-shape">
                                <img src="assets/images/home-one/home-one-shape.png" data-aos="fade-down" data-aos-delay="900" data-aos-duration="1000" data-aos-once="true" alt="Shape" />
                            </div>
                            <div class="top-content" data-aos="fade-up" data-aos-delay="900" data-aos-duration="1000" data-aos-once="true">
                                <i class="flaticon-student"></i>
                                <div class="content">
                                    <h3>Jelajahi Bukumu Sekarang</h3>
                                    <p>Memiliki {{ $totalBuku }} Total Buku</p>
                                </div>
                            </div>
                            <div class="right-content" data-aos="fade-down" data-aos-delay="900" data-aos-duration="1000" data-aos-once="true">
                                <i class="flaticon-checked"></i>
                                <div class="content">
                                    <h3>Congratulations</h3>
                                    <p>Your admission completed</p>
                                </div>
                            </div>

                            <div class="left-content" data-aos="fade-up" data-aos-delay="900" data-aos-duration="1000" data-aos-once="true">
                                <div class="content">
                                    <img src="{{ asset('assets/images/home-one/book.png') }}" alt="User" />
                                    <h3>Ayo Gabung Sekarang</h3>
                                    <p>Dan Temukan Buku Favoritmu</p>
                                </div>
                                <a href="{{ route('register') }}" class="join-btn">Gabung Sekarang</a>
                            </div>
                            <div class="banner-img-shape" >
                                <div class="shape1" data-aos="fade-up" data-aos-delay="900" data-aos-duration="1000" data-aos-once="true">
                                    <img src="assets/images/home-one/shape3.png" alt="Shape" />
                                </div>
                                <div class="shape2" data-aos="fade-down" data-aos-delay="900" data-aos-duration="1000" data-aos-once="true">
                                    <img src="assets/images/home-one/shape2.png" alt="Shape" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-shape">
                <div class="banner-shape1">
                    <img src="assets/images/home-one/shape1.png" alt="Shape" />
                </div>
            </div>
        </div>
        <!-- Banner Area End -->

        <!-- Counter Area -->
        <div class="counter-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-6 col-md-3">
                        <div class="counter-content">
                            <i class="flaticon-online-course"></i>
                            <h3><span class="odometer" data-count="{{ $jumlahDigital }}">00000</span></h3>
                            <p>Buku Digital</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6 col-md-3">
                        <div class="counter-content">
                            <i class="flaticon-online-course-1"></i>
                            <h3><span class="odometer" data-count="{{ $jumlahFisik }}">000000</span></h3>
                            <p>Buku Fisik</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6 col-md-3">
                        <div class="counter-content">
                            <i class="flaticon-student"></i>
                            <h3><span class="odometer" data-count="{{ $jumlahUser }}">00000</span></h3>
                            <p>User yang Terdaftar</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6 col-md-3">
                        <div class="counter-content">
                            <i class="flaticon-customer-satisfaction"></i>
                            <h3><span class="odometer" data-count="{{ $jumlahJenis }}">000</span></h3>
                            <p>Kategori Buku yang Tersedia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Counter Area End -->

        <!-- Featured Area -->
        <div class="featured-area pt-100 pb-70">
            <div class="container">
                <div class="row align-items-center mb-45">
                    <div class="col-lg-8 col-md-9">
                        <div class="section-title mt-rs-20">
                            <h2>Eksplor Kategori Buku Paling Favorit</h2>
                            <p>Lihat kategori buku yang paling banyak dibaca dan disukai oleh orang lain </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3 text-end">
                        <a href="{{ route('buku.digital') }}" class="default-btn">Explore more</a>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach ($jenis_bukus as $item)
                        <div class="col-lg-3 col-6 col-md-4">
                            <div class="featured-card">
                                <a href="{{ route('buku.digital.jenis', $item->id) }}"> <!-- Ganti dengan route yang sesuai -->
                                    <h3>{{ $item->jenis_buku }}</h3> <!-- Menampilkan jenis buku -->
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        <!-- Featured Area End -->

        <!-- Courses Area -->
        <div class="courses-area pb-70">
            <div class="container">
                <div class="section-title text-center mb-45">
                    <h2>Temukan Buku Paling Populer Saat Ini</h2>
                    <p>
                        Temukan Buku Yang Sedang Populer Saat ini dan bacalah sekarang
                    </p>
                </div>
                <div class="row">

                    @forelse ($bukus as $buku)
                    <div class="col-lg-4 col-md-6">
                        <div class="courses-item">
                            <a href="{{ route('buku.digital.detail', $buku->id) }}">
                                <img src="{{ asset('storage/' . $buku->cover_buku) }}" alt="Courses"/>
                            </a>
                            <div class="content">
                                <a href="{{ route('buku.digital.jenis', $item->id) }}" class="tag-btn">{{ $buku->jenis_buku }}</a>
                                <h3><a href="{{ route('buku.digital.detail', $buku->id) }}">{{ $buku->judul_buku }}</a></h3>
                                <ul class="course-list">
                                    <li><i class="ri-group-line"></i>{{ $buku->jumlah_dibaca }} kali</li>
                                    <li><i class="ri-star-fill"></i>{{ $buku->buku_favorit }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center">Buku tidak ditemukan.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Courses Area End -->
@endsection
