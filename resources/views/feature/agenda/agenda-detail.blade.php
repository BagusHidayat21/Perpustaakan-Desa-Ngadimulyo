@extends('layout.main')
@section('title', 'Detail | Perpustakaan Desa')
@section('content')
    <!-- Inner Banner -->
    <div class="inner-banner inner-banner-bg9">
        <div class="container">
            <div class="inner-title">
                <h3>{{ $agenda->judul_agenda }}</h3>
                <ul>
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>Detail Agenda</li>
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
                            <div class="tab_content current active">
                                <div class="tabs_item current">
                                    <div class="courses-details-tab-content">
                                        <div class="courses-details-into">
                                            <h3>{{ $agenda->judul_agenda }}</h3>
                                <p class="text-primary">Admin || {{$formattedDate}}</p>

                                            <img src="{{ asset('storage/' . $agenda->foto_agenda) }}" height="400"
                                                alt="Foto Agenda" />

                                            <p style="text-align: justify;">{!! $agenda->isi_agenda !!}</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Courses Details Area End -->
@endsection
