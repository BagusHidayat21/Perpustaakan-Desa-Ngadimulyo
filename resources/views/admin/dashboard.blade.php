@extends('layout.master-dashboard')
@section('content')
<div id="content-wrapper" class="d-flex flex-column">
  <div id="content">
    <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                    <span class="ml-2 d-none d-lg-inline text-white small">{{ Auth::user()->nama_lengkap }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="fas fa-user-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profil
                    </a>
                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                        data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </div>

      <div class="row mb-3">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Buku Digital</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalBukuDigital}}</div>
                  <div class="mt-2 mb-0 text-muted text-xs">
                    {{-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> --}}
                    <span class="text-primary">Jumlah Buku Digital atau Ebook</span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-book fa-2x text-primary"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Buku Fisik</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalBukuFisik}}</div>
                  <div class="mt-2 mb-0 text-muted text-xs">
                    {{-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span> --}}
                    <span class="text-primary">Jumlah buku fisik yang ada di perpustakaan desa</span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-book fa-2x text-success"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- New User Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah User</div>
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$totalUser}}</div>
                  <div class="mt-2 mb-0 text-muted text-xs">
                    {{-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span> --}}
                    <span class="text-primary">Jumlah user yang sudah mendaftar</span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-users fa-2x text-info"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Saran dan Masukan</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalMasukanUser}}</div>
                  <div class="mt-2 mb-0 text-muted text-xs">
                    {{-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span> --}}
                    <span class="text-primary">Jumlah saran atau masukan dari pengguna</span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-users fa-2x text-warning"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

      <!-- Modal Logout -->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to logout?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                    @csrf
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!---Container Fluid-->
  </div>
</div>
@endsection
