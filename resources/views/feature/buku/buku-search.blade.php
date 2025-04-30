@extends('layout.main')
@section('title', 'Buku Digital | Perpustakaan Desa')
@section('content')
<!-- Inner Banner -->
<div class="inner-banner inner-banner-bg10">
    <div class="container">
        <div class="inner-title text-center">
            <h3>Buku Digital</h3>
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
                <li>Buku Digital</li>
            </ul>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- Courses Area -->
<div class="courses-area pt-100 pb-70">
    <div class="container">
        <div class="product-topper mb-45">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-6">
                    <div class="product-title">
                        <h3>Kami Menemukan <span>{{ $jumlahBuku }}</span> Buku Untuk Anda</h3>
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-md-6">
                    <div class="product-list">
                        <form method="GET" action="{{ url()->current() }}">
                            <select class="form-select" aria-label="Default select example" name="sort" onchange="this.form.submit()">
                                <option disabled selected>Urutkan Berdasarkan</option>
                                <option value="1" {{ request('sort') == '1' ? 'selected' : '' }}>Paling Banyak Dibaca</option>
                                <option value="2" {{ request('sort') == '2' ? 'selected' : '' }}>Baru Ditambahkan</option>
                            </select>
                        </form>
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="row">
            @forelse ($bukus as $buku)
            <div class="col-lg-4 col-md-6">
                <div class="courses-item">
                    <a href="{{ route('buku.digital.detail', $buku->id) }}">
                        <img src="{{ asset('storage/' . $buku->cover_buku) }}" alt="Courses"/>
                    </a>
                    <div class="content">
                        <a href="#" class="tag-btn">{{ $buku->jenis_buku }}</a>
                        <h3><a href="{{ route('buku.digital.detail', $buku->id) }}">{{ $buku->judul_buku }}</a></h3>
                        <ul class="course-list">
                            <li><i class="ri-group-line"></i> {{ $buku->jumlah_dibaca }} kali</li>
                            <li><i class="ri-star-fill"></i> {{ $buku->buku_favorit }} Favorit</li>
                        </ul>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12 text-center">
                    <p>Buku tidak ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
<!-- Courses Area End -->
@endsection
