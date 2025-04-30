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
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-profile rounded-circle" src="{{ asset('img/boy.png') }}" style="max-width: 60px">
                        <span class="ml-2 d-none d-lg-inline text-white small">{{ Auth::user()->nama_lengkap }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <i class="fas fa-user-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profil
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Pengurus Perpustakaan</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengurus Perpustakaan</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Pengurus Perpustakaan</h6>
                        </div>
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahModal">Tambah Pengurus</button>
                        </div>
                        <!-- Modal Tambah Pengurus -->
                        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tambahModalLabel">Tambah Buku Digital</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('pengurus.tambah') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <!-- Nama Pengurus -->
                                            <div class="form-group">
                                                <label for="nama">Nama Pengurus</label>
                                                <input
                                                    type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama pengurus" required>
                                            </div>
                                            <!-- Jabatan -->
                                            <div class="form-group">
                                                <label for="jabatan">Jabatan</label>
                                                <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Masukkan jabatan pengurus">
                                            </div>
                                            <!-- Foto Pengurus -->
                                            <div class="form-group">
                                                <label for="foto">Foto Pengurus</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="foto" name="foto" accept="image/*">
                                                    <label class="custom-file-label" for="foto">Pilih foto...</label>
                                                </div>
                                            </div>
                                            <!-- Instagram -->
                                            <div class="form-group">
                                                <label for="instagram">Akun Instagram</label>
                                                <input type="text" class="form-control" name="instagram" id="instagram" placeholder="Masukkan link akun Instagram">
                                            </div>
                                            <!-- Facebook -->
                                            <div class="form-group">
                                                <label for="facebook">Akun Facebook</label>
                                                <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Masukkan link akun Facebook">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Jabatan</th>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center">Instagram</th>
                                        <th class="text-center">Facebook</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($penguruses as $pengurus)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td> {{ $pengurus->nama }}</td>
                                            <td> {{ $pengurus->jabatan }}</td>
                                            <td class="text-center">
                                                <img src="{{ asset('storage/' . $pengurus->foto) }}" alt="Foto Pengurus" style="width: 100px;">
                                            </td>
                                            <td> {{ $pengurus->instagram }}</td>
                                            <td> {{ $pengurus->facebook }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $pengurus->id }}">Edit</a>
                                                <form id="deleteForm{{ $pengurus->id }}" action="{{ route('pengurus.hapus', $pengurus->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $pengurus->id }})">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal{{ $pengurus->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit pengurus</h5>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('pengurus.edit', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <!-- Nama Pengurus -->
                                                                <div class="form-group">
                                                                    <label for="nama">Nama Pengurus</label>
                                                                    <input
                                                                        type="text" class="form-control" name="nama" id="nama"value="{{ $pengurus->nama }}" required>
                                                                </div>
                                                                <!-- Jabatan -->
                                                                <div class="form-group">
                                                                    <label for="jabatan">Jabatan</label>
                                                                    <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ $pengurus->jabatan }}">
                                                                </div>
                                                                <!-- Foto Pengurus -->
                                                                <div class="form-group">
                                                                    <label for="foto">Foto Pengurus</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="foto" name="foto" accept="image/*">
                                                                        <label class="custom-file-label" for="foto">Pilih foto...</label>
                                                                    </div>
                                                                </div>
                                                                <!-- Instagram -->
                                                                <div class="form-group">
                                                                    <label for="instagram">Akun Instagram</label>
                                                                    <input type="text" class="form-control" name="instagram" id="instagram" value="{{ $pengurus->instagram }}">
                                                                </div>
                                                                <!-- Facebook -->
                                                                <div class="form-group">
                                                                    <label for="facebook">Akun Facebook</label>
                                                                    <input type="text" class="form-control" name="facebook" id="facebook" value="{{ $pengurus->facebook }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logout Modal -->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Logout</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">Yakin ingin logout?</div>
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
    </div>
</div>
@endsection
