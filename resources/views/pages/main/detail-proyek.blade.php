@extends('layouts.mst')
@section('title', 'Detail Tugas/Proyek: '.$proyek->judul.' – '.$user->name.' | '.env('APP_TITLE'))
@push('styles')
    <link rel="stylesheet" href="{{asset('css/card.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-tabs-responsive.css')}}">
    <style>
        blockquote {
            background: unset;
            border-color: unset;
            color: unset;
        }

        [data-scrollbar] {
            max-height: 350px;
        }

        .sub-menu {
            font-size: 14px;
        }

        .sub-menu li {
            border-bottom: 1px solid #eee;
        }

        .sub-menu a {
            display: block;
            text-decoration: none;
            color: #4d4d4d;
            padding: 12px;
            padding-left: 15px;
            -webkit-transition: all 0.25s ease;
            -o-transition: all 0.25s ease;
            transition: all 0.25s ease;
        }

        .sub-menu img {
            transition: transform .5s ease;
        }

        .sub-menu a:hover .sub-menu-name,
        .sub-menu a:focus .sub-menu-name,
        .sub-menu a:active .sub-menu-name {
            color: #122752 !important;
        }

        .sub-menu a:hover img,
        .sub-menu a:focus img,
        .sub-menu a:active img,
        .sub-menu a:hover .sub-menu-blockquote,
        .sub-menu a:focus .sub-menu-blockquote,
        .sub-menu a:active .sub-menu-blockquote {
            border-color: #122752;
        }

        .sub-menu a .list-category {
            text-transform: uppercase;
        }

        .sub-menu a .list-category i {
            margin: auto .5em;
            color: #4d4d4d;
        }
    </style>
