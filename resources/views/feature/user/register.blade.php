<!doctype html>
<html lang="zxx">
    <head>
        <!-- Required Meta Tags -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

       <!-- Plugins CSS -->
        <link rel="stylesheet" href="assets/css/plugins.css">
        <!-- Icon Plugins CSS -->
        <link rel="stylesheet" href="assets/css/iconplugins.css">
        <!-- Style CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="assets/css/responsive.css">
        <!-- Theme Dark CSS -->
        <link rel="stylesheet" href="assets/css/theme-dark.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Title -->
        <title>Register - Perpustakaan Desa</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="assets/images/favicon.png">
    </head>
    <body>
        <!-- User Area -->
        <div class="user-area pt-100 pb-70">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6">
                        <div class="user-all-form">
                            <div class="contact-form">
                                <h3 class="user-title"> Sign up </h3>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row">
                                        <div class= "col-lg-12">
                                            <div class="form-group">
                                                <input type="text" name="username" id="name" class="form-control" required data-error="Username" placeholder="Username">
                                            </div>
                                        </div>

                                        <div class= "col-lg-12">
                                            <div class="form-group">
                                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required data-error="Nama Lengkap" placeholder="Nama Lengkap">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 ">
                                            <div class="form-group">
                                                <input type="email" name="email" id="email" class="form-control" required data-error="Please enter Email" placeholder="Please Enter Email">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                                                <small id="confirmationError" class="text-danger" style="display:none;">Password tidak cocok.</small>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <a href="{{ route('home') }}" type="submit" class="default-btn btn-danger text-decoration-none">
                                                Kembali
                                            </a>
                                            <button type="submit" class="default-btn">
                                                Daftar
                                            </button>
                                        </div>
                                        <div class="mt-4">
                                            <span>Jika anda sudah memiliki akun <a href="{{ route('login') }}">Login</a></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="user-img">
                            <img src="{{ asset('assets/images/logos/register.jpg') }}" alt="faq" />
                            {{-- <img src="assets/images/faq-img.jpg" alt="faq" /> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Area End -->
        <!-- Jquery Min JS -->
        <script src="assets/js/jquery.min.js"></script>
        <!-- Plugins JS -->
        <script src="assets/js/plugins.js"></script>
        <!-- Custom  JS -->
        <script src="assets/js/custom.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
            // Check for validation errors
            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan Pendaftaran',
                    html: '{!! implode('<br>', $errors->all()) !!}',
                    confirmButtonText: 'OK'
                });
            @endif
        </script>
        <script>
            document.getElementById('password_confirmation').addEventListener('input', function() {
                const password = document.getElementById('password').value;
                const passwordConfirmation = this.value;
                const confirmationError = document.getElementById('confirmationError');

                if (password !== passwordConfirmation) {
                    confirmationError.style.display = 'block'; // Show error message
                } else {
                    confirmationError.style.display = 'none'; // Hide error message
                }
            });
        </script>

    </body>
</html>
