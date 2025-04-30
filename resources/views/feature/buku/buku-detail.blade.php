@extends('layout.main')
@section('title', 'Detail | Perpustakaan Desa')
@section('content')
    <!-- Inner Banner -->
    <div class="inner-banner inner-banner-bg9">
        <div class="container">
            <div class="inner-title">
                <h3>{{ $buku->judul_buku }}</h3>
                <ul>
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>Detail Buku</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Courses Details Area -->
    <div class="courses-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="courses-details-contact">
                        <div class="tab courses-details-tab">
                            <ul class="tabs">
                                <li>
                                    Overview
                                </li>
                            </ul>
                            <div class="tab_content current active">
                                <div class="tabs_item current">
                                    <div class="courses-details-tab-content">
                                        <div class="courses-details-into">
                                            <h3>Sinopsis Buku</h3>
                                            <p style="text-align: justify;">{{ $buku->sinopsis }}</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="courses-details-sidebar">
                        <img src="{{ asset('storage/' . $buku->cover_buku) }}" alt="Cover Buku" />
                        <div class="content">
                            <span>Detail Buku :</span>
                            <ul class="courses-details-list">
                                <li>Penulis : {{ $buku->penulis }}</li>
                                <li>Penerbit : {{ $buku->penerbit }}</li>
                                <li>Tahun Terbit : {{ $buku->tahun_terbit }}</li>
                                <li>Jenis Buku : {{ $buku->jenis_buku }}</li>
                            </ul>
                            <a href="#" class="default-btn" data-id="{{ $buku->id }}"
                                onclick="bacaBuku({{ $buku->id }})">Baca Buku</a>

                            <!-- Modal untuk menampilkan PDF -->
                            <div id="pdf-modal" class="pdf-modal" style="display: none;">
                                <div class="pdf-modal-content">
                                    <span class="pdf-close" onclick="closeModal()">&times;</span>
                                    <iframe id="pdf-frame" src="" width="100%" height="100%"
                                        style="border:none;"></iframe>
                                </div>
                            </div>

                            <script>
                                function cekLogin(callback) {
                                    fetch('/api/check-login')
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.isLoggedIn) {
                                                callback();
                                            } else {
                                                window.location.href = '/login';
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            alert('Terjadi kesalahan saat memeriksa status login.');
                                        });
                                }

                                function bacaBuku(id) {
                                    cekLogin(() => {
                                        fetch(`/buku-digital/baca/${id}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                document.getElementById('pdf-frame').src =
                                                    `${data.file_url}`;
                                                document.getElementById('pdf-modal').style.display = 'flex';
                                                document.body.classList.add('modal-open');
                                                setTimeout(() => {
                                                    document.getElementById('pdf-modal').classList.add('show');
                                                    document.querySelector('.pdf-modal-content').classList.add('show');
                                                }, 10);
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                            });
                                    });
                                }

                                function closeModal() {
                                    document.getElementById('pdf-modal').classList.remove('show');
                                    document.querySelector('.pdf-modal-content').classList.remove('show');
                                    document.body.classList.remove('modal-open');
                                    setTimeout(() => {
                                        document.getElementById('pdf-modal').style.display = 'none';
                                    }, 300);
                                }
                            </script>


<ul class="social-link">
    <li class="social-title">Tambahkan ke Buku Favorit:</li>
    <li>
        <form action="{{ route('buku-digital.store') }}" method="POST" style="display: inline;">
            @csrf
            <input type="hidden" name="id_buku" value="{{ $buku->id }}">
            <button type="submit"
                    style="
                        width: 40px;
                        height: 40px;
                        background-color: {{ $isFavorited ? '#ffc107' : '#007bff' }};
                        border: 2px solid {{ $isFavorited ? '#ffc107' : '#007bff' }};
                        border-radius: 50%;
                        color: white;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        padding: 0;
                        transition: background-color 0.3s, border-color 0.3s;
                    ">
                <i class="ri-star-fill"></i>
            </button>
        </form>
    </li>
</ul>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Courses Details Area End -->
@endsection
