@extends('layouts.mst')
@section('title', 'Beranda | '.env('APP_TITLE'))
@push('styles')
    <style>
        .projects-4 {
            margin: 0 auto;
        }

        .projects-4:after {
            content: '';
            display: block;
            clear: both;
        }

        .rating {
            border: none;
            float: left;
        }

        .rating > input {
            display: none;
        }

        .rating > label:before {
            margin: 0 5px 0 5px;
            font-size: 1.25em;
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            display: inline-block;
            content: "\f005";
        }

        .rating > .half:before {
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            content: "\f089";
            position: absolute;
        }

        .rating > label {
            color: #ddd;
            float: right;
        }

        .rating > input:checked ~ label,
        .rating:not(:checked) > label:hover,
        .rating:not(:checked) > label:hover ~ label {
            color: #2251b6;
        }

        .rating > input:checked + label:hover,
        .rating > input:checked ~ label:hover,
        .rating > label:hover ~ input:checked ~ label,
        .rating > input:checked ~ label:hover ~ label {
            color: #3776ff;
        }
    </style>
@endpush
@section('content')
    <!-- slider -->
    <section class="home-slider">
        <div id="slider">
            <div class="fullwidthbanner-container">
                <div id="revolution-slider">
                    <ul>
                        <li class="slider-bg2" data-transition="fade" data-slotamount="7" data-masterspeed="500">
                            <img src="{{asset('images/slider/beranda-pekerja.jpg')}}" alt="">
                            <div class="tp-caption sfr stt custom-size-6 white tp-resizeme zindex"
                                 data-x="center"
                                 data-hoffset="-15"
                                 data-y="150"
                                 data-speed="300"
                                 data-start="1000"
                                 data-easing="easeInOut">
                                TEMUKAN PEKERJA TERBAIK
                            </div>
                            <div class="tp-caption sfr stb text-center custom-size-8 white tp-resizeme zindex"
                                 data-x="center"
                                 data-hoffset="-15"
                                 data-y="230"
                                 data-speed="300"
                                 data-start="1800"
                                 data-easing="easeInOut">
                                <p>Dapatkan layanan/produk terbaik untuk memenuhi kebutuhan tugas/proyek Anda<br>
                                    yang disediakan oleh <b>Pekerja</b> {{env('APP_NAME')}}.</p>
                            </div>
                        </li>

                        <li class="slider-bg2" data-transition="fade" data-slotamount="7" data-masterspeed="500">
                            <img src="{{asset('images/slider/beranda-proyek.jpg')}}" alt="">
                            <div class="tp-caption sfr stt custom-size-6 white tp-resizeme zindex"
                                 data-x="center"
                                 data-hoffset="-15"
                                 data-y="150"
                                 data-speed="300"
                                 data-start="1000"
                                 data-easing="easeInOut">
                                TEMUKAN PROYEK TERBARU
                            </div>
                            <div class="tp-caption sfr stb text-center custom-size-8 white tp-resizeme zindex"
                                 data-x="center"
                                 data-hoffset="-15"
                                 data-y="230"
                                 data-speed="300"
                                 data-start="1800"
                                 data-easing="easeInOut">
                                <p>Dapatkan proyek terbaru dari berbagai kategori pekerjaan<br>
                                    yang dibagikan oleh <b>Klien</b> {{env('APP_NAME')}}.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- form pencarian -->
    <div class="course-search">
        <div class="search-center">
            <form id="form-pencarian" class="search-category" action="#">
                <div class="input-group">
                    <input type="hidden" name="filter">
                    <input id="keyword" type="text" class="form-control-2 padd-size size-2" name="q"
                           placeholder="Cari&hellip;" autocomplete="off" required>
                    <div class="input-group-btn search-panel">
                        <button type="button" class="btn-course dropdown-toggle" data-toggle="dropdown">
                            <span id="txt_filter">FILTER</span> <span class="caret"></span>
                        </button>
                        <ul id="filter-pencarian" class="dropdown-Menu" role="menu">
                            <li><a href="#">TUGAS/PROYEK</a></li>
                            <li><a href="#">LAYANAN</a></li>
                            <li><a href="#">PRODUK</a></li>
                        </ul>
                    </div>
                    <span class="input-group-btn">
                        <button class="btn-course border-radius-2" type="submit">
                            <i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <!-- fitur -->
    <section class="section-course">
        <div class="container">
            <div class="boxes-center">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box-content">
                            <h2><i class="fa fa-hand-holding-usd"></i> Tahu Harga Di Muka</h2>
                            <p align="justify">Temukan layanan apapun dan ketahui persis apa/berapa yang akan Anda
                                bayar. Tidak ada tarif per jam, hanya ada harga tetap.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-content">
                            <h2><i class="fa fa-shield-alt"></i> Jaminan Pembayaran</h2>
                            <p align="justify">Pembayaran Anda hanya akan diteruskan ke Pekerja setelah Anda senang dan
                                menyetujui hasil pekerjaan yang Anda dapat.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-content">
                            <h2><i class="fa fa-headset"></i> Bantuan 24/7</h2>
                            <p align="justify">{{env('APP_NAME')}} hadir untuk membantu Anda kapan dan dimana saja,
                                mulai dari menjawab pertanyaan hingga menyelesaikan masalah.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- daftar terbaru bagasku -->
    <section class="text-center our-works2 border-2 light padd-40">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title text-center">Daftar <strong class="strong-green">Terbaru</strong></h2>
                </div>
            </div>
        </div>
        <div class="our-projects color-2">
            <ul id="filter-daftar" class="filter-projects none-style">
                <li><a href="#" class="current" data-filter=".proyek" title="">TUGAS/PROYEK</a></li>
                <li><a href="#" data-filter=".layanan" title="">LAYANAN</a></li>
                <li><a href="#" data-filter=".produk" title="">PRODUK</a></li>
            </ul>

            <div id="daftar-terbaru" class="all-projects projects-4" style="margin: 0 auto">
                <div class="item proyek">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="{{asset('images/slider/beranda-proyek.jpg')}}" alt="thumbnail">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="{{asset('images/faces/thumbs50x50/1.jpg')}}" alt="avatar">
                                <span>Nama Klien</span>
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </p>
                            </div>
                            <div class="pull-right price">
                                <p>Rp0,00</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Judul Proyek</a></h3>
                            <p>Deskripsi singkat...</p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-calendar-day"></i> Deadline</p>
                            </div>
                            <div class="pull-right">
                                <p><i class="fa fa-paper-plane"></i> Total bid</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item proyek">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="{{asset('images/slider/beranda-proyek.jpg')}}" alt="thumbnail">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="{{asset('images/faces/thumbs50x50/2.jpg')}}" alt="avatar">
                                <span>Nama Klien</span>
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-alt"></i>
                                </p>
                            </div>
                            <div class="pull-right price">
                                <p>Rp0,00</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Judul Proyek</a></h3>
                            <p>Deskripsi singkat...</p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-calendar-day"></i> Deadline</p>
                            </div>
                            <div class="pull-right">
                                <p><i class="fa fa-paper-plane"></i> Total bid</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item proyek">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="{{asset('images/slider/beranda-proyek.jpg')}}" alt="thumbnail">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="{{asset('images/faces/thumbs50x50/3.jpg')}}" alt="avatar">
                                <span>Nama Klien</span>
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="far fa-star"></i>
                                </p>
                            </div>
                            <div class="pull-right price">
                                <p>Rp0,00</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Judul Proyek</a></h3>
                            <p>Deskripsi singkat...</p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-calendar-day"></i> Deadline</p>
                            </div>
                            <div class="pull-right">
                                <p><i class="fa fa-paper-plane"></i> Total bid</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item layanan">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="{{asset('images/slider/beranda-pekerja.jpg')}}" alt="thumbnail">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="{{asset('images/faces/thumbs50x50/4.jpg')}}" alt="avatar">
                                <span>Nama Pekerja</span>
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="far fa-star"></i>
                                </p>
                            </div>
                            <div class="pull-right price">
                                <p>Rp0,00</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Judul Layanan</a></h3>
                            <p>Deskripsi singkat...</p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-calendar-week"></i> Lama pengerjaan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item layanan">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="{{asset('images/slider/beranda-pekerja.jpg')}}" alt="thumbnail">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="{{asset('images/faces/thumbs50x50/5.jpg')}}" alt="avatar">
                                <span>Nama Pekerja</span>
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-alt"></i>
                                </p>
                            </div>
                            <div class="pull-right price">
                                <p>Rp0,00</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Judul Layanan</a></h3>
                            <p>Deskripsi singkat...</p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-calendar-week"></i> Lama pengerjaan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item layanan">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="{{asset('images/slider/beranda-pekerja.jpg')}}" alt="thumbnail">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="{{asset('images/faces/thumbs50x50/6.jpg')}}" alt="avatar">
                                <span>Nama Pekerja</span>
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </p>
                            </div>
                            <div class="pull-right price">
                                <p>Rp0,00</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Judul Layanan</a></h3>
                            <p>Deskripsi singkat...</p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-calendar-week"></i> Lama pengerjaan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item produk">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="{{asset('images/slider/kontak.jpg')}}" alt="thumbnail">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="{{asset('images/faces/thumbs50x50/4.jpg')}}" alt="avatar">
                                <span>Nama Pekerja</span>
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="far fa-star"></i>
                                </p>
                            </div>
                            <div class="pull-right price">
                                <p>Rp0,00</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Judul Produk</a></h3>
                            <p>Deskripsi singkat...</p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-eye"></i> Pratinjau</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item produk">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="{{asset('images/slider/kontak.jpg')}}" alt="thumbnail">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="{{asset('images/faces/thumbs50x50/4.jpg')}}" alt="avatar">
                                <span>Nama Pekerja</span>
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="far fa-star"></i>
                                </p>
                            </div>
                            <div class="pull-right price">
                                <p>Rp0,00</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Judul Produk</a></h3>
                            <p>Deskripsi singkat...</p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-eye"></i> Pratinjau</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- pekerja terbaik -->
    <section id="our-team" class="our-team border-2 color-1 color-2">
        <h2>Pekerja <strong class="strong-green">Terbaik</strong></h2>
        <div class="container">
            <div class="col-md-3 our-team-item">
                <img src="http://localhost:8000/images/team/man-1.png" alt="">
                <div class="our-content">
                    <h3>Nama Pekerja</h3>
                    <h5>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </h5>
                    <h6>Poin / Total proyek</h6>
                </div>
            </div>
            <div class="col-md-3 our-team-item">
                <img src="http://localhost:8000/images/team/man-2.png" alt="">
                <div class="our-content">
                    <h3>Nama Pekerja</h3>
                    <h5>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-alt"></i>
                    </h5>
                    <h6>Poin / Total proyek</h6>
                </div>
            </div>
            <div class="col-md-3 our-team-item">
                <img src="http://localhost:8000/images/team/man-3.png" alt="">
                <div class="our-content">
                    <h3>rick Nama Pekerja</h3>
                    <h5>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="far fa-star"></i>
                    </h5>
                    <h6>Poin / Total proyek</h6>
                </div>
            </div>
            <div class="col-md-3 our-team-item">
                <img src="http://localhost:8000/images/team/man-4.png" alt="">
                <div class="our-content">
                    <h3>Nama Pekerja</h3>
                    <h5>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-alt"></i>
                        <i class="far fa-star"></i>
                    </h5>
                    <h6>Poin / Total proyek</h6>
                </div>
            </div>
        </div>
    </section>

    <!-- daftar testimoni -->
    <section class="clients-testimonials padding">
        <div class="container bot-40">
            <h2 class="text-heading border-3 text-center">Testimoni <strong class="strong-green">Pengguna</strong></h2>
            <h3 class="text-heading">Berikut adalah ulasan dari pengguna {{env('APP_NAME')}}</h3>
        </div>
        <div class="container">
            <div id="testimoni" class="testi-slider testi-dark">
                <div class="education-testimonials">
                    <div class="col-md-6 item">
                        <div class="education-content">
                            <div class="img-info">
                                <img src="{{asset('images/faces/thumbs50x50/1.jpg')}}">
                            </div>
                            <div class="txt-info">
                                <h5>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="far fa-star"></i>
                                </h5>
                                <p>Komentar...</p>
                                <h3>Nama Pengguna</h3>
                                <span><i class="fa fa-calendar-alt"></i> Terakhir diperbarui</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 item">
                        <div class="education-content">
                            <div class="img-info">
                                <img src="{{asset('images/faces/thumbs50x50/2.jpg')}}">
                            </div>
                            <div class="txt-info">
                                <h5>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-alt"></i>
                                </h5>
                                <p>Komentar...</p>
                                <h3>Nama Pengguna</h3>
                                <span><i class="fa fa-calendar-alt"></i> Terakhir diperbarui</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="education-testimonials">
                    <div class="col-md-6 item">
                        <div class="education-content">
                            <div class="img-info">
                                <img src="{{asset('images/faces/thumbs50x50/3.jpg')}}">
                            </div>
                            <div class="txt-info">
                                <h5>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </h5>
                                <p>Komentar...</p>
                                <h3>Nama Pengguna</h3>
                                <span><i class="fa fa-calendar-alt"></i> Terakhir diperbarui</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 item">
                        <div class="education-content">
                            <div class="img-info">
                                <img src="{{asset('images/faces/thumbs50x50/4.jpg')}}">
                            </div>
                            <div class="txt-info">
                                <h5>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </h5>
                                <p>Komentar...</p>
                                <h3>Nama Pengguna</h3>
                                <span><i class="fa fa-calendar-alt"></i> Terakhir diperbarui</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- form testimoni -->
    <section class="subscribe bg-green">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="subscribe-form">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="title-form">
                                    <h3 class="white">{{$cek != null ? 'SUNTING/HAPUS ULASAN' : 'ULAS '.env('APP_NAME')}}</h3>
                                    @if($cek != null)
                                        <a href="{{route('hapus.testimoni',['id' => encrypt($cek->id)])}}"
                                           class="btn btn-grey delete-data">HAPUS</a>
                                    @else
                                        <p style="line-height: unset;">Beri kami ulasan dengan membagikan pengalaman
                                            Anda tentang layanan kami!</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="newsletter">
                                    <form action="{{route('kirim.testimoni')}}" class="comment-form" method="post">
                                        @csrf
                                        <input type="hidden" name="check_form"
                                               value="{{$cek != null ? $cek->id : 'create'}}">
                                        <div class="input-form" style="width: 70%">
                                            <textarea name="comment" id="comment" class="form-control"
                                                      style="resize: vertical; height: 75px; color: #fff"
                                                      placeholder="Bagikan pengalaman Anda tentang layanan kami disini&hellip;"
                                                      required>{{$cek != null ? $cek->comment : ''}}</textarea>
                                        </div>
                                        <fieldset id="rating" class="rating" aria-required="true">
                                            <label class="full" for="star5" data-toggle="tooltip"
                                                   title="Terbaik"></label>
                                            <input type="radio" id="star5" name="rating" value="5" required {{$cek != null
                                            && $cek->rate == '5' ? 'checked' : ''}}>

                                            <label class="half" for="star4half" data-toggle="tooltip"
                                                   title="Keren"></label>
                                            <input type="radio" id="star4half" name="rating" value="4.5" {{$cek != null
                                            && $cek->rate == '4.5' ? 'checked' : ''}}>

                                            <label class="full" for="star4" data-toggle="tooltip"
                                                   title="Cukup baik"></label>
                                            <input type="radio" id="star4" name="rating" value="4" {{$cek != null
                                            && $cek->rate == '4' ? 'checked' : ''}}>

                                            <label class="half" for="star3half" data-toggle="tooltip"
                                                   title="Baik"></label>
                                            <input type="radio" id="star3half" name="rating" value="3.5" {{$cek != null
                                            && $cek->rate == '3.5' ? 'checked' : ''}}>

                                            <label class="full" for="star3" data-toggle="tooltip"
                                                   title="Standar"></label>
                                            <input type="radio" id="star3" name="rating" value="3" {{$cek != null
                                            && $cek->rate == '3' ? 'checked' : ''}}>

                                            <label class="half" for="star2half" data-toggle="tooltip"
                                                   title="Cukup buruk"></label>
                                            <input type="radio" id="star2half" name="rating" value="2.5" {{$cek != null
                                            && $cek->rate == '2.5' ? 'checked' : ''}}>

                                            <label class="full" for="star2" data-toggle="tooltip" title="Buruk"></label>
                                            <input type="radio" id="star2" name="rating" value="2" {{$cek != null
                                            && $cek->rate == '2' ? 'checked' : ''}}>

                                            <label class="half" for="star1half" data-toggle="tooltip"
                                                   title="Sangat buruk"></label>
                                            <input type="radio" id="star1half" name="rating" value="1.5" {{$cek != null
                                            && $cek->rate == '1.5' ? 'checked' : ''}}>

                                            <label class="full" for="star1" data-toggle="tooltip"
                                                   title="Menyedihkan"></label>
                                            <input type="radio" id="star1" name="rating" value="1" {{$cek != null
                                            && $cek->rate == '1' ? 'checked' : ''}}>

                                            <label class="half" for="starhalf" data-toggle="tooltip"
                                                   title="Sangat menyedihkan"></label>
                                            <input type="radio" id="starhalf" name="rating" value="0.5" {{$cek != null
                                            && $cek->rate == '0.5' ? 'checked' : ''}}>
                                        </fieldset>
                                        <input type="submit" class="btn education-btn-2 color-1" value="{{$cek != null
                                        ? 'SIMPAN' : 'KIRIM'}}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(function () {
            $("#testimoni").owlCarousel({
                navigation: false,
                slideSpeed: 600,
                autoPlay: 6000,
                singleItem: true,
                pagination: true,
                navigationText: [
                    "<i class='fa fa-caret-left'></i>",
                    "<i class='fa fa-caret-right'></i>"
                ],
            });
        });

        $(window).load(function() {
            var $container = $('#daftar-terbaru');
            $container.isotope({
                itemSelector: '.item',
                filter: '.proyek',
                masonry: {
                    columnWidth: 337,
                    isFitWidth: true
                }
            });

            $('#filter-daftar a').on('click', function () {
                if ($(this).hasClass('current')) {
                    return false;
                }

                $(this).parents().find('.current').removeClass('current');
                $(this).addClass('current');

                $container.isotope({
                    filter: $(this).attr('data-filter'),
                });

                return false;
            });
        });

        $("#filter-pencarian > li").on("click", function () {
            var filter = $(this).text();

            $("#txt_filter").text(filter);
            $("#form-pencarian input[name='filter']").val(filter.toLowerCase());
            $("#keyword").attr('placeholder', 'Cari ' + filter.toLowerCase() + '...');
        });

        $("#form-pencarian").on('submit', function (e) {
            e.preventDefault();
            var filter = $("#form-pencarian input[name='filter']").val();

            if (!filter) {
                swal('PERHATIAN!', 'Silahkan pilih filter pencarian terlebih dahulu, terimakasih.', 'warning');
            } else {
                $(this)[0].submit();
            }
        });
    </script>
@endpush
