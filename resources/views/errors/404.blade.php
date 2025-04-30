<!doctype html>
<html lang="zxx">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <!-- Icon Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/iconplugins.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <!-- Theme Dark CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme-dark.css') }}">

    <!-- Title -->
    <title>Tujuan Tidak Ditemukan</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
</head>
<body>
    <!-- Start 404 Error -->
    <div class="error-area ptb-100">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="error-content">
                    <h1>4 <span>0</span> 4</h1>
                    <h3>Oops! Page Not Found</h3>
                    <p>Page yang kamu cari tidak ditemukan atau telah dihapus</p>
                    <a href="{{ route('home') }}" class="default-btn">
                        Kembali ke Halaman Utama
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End 404 Error -->

    <!-- Jquery Min JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- Plugins JS -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
