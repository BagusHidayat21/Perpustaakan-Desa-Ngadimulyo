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
                            <img class="img-profile rounded-circle" src="{{ asset('img/boy.png') }}" style="max-width: 60px">
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
            <!-- Topbar -->
            <!-- Container Fluid-->
            <div class="container-fluid" id="container-wrapper">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Daftar Buku Terfavorit</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item">Tables</li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Buku Terfavorit</li>
                    </ol>
                </div>

                <!-- Row -->
                <div class="row">
                    <!-- DataTable with Hover -->
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Buku Terfavorit</h6>
                            </div>
                            {{-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <a href="{{ route('buku.fisik.export') }}" class="btn btn-success btn-sm">Export Excel</a>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#importModal">Import Excel</button>
                            </div>
                            <!-- Modal Import Excel -->
                            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="importModalLabel">Import Buku Fisik</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('buku.fisik.import') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="file">Pilih File Excel</label>
                                                    <input type="file" name="file" class="form-control" id="file" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Import</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">Judul Buku</th>
                                            <th class="text-center">Nama User</th>
                                            {{-- <th class="text-center">Nama User</th>
                                            <th class="text-center">Penulis</th>
                                            <th class="text-center">Penerbit</th>
                                            <th class="text-center">Nomor Buku</th>
                                            <th class="text-center">Cover Buku</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th> --}}
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($terfavorit as $favorit)
                                            <tr>
                                                <td class="text-center">{{ $favorit->judul_buku }}</td>
                                                <td class="text-center">{{ $favorit->nama_lengkap }}</td>
                                                {{-- <td class="text-center">{{ $buku->penulis }}</td>
                                                <td class="text-center">{{ $buku->penerbit }}</td>
                                                <td class="text-center">{{ $buku->nomor_buku }}</td>
                                                <td class="text-center">
                                                    <img src="{{ asset('storage/' . $buku->cover_buku) }}" alt="Cover Buku"
                                                        style="width: 100px; height: auto;">
                                                </td>
                                                <td class="text-center">{{ $buku->status }}</td>
                                                <td>
                                                    <a class="btn btn-warning btn-sm text-white" style="cursor: pointer;"
                                                        data-toggle="modal"
                                                        data-target="#editModal{{ $buku->id }}">Edit</a>
                                                        <form id="deleteForm{{ $buku->id }}" action="{{ route('buku.fisik.hapus', $buku->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $buku->id }})">Hapus</button>
                                                        </form>
                                                </td> --}}
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Logout -->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
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
    @endsection