@endpush
@section('content')
    <div class="breadcrumbs" style="background-image: url('{{$user->get_bio->latar_belakang != null ?
    asset('storage/users/latar_belakang/'.$user->get_bio->latar_belakang) : asset('images/slider/beranda-proyek.jpg')}}')">
        <div class="breadcrumbs-overlay"></div>
        <div class="page-title">
            <h2>{{$proyek->judul}}</h2>
            <p>Kategori {{$proyek->get_sub->get_kategori->nama.': '.$proyek->get_sub->nama}}</p>
        </div>
        <ul class="crumb">
            <li><a href="{{route('beranda')}}"><i class="fa fa-home"></i></a></li>
            <li style="text-transform: none"><i class="fa fa-angle-double-right"></i>
                <a href="{{route('profil.user',['username' => $user->username])}}">{{$user->username}}</a></li>
            <li><a href="#" onclick="goToAnchor()"><i class="fa fa-angle-double-right"></i> Detail Tugas/Proyek</a></li>
        </ul>
    </div>

    <section class="none-margin" style="padding: 40px 0 40px 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="img-card">
                                    <img style="width: 100%" alt="Thumbnail" src="{{$proyek->thumbnail == "" ?
                                    asset('images/slider/beranda-proyek.jpg') :
                                    asset('storage/proyek/thumbnail/' . $proyek->thumbnail)}}">
                                </div>

                                <div class="card-content">
                                    <div class="card-title text-center">
                                        <h3 style="color: #122752;margin: 0 0 .5em 0;text-transform: none">
                                            Rp{{number_format($proyek->harga,2,',','.')}}</h3>
                                    </div>
                                    <div class="card-title">
                                        <div class="row text-center">
                                            <div class="col-lg-12">
                                                <button id="btn_bid" style="border: 1px solid #eee"
                                                        class="btn btn-link btn-sm btn-block {{$cek > 0 ? '' : 'ld ld-breath'}}"
                                                    {{$cek > 0 ? 'disabled' : ''}}>
                                                    <i class="fa fa-paper-plane mr-2"></i>
                                                    {{$cek > 0 ? 'BID TELAH DIAJUKAN' : 'AJUKAN BID SEKARANG'}}
                                                </button>
                                            </div>
                                        </div>
                                        <hr style="margin: 10px 0">
                                        <table style="font-size: 14px;margin-top: 1em">
                                            <tr>
                                                <td><i class="fa fa-business-time"></i></td>
                                                <td>&nbsp;Jenis Tugas/Proyek</td>
                                                <td>: {{$proyek->pribadi == false ? 'PUBLIK' : 'PRIVAT'}}</td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-calendar-week"></i></td>
                                                <td>&nbsp;Batas Waktu</td>
                                                <td>: {{$proyek->waktu_pengerjaan}} hari</td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-user-tie"></i></td>
                                                <td>&nbsp;Total Bid</td>
                                                <td>: {{is_null($proyek->get_bid) ? 0 : count($proyek->get_bid)}}bid
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-calendar-check"></i></td>
                                                <td>&nbsp;Diposting Tanggal</td>
                                                <td>
                                                    : {{$proyek->created_at->formatLocalized('%d %B %Y')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-clock"></i></td>
                                                <td>&nbsp;Update Terakhir</td>
                                                <td style="text-transform: none;">
                                                    : {{$proyek->updated_at->diffForHumans()}}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="img-card">
                                    <img style="width: 100%" alt="Avatar" src="{{$user->get_bio->foto== "" ?
                                    asset('images/faces/thumbs50x50/'.rand(1,6).'.jpg') :
                                    asset('storage/users/foto/'.$user->get_bio->foto)}}">
                                </div>

                                <div class="card-content">
                                    <div class="card-title text-center">
                                        <a href="{{$user->id == Auth::id() ? route('user.profil') :
                                        route('profil.user',['username' => $user->username])}}">
                                            <h4 style="color: #122752">{{$user->name}}</h4></a>
                                        <small style="text-transform: none">
                                            {{$user->get_bio->status != "" ? $user->get_bio->status : 'Status (-)'}}
                                        </small>
                                    </div>
                                    <div class="card-title">
                                        <hr style="margin: 10px 0">
                                        <table style="font-size: 14px;">
                                            <tr>
                                                <td><i class="fa fa-map-marker-alt"></i></td>
                                                <td>&nbsp;</td>
                                                <td>
                                                    @if($user->get_bio->kota_id != "" && $user->get_bio->kewarganegaraan != "")
                                                        {{$user->get_bio->get_kota->nama.', '.$user->get_bio->get_kota->get_provinsi->nama.', '.$user->get_bio->kewarganegaraan}}
                                                    @else
                                                        Kabupaten/Kota, Provinsi (-)
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-comments"></i></td>
                                                <td>&nbsp;</td>
                                                <td style="text-transform: none">
                                            <span style="color: #ffc100">
                                                @if(round($rating_klien * 2) / 2 == 1)
                                                    <i class="fa fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                @elseif(round($rating_klien * 2) / 2 == 2)
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                @elseif(round($rating_klien * 2) / 2 == 3)
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                @elseif(round($rating_klien * 2) / 2 == 4)
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                @elseif(round($rating_klien * 2) / 2 == 5)
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                @elseif(round($rating_klien * 2) / 2 == 0.5)
                                                    <i class="fa fa-star-half-alt"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                @elseif(round($rating_klien * 2) / 2 == 1.5)
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-alt"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                @elseif(round($rating_klien * 2) / 2 == 2.5)
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-alt"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                @elseif(round($rating_klien * 2) / 2 == 3.5)
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-alt"></i>
                                                    <i class="far fa-star"></i>
                                                @elseif(round($rating_klien * 2) / 2 == 4.5)
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-alt"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                @endif </span>
                                                    <b>{{round($rating_klien * 2) /2}}</b> ({{count($ulasan_klien)}}
                                                    ulasan)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-trophy"></i></td>
                                                <td>&nbsp;</td>
                                                <td>{{$user->get_bio->total_bintang_klien}} poin
                                                    <span style="text-transform: none">(#{{$user->get_rank_klien().' dari '.$total_user}})</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-business-time"></i></td>
                                                <td>&nbsp;</td>
                                                <td>{{$user->get_project->count()}} proyek</td>
                                            </tr>
                                        </table>
                                        <hr style="margin: 10px 0">
                                        <table style="font-size: 14px; margin-top: 0">
                                            <tr>
                                                <td><i class="fa fa-calendar-check"></i></td>
                                                <td>&nbsp;Bergabung Sejak</td>
                                                <td>
                                                    : {{$user->created_at->formatLocalized('%d %B %Y')}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-clock"></i></td>
                                                <td>&nbsp;Update Terakhir</td>
                                                <td style="text-transform: none;">
                                                    : {{$user->updated_at->diffForHumans()}}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <div class="row card-data div-data">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-title">
                                        <small>{{$proyek->judul}}</small>
                                        <hr class="mt-0">
                                        <blockquote data-scrollbar>
                                            {!! $proyek->deskripsi !!}
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row card-data div-data">
                        <div class="col-lg-12">
                            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">
                                    <li role="presentation" class="active">
                                        <a class="nav-item nav-link" href="#lampiran" id="lampiran-tab" role="tab"
                                           data-toggle="tab" aria-controls="lampiran" aria-expanded="true">
                                            <i class="fa fa-archive mr-2"></i>LAMPIRAN
                                            <span class="badge badge-secondary">
                                                @if(!is_null($proyek->lampiran))
                                                    {{count($proyek->lampiran) > 999 ? '999+' : count($proyek->lampiran)}}
                                                @else
                                                    0
                                                @endif
                                            </span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="next">
                                        <a class="nav-item nav-link" href="#bid" id="bid-tab"
                                           role="tab" data-toggle="tab" aria-controls="bid"
                                           aria-expanded="true"><i class="fa fa-paper-plane mr-2"></i>BIDDER
                                            <span class="badge badge-secondary">
                                                 @if(!is_null($proyek->get_bid))
                                                    {{count($proyek->get_bid) > 999 ? '999+' : count($proyek->get_bid)}}
                                                @else
                                                    0
                                                @endif
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="lampiran"
                                         aria-labelledby="lampiran-tab" style="border: none">
                                        <ul class="sub-menu">
                                            @if(!is_null($proyek->lampiran))
                                                @foreach($proyek->lampiran as $file)
                                                    @php
                                                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                                        if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif") {
                                                            $src = asset('storage/proyek/lampiran/' .$file);
                                                        } else {
                                                            $src = asset('images/files.png');
                                                        }
                                                    @endphp
                                                    <li>
                                                        <a href="{{asset('storage/proyek/lampiran/' .$file)}}">
                                                            <div class="media">
                                                                <div class="media-left media-middle">
                                                                    <img width="100" alt="lampiran" src="{{$src}}"
                                                                         class="media-object img-thumbnail">
                                                                </div>
                                                                <div class="media-body">
                                                                    <blockquote style="text-transform: none">
                                                                        {{$file}}
                                                                    </blockquote>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li style="border: none">Tidak ada lampiran.</li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="bid" aria-labelledby="bid-tab"
                                         style="border: none">
                                        <ul class="sub-menu">
                                            @if(!is_null($proyek->get_bid))
                                                @foreach($proyek->get_bid as $row)
                                                    @php
                                                        $pekerja = $row->get_user;
                                                        $ulasan_pekerja = \App\Model\ReviewWorker::whereHas('get_pengerjaan', function ($q) use ($pekerja) {
                                                            $q->where('user_id', $pekerja->id);
                                                        })->get();
                                                        $ulasan_layanan = \App\Model\UlasanService::whereHas('get_pengerjaan', function ($q) use ($pekerja) {
                                                            $q->where('user_id', $pekerja->id);
                                                        })->count();
                                                        $rating_pekerja = count($ulasan_pekerja) + $ulasan_layanan > 0 ?
                                                            $pekerja->get_bio->total_bintang_pekerja / (count($ulasan_pekerja) + $ulasan_layanan) : 0;
                                                    @endphp
                                                    <li>
                                                        <a href="{{route('profil.user',['username' => $pekerja->username])}}">
                                                            <div class="media">
                                                                <div class="media-left media-middle">
                                                                    <img alt="avatar" src="{{$pekerja->get_bio->foto
                                                                        == "" ? asset('images/faces/thumbs50x50/'.rand(1,6).'.jpg') :
                                                                        asset('storage/users/foto/'.$pekerja->get_bio->foto)}}"
                                                                         class="media-object img-thumbnail"
                                                                         width="64" style="border-radius: 100%">
                                                                </div>
                                                                <div class="media-body">
                                                                    <p class="media-heading">
                                                                        <i class="fa fa-user-tie sub-menu-name mr-2"
                                                                           style="color: #4d4d4d"></i>
                                                                        <b class="sub-menu-name">{{$pekerja->name}}</b>
                                                                        <i class="fa fa-star"
                                                                           style="color: #ffc100;margin: 0 0 0 .5rem"></i>
                                                                        <b>{{round($rating_pekerja * 2) / 2}}</b>
                                                                        <span class="pull-right"
                                                                              style="color: #999">
                                                                                <i class="fa fa-clock"
                                                                                   style="color: #aaa;margin: 0"></i>
                                                                                {{$row->created_at->diffForHumans()}}
                                                                            </span>
                                                                    </p>
                                                                    <blockquote class="sub-menu-blockquote">
                                                                        {!! !is_null($pekerja->get_bio->summary) ?
                                                                        $pekerja->get_bio->summary : $pekerja->name.
                                                                        ' belum menuliskan apapun di profilnya.' !!}
                                                                    </blockquote>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li style="border: none">Tidak ada bid.</li>
                                            @endif
                                        </ul>
                                    </div>
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
        var $btn = $("#btn_bid");
        $(function () {
            @if(session('bid'))
            swal({
                title: 'Sukses!',
                text: '{{session('bid')}} Apakah Anda ingin melihat status bid Anda sekarang? ' +
                    'Klik tombol "Ya" maka Anda akan langsung dialihkan ke halaman "Dashboard Pekerja: Tugas/Proyek".',
                icon: 'warning',
                dangerMode: true,
                buttons: ["Tidak", "Ya"],
                closeOnEsc: false,
                closeOnClickOutside: false,
            }).then((confirm) => {
                if (confirm) {
                    swal({icon: "success", buttons: false});
                    window.location.href = '{{route('dashboard.pekerja.proyek')}}';
                }
            });
            @endif
        });

        $btn.on({
            mouseenter: function () {
                $(this).removeClass('ld ld-breath');
            },
            mouseleave: function () {
                $(this).addClass('ld ld-breath');
            }
        });

        $btn.on('click', function () {
            @auth
            @if(Auth::user()->isOther())
            @if($user->id == Auth::id())
            swal('PERHATIAN!', 'Maaf, Anda tidak bisa mengajukan bid untuk tugas/proyek Anda sendiri.', 'warning');
            @else
            swal({
                title: 'Ajukan Bid',
                text: 'Apakah Anda yakin akan mengajukan bid untuk tugas/proyek "{{$proyek->judul}}" ' +
                    'yang ditawarkan oleh "{{$user->name}}"? Anda tidak dapat mengembalikannya!',
                icon: 'warning',
                dangerMode: true,
                buttons: ["Tidak", "Ya"],
                closeOnEsc: false,
                closeOnClickOutside: false,
            }).then((confirm) => {
                if (confirm) {
                    swal({icon: "success", buttons: false});
                    window.location.href = '{{route('bid.proyek',['username' => $user->username, 'judul' => $proyek->permalink])}}';
                }
            });
            @endif
            @else
            swal('PERHATIAN!', 'Fitur ini hanya berfungsi ketika Anda masuk sebagai Klien/Pekerja.', 'warning');
            @endif
            @else
            openLoginModal();
            @endauth
        });

        $(".sub-menu li a").on({
            mouseenter: function () {
                $(this).parent().css('border-color', '#122752');
            },
            mouseleave: function () {
                $(this).parent().css('border-color', '#eee');
            }
        });

        $(document).on('show.bs.tab', '.nav-tabs-responsive [data-toggle="tab"]', function (e) {
            var $target = $(e.target);
            var $tabs = $target.closest('.nav-tabs-responsive');
            var $current = $target.closest('li');
            var $parent = $current.closest('li.dropdown');
            $current = $parent.length > 0 ? $parent : $current;
            var $next = $current.next();
            var $prev = $current.prev();
            var updateDropdownMenu = function ($el, position) {
                $el
                    .find('.dropdown-menu')
                    .removeClass('pull-xs-left pull-xs-center pull-xs-right')
                    .addClass('pull-xs-' + position);
            };

            $tabs.find('>li').removeClass('next prev');
            $prev.addClass('prev');
            $next.addClass('next');

            updateDropdownMenu($prev, 'left');
            updateDropdownMenu($current, 'center');
            updateDropdownMenu($next, 'right');
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            setTimeout(function () {
                $('.use-nicescroll').getNiceScroll().resize()
            }, 600);
        });

        function goToAnchor() {
            $('html,body').animate({scrollTop: $(".none-margin").offset().top}, 500);
        }
    </script>
@endpush
