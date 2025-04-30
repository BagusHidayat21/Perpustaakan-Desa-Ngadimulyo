@extends('layout.main')
@section('title', 'Agenda | Perpustakaan Desa')
@section('content')
<!-- Inner Banner -->
<div class="inner-banner inner-banner-bg10">
    <div class="container">
        <div class="inner-title text-center">
            <h3>Agenda</h3>
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
                <li>Agenda</li>
            </ul>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- Courses Area -->
<div class="courses-area pt-100 pb-70">
    <div class="container">
        {{-- <div class="product-topper mb-45">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-6">
                    <div class="product-title">
                        <h3>Kami Menemukan  <span> {{ $jumlahBuku }} </span>Buku Untuk Mu</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="product-list">
                        @foreach ($jenis_bukus as $item)
                        <form method="GET" action="{{ Route::currentRouteName() === 'buku.digital.jenis' ? route('buku.digital.jenis', ['id' => $item->id]) : '/buku-digital' }}">
                        @endforeach
                            <select class="form-select" aria-label="Default select example" name="sort" onchange="this.form.submit()">
                                <option disabled selected>Urutkan Berdasarkan</option>
                                <option value="1" {{ request('sort') == '1' ? 'selected' : '' }}>Paling Banyak Dibaca</option>
                                <option value="2" {{ request('sort') == '2' ? 'selected' : '' }}>Baru Ditambahkan</option>
                            </select>
                        </form>
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row">
            @forelse ($agendas as $agenda)
            <div class="col-lg-4 col-md-6">
                <div class="courses-item">
                    <a href="{{ route('agenda.detail', $agenda->id) }}">
                        <img src="{{ asset('storage/' . $agenda->foto_agenda) }}" alt="Foto Agenda"/>
                    </a>
                    <div class="content">
                        <a href="#" class="tag-btn">{{ $agenda->formatted_date }}</a>
                        <h3><a href="{{ route('agenda.detail', $agenda->id) }}">{{ $agenda->judul_agenda }}</a></h3>
                        <ul class="course-list">
                            <li><i class="ri-group-line"></i> Admin</li>
                        </ul>
                    </div>
                </div>
            </div>
            @empty
                <p>Agenda tidak ditemukan.</p>
            @endforelse


            {{-- <!-- Pagination Links -->
            <div class="col-lg-12 col-md-12 text-center">
                <div class="pagination-area">
                    {{ $bukus->links() }} <!-- Menampilkan links pagination -->
                </div>
            </div> --}}
        </div>
    </div>
</div>
<!-- Courses Area End -->
@endsection
