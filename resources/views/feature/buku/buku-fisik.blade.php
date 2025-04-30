@extends('layout.main')
@section('title', 'Buku Fisik | Perpustakaan Desa')
@section('content')

<!-- Inner Banner -->
<div class="inner-banner inner-banner-bg3">
    <div class="container">
        <div class="inner-title text-center">
            <h3>Buku Fisik</h3>
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li>Buku Fisik</li>
            </ul>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- Newsletter Area -->
<div class="newsletter-area section-bg ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-title mt-rs-20">
                    <span>Cari Buku Berdasarkan Judul</span>
                    <h2>Pencarian</h2>
                </div>
            </div>
            <div class="col-lg-7">
                <form class="newsletter-form" id="search-form" method="GET">
                    @csrf
                    <input type="text" class="form-control" placeholder="Masukkan Judul Buku Yang Akan Dicari..." name="search" id="search-input">
                    <button class="subscribe-btn" type="submit">
                        Cari Buku <i class="flaticon-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Newsletter Area End -->
<div class="event-area pt-100 pb-100">
    <div class="container" id="results-container">
        @if($books->isNotEmpty())
            <div class="section-title text-center mb-45">
                <h2>Daftar Buku</h2>
            </div>
            <div class="row" id="book-list">
                @foreach ($books as $book)
                    <div class="col-lg-6">
                        <div class="event-item box-shadow">
                            <div class="event-img">
                                <a>
                                    <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{$book->judul_buku }}" />
                                </a>
                            </div>
                            <div class="event-content">
                                <h3><a>{{$book->judul_buku}}</a></h3>
                                <p><i class="ri-file-list-line text-info"></i> Jenis Buku: <small class="text-primary">{{$book->jenis_buku}}</small></p>
                                <p><i class="ri-user-line text-info"></i> Penulis: <small class="text-primary">{{$book->penulis}}</small></p>
                                <p><i class="ri-git-repository-commits-line text-info"></i> Penerbit: <small class="text-primary">{{$book->penerbit}}</small></p>
                                <p><i class="ri-time-line text-info"></i> Tahun Terbit: <small class="text-primary">{{$book->tahun_terbit}}</small></p>
                                <p><i class="ri-arrow-left-right-line text-info"></i> Nomor Buku/Rak: <span class="badge bg-primary">{{$book->nomor_buku}}</span></p>
                                <p>
                                    <i class="ri-git-repository-line text-info"></i>
                                    Status Buku:
                                    @if($book->status == 'Tersedia'||'tersedia')
                                        <span class="badge bg-success">{{ $book->status }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ $book->status }}</span>
                                    @endif
                                </p>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Tidak ada hasil ditemukan.</p>
        @endif

        <div class="col-lg-12 col-md-12 text-center">
            <div class="pagination-area">
                <!-- Tombol Previous -->
                @if ($books->onFirstPage())
                    <span class="prev page-numbers disabled">
                        <i class="flaticon-left-arrow"></i>
                    </span>
                @else
                    <a href="{{ $books->previousPageUrl() }}" class="prev page-numbers">
                        <i class="flaticon-left-arrow"></i>
                    </a>
                @endif

                <!-- Link Nomor Halaman -->
                @foreach ($books->links()->elements[0] as $page => $url)
                    @if ($page == $books->currentPage())
                        <span class="page-numbers current" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-numbers">{{ $page }}</a>
                    @endif
                @endforeach

                <!-- Tombol Next -->
                @if ($books->hasMorePages())
                    <a href="{{ $books->nextPageUrl() }}" class="next page-numbers">
                        <i class="flaticon-chevron"></i>
                    </a>
                @else
                    <span class="next page-numbers disabled">
                        <i class="flaticon-chevron"></i>
                    </span>
                @endif
            </div>
        </div>

    </div>
</div>
<!-- Events Area End -->

<!-- JavaScript for AJAX Search -->
<script>
    document.getElementById('search-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const searchValue = document.getElementById('search-input').value;

        fetch(`{{ route('buku.ajaxSearch') }}?search=${encodeURIComponent(searchValue)}`)
            .then(response => response.json())
            .then(data => {
                const bookList = document.getElementById('book-list');
                bookList.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(book => {
                        const bookElement = `
                            <div class="col-lg-6">
                                <div class="event-item box-shadow">
                                    <div class="event-img">
                                        <a href="event-details.html">
                                            <img src="storage/${book.cover_buku}" alt="${book.judul_buku}" />
                                        </a>
                                    </div>
                                    <div class="event-content">
                                        <h3><a href="event-details.html">${book.judul_buku}</a></h3>
                                        <p><i class="ri-file-list-line text-info"></i> Jenis Buku: <small class="text-primary">${book.jenis_buku}</small></p>
                                        <p><i class="ri-user-line text-info"></i> Penulis: <small class="text-primary">${book.penulis}</small></p>
                                        <p><i class="ri-git-repository-commits-line text-info"></i> Penerbit: <small class="text-primary">${book.penerbit}</small></p>
                                        <p><i class="ri-time-line text-info"></i> Tahun Terbit: <small class="text-primary">${book.tahun_terbit}</small></p>
                                        <p><i class="ri-arrow-left-right-line text-info"></i> Nomor: <span class="badge bg-primary">${book.nomor_buku}</span></p>
                                        <p><i class="ri-git-repository-line text-info"></i> Status Buku: <span class="badge bg-success">${book.status}</span></p>
                                    </div>
                                </div>
                            </div>`;
                        bookList.innerHTML += bookElement;
                    });
                } else {
                    bookList.innerHTML = '<p>Tidak ada hasil ditemukan.</p>';
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>
<script>
    const statusBadge = document.getElementById('status-badge');

    if (statusBadge.textContent === 'tersedia') {
        statusBadge.classList.add('bg-success');
        statusBadge.classList.remove('bg-danger');
    } else {
        statusBadge.classList.add('bg-danger');
        statusBadge.classList.remove('bg-success');
    }
</script>

@endsection
