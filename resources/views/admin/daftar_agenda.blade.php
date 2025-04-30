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
                <h1 class="h3 mb-0 text-gray-800">Agenda Management</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Agenda</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Agenda List</h6>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">Judul Agenda</th>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center">Isi</th>
                                        <th class="text-center">Waktu Dibuat</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agendas as $agenda)
                                        <tr>
                                            <td class="text-center">{{ $agenda->judul_agenda }}</td>
                                            <td class="text-center">
                                                <img src="{{ asset('storage/' . $agenda->foto_agenda) }}" alt="Foto Agenda" style="width: 100px;">
                                            </td>
                                            <td class="text-center">
                                                {!! Str::limit($agenda->isi_agenda, 20) !!}
                                                @if (strlen($agenda->isi_agenda) > 20)
                                                    <a href="#" data-toggle="modal" data-target="#detailModal{{ $agenda->id }}">
                                                        <span class="badge badge-primary">Lihat Detail</span>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $agenda->created_at }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $agenda->id }}">Edit</a>
                                                <form id="deleteForm{{ $agenda->id }}" action="{{ route('agenda.hapus', $agenda->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $agenda->id }}">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailModal{{ $agenda->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Agenda</h5>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">{!! $agenda->isi_agenda !!}</div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal{{ $agenda->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Agenda</h5>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('agenda.update', $agenda->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="judul_agenda">Judul</label>
                                                                <input type="text" class="form-control" name="judul_agenda" value="{{ $agenda->judul_agenda }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="foto_agenda">Foto</label>
                                                                <input type="file" class="form-control" name="foto_agenda">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="isi_agenda">Isi</label>
                                                                <input id="isi_agenda" type="hidden" name="isi_agenda" value="{{ $agenda->isi_agenda }}">
                                                                <trix-editor input="isi_agenda"></trix-editor>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
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
