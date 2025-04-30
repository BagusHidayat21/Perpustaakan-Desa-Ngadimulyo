        <!-- Start Navbar Area -->
        <div class="navbar-area ledu-area">
            <div class="mobile-responsive-nav">
                <div class="container">
                   <div class="mobile-responsive-menu">
                        <div class="logo">
                            <a href="/">
                                <img src="{{ asset('assets/images/logos/logo.png') }}                                " class="logo-one" alt="logo">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu For Desktop Device -->
            <div class="desktop-nav nav-area">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-md navbar-light ">
                        <a class="navbar-brand" href="/">
                            <img src="{{ asset('assets/images/logos/logo.png') }}" class="logo-one" alt="Logo">
                        </a>
                        <div class="navbar-category">
                            <div class="dropdown category-list-dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButtoncategory" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class='flaticon-list'></i>
                                    Kategori Buku
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButtoncategory">
                                    @foreach ($jenis_bukus as $item)
                                        <a href="{{ route('buku.digital.jenis', $item->id) }}" class="nav-link-item">
                                            {{ $item->jenis_buku }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                                        Home
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('/buku-digital') }}" class="nav-link {{ Request::is('buku-digital*') ? 'active' : '' }}" class="nav-link">
                                        Buku Digital
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('/buku-fisik') }}" class="nav-link {{ Request::is('buku-fisik*') ? 'active' : '' }}" class="nav-link">
                                        Buku Fisik
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('/about') }}" class="nav-link {{ Request::is('about') ? 'active' : '' }}">
                                        Tentang Perpustakaan
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('/agenda') }}" class="nav-link {{ Request::is('agenda') ? 'active' : '' }}">
                                        Agenda
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('/contact') }}" class="nav-link {{ Request::is('contact') ? 'active' : '' }}">
                                        Kontak
                                    </a>
                                </li>
                            </ul>

                            <div class="others-options d-flex align-items-center">
                                <div class="optional-item">
                                    @if (auth()->check())
                                    <div class="dropdown">
                                        <span class="greeting" id="userDropdown" onclick="toggleDropdown()">Halo, {{ auth()->user()->username }}</span>
                                        <div id="dropdownMenu" class="dropdown-menu" style="display: none;">
                                            <a href="{{ route('profile.edit') }}" class="dropdown-item">Profil</a>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-responsive-nav-link :href="route('logout')"
                                                                       onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </x-responsive-nav-link>
                                            </form>
                                        </div>
                                    </div>
                                    @else
                                        <a href="{{ route('register') }}" class="default-btn two">Daftar</a>
                                    @endif
                                </div>
                            </div>

                            <script>
                                function toggleDropdown() {
                                    const dropdownMenu = document.getElementById('dropdownMenu');
                                    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
                                }

                                // Menutup dropdown jika pengguna mengklik di luar dropdown
                                window.onclick = function(event) {
                                    if (!event.target.matches('.greeting')) {
                                        const dropdowns = document.getElementsByClassName("dropdown-menu");
                                        for (let i = 0; i < dropdowns.length; i++) {
                                            const openDropdown = dropdowns[i];
                                            if (openDropdown.style.display === 'block') {
                                                openDropdown.style.display = 'none';
                                            }
                                        }
                                    }
                                }
                                </script>


                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- End Navbar Area -->
