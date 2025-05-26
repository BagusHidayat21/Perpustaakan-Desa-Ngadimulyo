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
                <!-- Mobile Layout: Cover dan Detail di atas, Sinopsis di bawah -->
                <div class="col-12 d-block d-lg-none mobile-layout">
                    <!-- Cover dan Detail Buku untuk Mobile -->
                    <div class="mobile-book-info mb-4">
                        <div class="mobile-cover-container text-center mb-3">
                            <img src="{{ asset('storage/' . $buku->cover_buku) }}"
                                 alt="Cover Buku"
                                 class="mobile-cover-image" />
                        </div>

                        <div class="mobile-book-details">
                            <div class="mobile-detail-header">
                                <h4 class="mobile-book-title">{{ $buku->judul_buku }}</h4>
                            </div>

                            <div class="mobile-details-grid">
                                <div class="mobile-detail-item">
                                    <span class="mobile-detail-label">Penulis:</span>
                                    <span class="mobile-detail-value">{{ $buku->penulis }}</span>
                                </div>
                                <div class="mobile-detail-item">
                                    <span class="mobile-detail-label">Penerbit:</span>
                                    <span class="mobile-detail-value">{{ $buku->penerbit }}</span>
                                </div>
                                <div class="mobile-detail-item">
                                    <span class="mobile-detail-label">Tahun Terbit:</span>
                                    <span class="mobile-detail-value">{{ $buku->tahun_terbit }}</span>
                                </div>
                                <div class="mobile-detail-item">
                                    <span class="mobile-detail-label">Jenis Buku:</span>
                                    <span class="mobile-detail-value">{{ $buku->jenis_buku }}</span>
                                </div>
                            </div>

                            <!-- Action Buttons untuk Mobile -->
                            <div class="mobile-actions">
                                <button class="mobile-read-btn"
                                        onclick="bukaPDFMobile('{{ asset('storage/' . $buku->file_buku) }}')">
                                    <i class="ri-book-open-line"></i>
                                    Baca Buku
                                </button>

                                <form action="{{ route('buku-digital.store') }}" method="POST" class="mobile-favorite-form">
                                    @csrf
                                    <input type="hidden" name="id_buku" value="{{ $buku->id }}">
                                    <button type="submit" class="mobile-favorite-btn {{ $isFavorited ? 'favorited' : '' }}">
                                        <i class="ri-star-fill"></i>
                                        {{ $isFavorited ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Sinopsis untuk Mobile -->
                    <div class="mobile-synopsis">
                        <div class="mobile-synopsis-header">
                            <h4>Sinopsis Buku</h4>
                        </div>
                        <div class="mobile-synopsis-content">
                            <p>{{ $buku->sinopsis }}</p>
                        </div>
                    </div>
                </div>

                <!-- Desktop Layout (tetap sama) -->
                <div class="col-lg-8 d-none d-lg-block">
                    <div class="courses-details-contact">
                        <div class="tab courses-details-tab">
                            <ul class="tabs">
                                <li>Overview</li>
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

                <div class="col-lg-4 d-none d-lg-block">
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
                            <a href="javascript:void(0);" class="default-btn" onclick="tampilkanPDF('{{ asset('storage/' . $buku->file_buku) }}')">
                                Baca Buku
                            </a>

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

    <!-- Modal PDF untuk Desktop -->
    <div id="pdf-modal" class="pdf-modal d-none d-lg-block">
        <div class="pdf-modal-content">
            <div class="pdf-modal-header">
                <span class="pdf-close" title="Tutup">&times;</span>
                <span class="pdf-title">{{ $buku->judul_buku }}</span>
            </div>
            <iframe id="pdf-frame" src="" allowfullscreen></iframe>
        </div>
    </div>
    <!-- Courses Details Area End -->

    <style>
        /* Mobile Styles */
        @media (max-width: 991.98px) {
            .mobile-layout {
                padding: 0 15px;
            }

            .mobile-book-info {
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                padding: 20px;
                margin-bottom: 20px;
            }

            .mobile-cover-container {
                margin-bottom: 20px;
            }

            .mobile-cover-image {
                max-width: 200px;
                width: 100%;
                height: auto;
                border-radius: 8px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            }

            .mobile-book-title {
                font-size: 1.4rem;
                font-weight: 700;
                color: #333;
                margin-bottom: 15px;
                text-align: center;
                line-height: 1.3;
            }

            .mobile-details-grid {
                display: grid;
                gap: 12px;
                margin-bottom: 25px;
            }

            .mobile-detail-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 0;
                border-bottom: 1px solid #eee;
            }

            .mobile-detail-item:last-child {
                border-bottom: none;
            }

            .mobile-detail-label {
                font-weight: 600;
                color: #666;
                font-size: 0.9rem;
            }

            .mobile-detail-value {
                font-weight: 500;
                color: #333;
                text-align: right;
                max-width: 60%;
                font-size: 0.9rem;
            }

            .mobile-actions {
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .mobile-read-btn {
                background: linear-gradient(135deg, #007bff, #0056b3);
                color: white;
                border: none;
                padding: 15px 20px;
                border-radius: 25px;
                font-weight: 600;
                font-size: 1rem;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(0,123,255,0.3);
            }

            .mobile-read-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(0,123,255,0.4);
            }

            .mobile-favorite-form {
                width: 100%;
            }

            .mobile-favorite-btn {
                width: 100%;
                background: linear-gradient(135deg, #28a745, #1e7e34);
                color: white;
                border: none;
                padding: 12px 20px;
                border-radius: 25px;
                font-weight: 600;
                font-size: 0.95rem;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .mobile-favorite-btn.favorited {
                background: linear-gradient(135deg, #ffc107, #e0a800);
            }

            .mobile-favorite-btn:hover {
                transform: translateY(-1px);
            }

            .mobile-synopsis {
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                padding: 20px;
            }

            .mobile-synopsis-header h4 {
                font-size: 1.3rem;
                font-weight: 700;
                color: #333;
                margin-bottom: 15px;
                padding-bottom: 10px;
                border-bottom: 2px solid #007bff;
            }

            .mobile-synopsis-content p {
                font-size: 1rem;
                line-height: 1.6;
                color: #555;
                text-align: justify;
                margin: 0;
            }
        }

        /* PDF Modal untuk Desktop */
        .pdf-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.9);
            align-items: center;
            justify-content: center;
        }

        .pdf-modal-content {
            position: relative;
            width: 95%;
            height: 95%;
            max-width: 1000px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .pdf-modal-header {
            background: #333;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .pdf-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-right: 20px;
        }

        .pdf-close {
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            color: white;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background-color 0.3s;
        }

        .pdf-close:hover {
            background-color: rgba(255,255,255,0.1);
        }

        #pdf-frame {
            width: 100%;
            height: 100%;
            border: none;
            flex: 1;
        }

        /* Prevent scrolling when modal is open */
        body.modal-open {
            overflow: hidden !important;
        }
    </style>

    <script>
        // Fungsi untuk membuka PDF di desktop (modal dengan iframe)
        function tampilkanPDF(fileUrl) {
            // Scroll ke atas tanpa animasi supaya navbar reset
            window.scrollTo({ top: 0, behavior: 'auto' });

            setTimeout(() => {
                const modal = document.getElementById('pdf-modal');
                const iframe = document.getElementById('pdf-frame');

                iframe.src = fileUrl + '#toolbar=0&navpanes=0&scrollbar=0';

                modal.style.display = 'flex';

                // Disable scroll halaman utama
                document.body.style.overflow = 'hidden';
                document.body.classList.add('modal-open');

                document.addEventListener('contextmenu', disableContextMenu);
                document.addEventListener('keydown', disableSavePrintShortcut);

                iframe.onload = () => {
                    iframe.contentWindow.scrollTo(0, 0);
                };
            }, 50);
        }

        // Fungsi khusus untuk mobile - buka di aplikasi PDF eksternal
        function bukaPDFMobile(fileUrl) {
            // Deteksi perangkat mobile
            const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

            if (isMobile) {
                // Tampilkan loading atau notification
                showMobileLoadingMessage();

                // Buat URL dengan parameter khusus untuk disable fitur
                const disabledUrl = fileUrl + '#toolbar=0&navpanes=0&scrollbar=0&view=FitH&zoom=100&print=false&save=false';

                // Coba buka dengan berbagai aplikasi PDF yang umum
                const apps = [
                    'googledrive://open-url=' + encodeURIComponent(disabledUrl), // Google Drive
                    'adobereader://open=' + encodeURIComponent(disabledUrl), // Adobe Reader
                    'pdfreader://open=' + encodeURIComponent(disabledUrl), // PDF Reader generik
                    'intent://view#Intent;scheme=http;type=application/pdf;S.browser_fallback_url=' + encodeURIComponent(disabledUrl) + ';end', // Android Intent
                ];

                let appOpened = false;
                let currentAppIndex = 0;

                function tryNextApp() {
                    if (currentAppIndex < apps.length && !appOpened) {
                        const link = document.createElement('a');
                        link.href = apps[currentAppIndex];
                        link.target = '_blank';

                        // Event listener untuk mendeteksi jika app berhasil dibuka
                        const startTime = Date.now();

                        link.click();

                        // Jika setelah 2 detik masih di halaman yang sama, coba app berikutnya
                        setTimeout(() => {
                            const endTime = Date.now();
                            if (!document.hidden && endTime - startTime < 2500) {
                                currentAppIndex++;
                                tryNextApp();
                            } else {
                                appOpened = true;
                                hideMobileLoadingMessage();
                            }
                        }, 2000);
                    } else if (!appOpened) {
                        // Jika semua app gagal, buka di browser dengan restricted mode
                        openInRestrictedBrowser(disabledUrl);
                    }
                }

                // Mulai mencoba membuka aplikasi
                tryNextApp();

                // Fallback: jika tidak ada yang berhasil dalam 10 detik
                setTimeout(() => {
                    if (!appOpened) {
                        openInRestrictedBrowser(disabledUrl);
                    }
                }, 10000);

            } else {
                // Jika bukan mobile, gunakan fungsi desktop
                tampilkanPDF(fileUrl);
            }
        }

        // Fungsi untuk menampilkan pesan loading di mobile
        function showMobileLoadingMessage() {
            const loadingDiv = document.createElement('div');
            loadingDiv.id = 'mobile-loading';
            loadingDiv.innerHTML = `
                <div style="
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0,0,0,0.8);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 10000;
                    color: white;
                    font-size: 1.2rem;
                    text-align: center;
                    flex-direction: column;
                ">
                    <div style="margin-bottom: 20px;">
                        <div style="
                            width: 40px;
                            height: 40px;
                            border: 4px solid #ffffff30;
                            border-top: 4px solid #007bff;
                            border-radius: 50%;
                            animation: spin 1s linear infinite;
                            margin: 0 auto 15px;
                        "></div>
                        <div>Membuka aplikasi PDF...</div>
                        <div style="font-size: 0.9rem; margin-top: 10px; opacity: 0.8;">
                            Fitur cetak dan simpan dinonaktifkan
                        </div>
                    </div>
                </div>
                <style>
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                </style>
            `;

            document.body.appendChild(loadingDiv);
        }

        // Fungsi untuk menyembunyikan pesan loading
        function hideMobileLoadingMessage() {
            const loadingDiv = document.getElementById('mobile-loading');
            if (loadingDiv) {
                loadingDiv.remove();
            }
        }

        // Fungsi fallback untuk membuka di browser dengan pembatasan
        function openInRestrictedBrowser(fileUrl) {
            hideMobileLoadingMessage();

            // Buat peringatan bahwa akan dibuka di browser
            const confirmOpen = confirm(
                'Tidak dapat membuka di aplikasi PDF eksternal.\n\n' +
                'PDF akan dibuka di browser dengan fitur cetak dan simpan yang dibatasi.\n\n' +
                'Lanjutkan?'
            );

            if (confirmOpen) {
                // Buka di tab baru dengan parameter disabled
                const newWindow = window.open(fileUrl + '#toolbar=0&navpanes=0&scrollbar=0', '_blank');

                if (newWindow) {
                    newWindow.focus();

                    // Inject script untuk disable right click dan shortcuts
                    newWindow.onload = function() {
                        try {
                            newWindow.document.addEventListener('contextmenu', function(e) {
                                e.preventDefault();
                                alert('Klik kanan dinonaktifkan');
                            });

                            newWindow.document.addEventListener('keydown', function(e) {
                                if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'p')) {
                                    e.preventDefault();
                                    alert('Fitur save dan print dinonaktifkan');
                                }
                            });
                        } catch (error) {
                            console.log('Cannot inject restrictions due to cross-origin policy');
                        }
                    };
                } else {
                    alert('Popup diblokir. Silakan izinkan popup dan coba lagi.');
                }
            }
        }

        function closeModal() {
            const modal = document.getElementById('pdf-modal');
            const iframe = document.getElementById('pdf-frame');

            modal.style.display = 'none';
            iframe.src = '';

            // Kembalikan scroll halaman utama aktif
            document.body.style.overflow = 'auto';
            document.body.classList.remove('modal-open');

            document.removeEventListener('contextmenu', disableContextMenu);
            document.removeEventListener('keydown', disableSavePrintShortcut);
        }

        // Pasang event listener tombol close setelah DOM siap
        document.addEventListener('DOMContentLoaded', () => {
            const closeBtn = document.querySelector('.pdf-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', closeModal);
            }

            // Close modal when clicking outside of content
            const modal = document.getElementById('pdf-modal');
            if (modal) {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        closeModal();
                    }
                });
            }
        });

        function disableContextMenu(e) {
            e.preventDefault();
        }

        function disableSavePrintShortcut(e) {
            // Prevent Ctrl+S, Ctrl+P
            if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'p')) {
                e.preventDefault();
                alert('Fitur save dan print dinonaktifkan.');
            }
        }
    </script>
@endsection
