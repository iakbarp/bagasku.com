@extends('layouts.mst')
@section('title', 'Dashboard Klien: Tugas/Proyek – '.$user->name.' | '.env('APP_TITLE'))
@push('styles')
    <link rel="stylesheet" href="{{asset('css/card.css')}}">
    <link rel="stylesheet" href="{{asset('css/file-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-tabs-responsive.css')}}">
    <link rel="stylesheet" href="{{asset('admins/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('admins/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/modules/datatables/Select-1.2.4/css/select.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/modules/datatables/Buttons-1.5.6/css/buttons.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/lightgallery/dist/css/lightgallery.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        blockquote {
            background: unset;
            border-color: unset;
            color: unset;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table-striped a {
            color: #777;
            font-weight: 500;
            transition: all .3s ease;
            text-decoration: none !important;
        }

        .table-striped a:hover, .table-striped a:focus, .table-striped a:active {
            color: #122752;
        }

        .btn-link {
            border: 1px solid #ccc;
        }

        .pm-selector input {
            margin: 0;
            padding: 0;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .pm-selector-2 input {
            position: absolute;
            z-index: 999;
        }

        .pm-selector-2 input:active + .pm-label, .pm-selector input:active + .pm-label {
            opacity: .9;
        }

        .pm-selector-2 input:checked + .pm-label, .pm-selector input:checked + .pm-label {
            -webkit-filter: none;
            -moz-filter: none;
            filter: none;
        }

        .pm-label {
            cursor: pointer;
            background-size: contain;
            background-repeat: no-repeat;
            display: inline-block;
            width: 150px;
            height: 50px;
            -webkit-transition: all 100ms ease-in;
            -moz-transition: all 100ms ease-in;
            transition: all 100ms ease-in;
            -webkit-filter: brightness(1.8) grayscale(1) opacity(.7);
            -moz-filter: brightness(1.8) grayscale(1) opacity(.7);
            filter: brightness(1.8) grayscale(1) opacity(.7);
        }

        .pm-label:hover {
            -webkit-filter: brightness(1.2) grayscale(.5) opacity(.9);
            -moz-filter: brightness(1.2) grayscale(.5) opacity(.9);
            filter: brightness(1.2) grayscale(.5) opacity(.9);
        }

        .content-area {
            position: relative;
            cursor: pointer;
            overflow: hidden;
            margin: 1em auto;
        }

        .custom-overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            background: rgba(0, 0, 0, 0.7);
            opacity: 0;
            transition: all 400ms ease-in-out;
            height: 100%;
        }

        .custom-overlay:hover {
            opacity: 1;
        }

        .custom-text {
            position: absolute;
            top: 50%;
            left: 10px;
            right: 10px;
            transform: translateY(-50%);
            color: #eee;
        }

        .content-area img {
            transition: transform .5s ease;
        }

        .content-area:hover img {
            transform: scale(1.2);
        }

        .lg-backdrop {
            z-index: 9999999;
        }

        .lg-outer {
            z-index: 10000000;
        }

        .lg-sub-html h4 {
            color: #eee;
        }

        .lg-sub-html p {
            color: #bbb;
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
            color: #ffc100;
        }

        .rating > input:checked + label:hover,
        .rating > input:checked ~ label:hover,
        .rating > label:hover ~ input:checked ~ label,
        .rating > input:checked ~ label:hover ~ label {
            color: #e1a500;
        }

        .note-editor.note-airframe .note-editing-area .note-editable, .note-editor.note-frame .note-editing-area .note-editable,
        .note-editor.note-airframe .note-placeholder, .note-editor.note-frame .note-placeholder {
            padding: 20px 30px;
            text-transform: none;
        }
    </style>
@endpush
@section('content')
    <div class="breadcrumbs" style="background-image: url('{{$user->get_bio->latar_belakang != null ?
    asset('storage/users/latar_belakang/'.$user->get_bio->latar_belakang) : asset('images/slider/beranda-proyek.jpg')}}')">
        <div class="breadcrumbs-overlay"></div>
        <div class="page-title">
            <h2>Dashboard Klien: Tugas/Proyek</h2>
            <p>Halaman ini menampilkan daftar tugas/proyek yang Anda tawarkan beserta status bid, pembayaran, dan
                pengerjaannya.</p>
        </div>
        <ul class="crumb">
            <li><a href="{{route('beranda')}}"><i class="fa fa-home"></i></a></li>
            <li><i class="fa fa-angle-double-right"></i> <a href="#">Dashboard Klien</a></li>
            <li><i class="fa fa-angle-double-right"></i> <a href="{{url()->current()}}">Tugas/Proyek</a></li>
            <li><a href="#" onclick="goToAnchor()"><i class="fa fa-angle-double-right"></i> Daftar Tugas/Proyek &
                    Pengerjaan</a></li>
        </ul>
    </div>

    <section class="none-margin" style="padding: 40px 0 40px 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 text-center">
                    <div class="card">
                        <div class="img-card">
                            <img style="width: 100%" alt="Avatar" src="{{$user->get_bio->foto == "" ?
                            asset('images/faces/thumbs50x50/'.rand(1,6).'.jpg') : asset('storage/users/foto/'.$user->get_bio->foto)}}">
                        </div>
                        <div class="card-content">
                            <div class="card-title text-center">
                                <a href="{{route('user.profil')}}"><h4 style="color: #122752">{{$user->name}}</h4></a>
                                <small style="text-transform: none">{{$user->get_bio->status != "" ?
                                $user->get_bio->status : 'Status (-)'}}</small>
                            </div>
                            <div class="card-title">
                                <a href="{{route('profil.user', ['username' => $user->username])}}"
                                   class="btn btn-link btn-sm btn-block">Lihat Mode Publik
                                </a>
                                <hr style="margin: 10px 0">
                                <table class="stats" style="font-size: 14px; margin-top: 0">
                                    <tr data-toggle="tooltip" data-placement="left" title="Bergabung Sejak">
                                        <td><i class="fa fa-calendar-check"></i></td>
                                        <td>&nbsp;</td>
                                        <td>{{$user->created_at->formatLocalized('%d %B %Y')}}</td>
                                    </tr>
                                    <tr data-toggle="tooltip" data-placement="left" title="Update Terakhir">
                                        <td><i class="fa fa-clock"></i></td>
                                        <td>&nbsp;</td>
                                        <td style="text-transform: none;">{{$user->updated_at->diffForHumans()}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-6 col-sm-12">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">
                            <li role="presentation" class="active">
                                <a class="nav-item nav-link" href="#proyek" id="proyek-tab" role="tab"
                                   data-toggle="tab" aria-controls="proyek" aria-expanded="true">
                                    <i class="fa fa-th-list mr-2"></i>TUGAS/PROYEK <span class="badge badge-secondary">
                                        {{count($proyek) > 999 ? '999+' : count($proyek)}}</span></a>
                            </li>
                            <li role="presentation" class="next">
                                <a class="nav-item nav-link" href="#pengerjaan" id="pengerjaan-tab"
                                   role="tab" data-toggle="tab" aria-controls="pengerjaan" aria-expanded="true">
                                    <i class="fa fa-business-time mr-2"></i>PENGERJAAN
                                    <span class="badge badge-secondary">
                                        {{count($pengerjaan) > 999 ? '999+' : count($pengerjaan)}}</span>
                                </a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="proyek"
                                 aria-labelledby="proyek-tab" style="border: none">
                                <div class="table-responsive" id="dt-proyek">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Tugas/Proyek</th>
                                            <th class="text-center">Batas Waktu</th>
                                            <th class="text-right">Harga (Rp)</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $no = 1; @endphp
                                        @foreach($proyek as $row)
                                            @php
                                                if($row->pribadi == false) {
                                                    if(count($row->get_bid) > 0) {
                                                        $bid = count($row->get_bid).' bid';
                                                        $attr = 'disabled';
                                                    } else {
                                                        $bid = '0 bid';
                                                        $attr = '';
                                                    }
                                                } else {
                                                    if(!is_null($row->get_pengerjaan)) {
                                                        $attr = 'disabled';
                                                    } else {
                                                        $attr = '';
                                                    }
                                                }
                                            @endphp
                                            <tr>
                                                <td style="vertical-align: middle" align="center">{{$no++}}</td>
                                                <td style="vertical-align: middle">
                                                    <a href="{{route('detail.proyek', ['username' =>
                                                            $row->get_user->username, 'judul' => $row->permalink])}}">
                                                        <img class="img-responsive float-left mr-2" width="80"
                                                             alt="Thumbnail" src="{{$row->thumbnail != "" ?
                                                                     asset('storage/proyek/thumbnail/'.$row->thumbnail)
                                                                     : asset('images/slider/beranda-proyek.jpg')}}">
                                                        <span
                                                            class="label label-info">{{$row->get_sub->get_kategori->nama}}</span>
                                                        <br><b>{{$row->judul}}</b>
                                                    </a>
                                                    {!! $row->deskripsi !!}
                                                </td>
                                                <td style="vertical-align: middle"
                                                    align="center">{{$row->waktu_pengerjaan}} hari
                                                </td>
                                                <td style="vertical-align: middle"
                                                    align="right">{{number_format($row->harga,2,',','.')}}</td>
                                                <td style="vertical-align: middle" align="center">
                                                    <span
                                                        class="label label-{{$row->pribadi == false ? 'info' : 'primary'}}">
                                                        {{$row->pribadi == false ? 'PUBLIK' : 'PRIVAT'}}</span>
                                                </td>
                                                <td style="vertical-align: middle" align="center">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <a class="btn btn-link btn-sm" href="{{route('detail.proyek',
                                                            ['username' => $row->get_user->username, 'judul' => $row->permalink])}}"
                                                               data-toggle="tooltip" title="Lihat Proyek">
                                                                <i class="fa fa-info-circle" style="margin-right:0"></i>
                                                            </a>
                                                            <a class="btn btn-link btn-sm"
                                                               href="{{route('klien.lampiran.proyek', ['judul' => $row->permalink])}}"
                                                               data-toggle="tooltip" title="Lihat Lampiran">
                                                                <i class="fa fa-archive" style="margin-right: 0"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                                    <hr style="margin: .5em 0">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-link btn-sm" data-toggle="tooltip"
                                                                    title="Sunting Proyek" {{$attr}}
                                                                    onclick="suntingProyek('{{route('klien.sunting.proyek', ['id' => $row->id])}}')">
                                                                <i class="fa fa-edit" style="margin-right: 0"></i>
                                                            </button>
                                                            <button class="btn btn-link btn-sm" data-toggle="tooltip"
                                                                    title="Hapus Proyek" type="button" {{$attr}}
                                                                    onclick="hapusProyek('{{route("klien.hapus.proyek",
                                                                    ["id" => $row->id])}}','{{$row->judul}}')">
                                                                <i class="fa fa-trash-alt" style="margin-right: 0"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    <hr style="margin: .5em 0">
                                                    @if($row->pribadi == false)
                                                        <a class="btn btn-link btn-sm btn-block" data-toggle="tooltip"
                                                           title="Lihat Bidder" style="text-transform: none"
                                                           href="{{route('klien.bid.proyek',['judul' => $row->permalink])}}">
                                                            <i class="fa fa-paper-plane"></i> {{$bid}}
                                                        </a>
                                                    @else
                                                        <a class="btn btn-link btn-sm btn-block" data-toggle="tooltip"
                                                           title="Lihat Pekerja" style="text-transform: none"
                                                           href="{{route('profil.user', ['username' => $row->get_undangan->get_user->username])}}">
                                                            <i class="fa fa-hard-hat"></i> {{$row->get_undangan->get_user->username}}
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <form id="form-proyek" class="form-horizontal" role="form" method="POST"
                                      enctype="multipart/form-data" style="display: none">
                                    @csrf
                                    <div class="card">
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="id">
                                        <div class="card-content">
                                            <div class="card-title">
                                                <small></small>
                                                <hr class="mt-0">
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label class="form-control-label" for="subkategori_id">Kategori
                                                            <span class="required">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-tag"></i></span>
                                                            <select id="subkategori_id" class="form-control use-select2"
                                                                    name="subkategori_id" required>
                                                                <option></option>
                                                                @foreach($kategori as $row)
                                                                    <optgroup label="{{$row->nama}}">
                                                                        @foreach($row->get_sub as $sub)
                                                                            <option
                                                                                value="{{$sub->id}}">{{$sub->nama}}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label for="judul2" class="form-control-label">Judul <span
                                                                class="required">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-text-width"></i></span>
                                                            <input id="judul2" type="text" name="judul"
                                                                   class="form-control"
                                                                   placeholder="Judul" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-12">
                                                        <label for="deskripsi" class="form-control-label">Deskripsi
                                                            <span class="required">*</span></label>
                                                        <textarea id="deskripsi" name="deskripsi"
                                                                  class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-5">
                                                        <label class="form-control-label" for="waktu_pengerjaan">
                                                            Batas Waktu Pengerjaan <span class="required">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar-week"></i></span>
                                                            <input id="waktu_pengerjaan" class="form-control"
                                                                   name="waktu_pengerjaan" type="text" placeholder="0"
                                                                   onkeypress="return numberOnly(event, false)"
                                                                   required>
                                                            <span class="input-group-addon">
                                                                <b style="text-transform: none">hari</b></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <label class="form-control-label" for="harga">
                                                            Harga/Budget Proyek <span class="required">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><b>Rp</b></span>
                                                            <input id="harga" class="form-control rupiah" name="harga"
                                                                   type="text" placeholder="0" required>
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-money-bill-wave-alt"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div id="div-thumbnail" class="col-md-5 has-feedback">
                                                        <label for="txt_thumbnail"
                                                               class="form-control-label">Thumbnail</label>
                                                        <input type="file" name="thumbnail" accept="image/*"
                                                               id="attach-thumbnail" style="display: none;">
                                                        <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-image"></i></span>
                                                            <input type="text" id="txt_thumbnail"
                                                                   style="cursor: pointer"
                                                                   class="browse_thumbnail form-control" readonly
                                                                   placeholder="Pilih File" data-toggle="tooltip"
                                                                   data-placement="top"
                                                                   title="Ekstensi yang diizinkan: jpg, jpeg, gif, png. Ukuran yang diizinkan: < 2 MB">
                                                            <span class="input-group-btn">
                                                                <button
                                                                    class="browse_thumbnail btn btn-link btn-sm btn-block"
                                                                    type="button" style="border: 1px solid #ccc">
                                                                    <i class="fa fa-search"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div id="div-lampiran" class="col-md-7">
                                                        <label for="txt_lampiran"
                                                               class="form-control-label">Lampiran</label>
                                                        <input type="file" name="lampiran[]" id="attach-lampiran"
                                                               accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.odt,.ppt,.pptx"
                                                               style="display: none;" multiple>
                                                        <div class="input-group">
                                                        <span class="input-group-addon"><i
                                                                class="fa fa-archive"></i></span>
                                                            <input type="text" id="txt_lampiran" style="cursor: pointer"
                                                                   class="browse_lampiran form-control" readonly
                                                                   placeholder="Pilih File" data-toggle="tooltip"
                                                                   data-placement="top"
                                                                   title="Ekstensi yang diizinkan: jpg, jpeg, gif, png, pdf, doc, docx, xls, xlsx, odt, ppt, pptx. Ukuran yang diizinkan: < 5 MB">
                                                            <span class="input-group-btn">
                                                                <button
                                                                    class="browse_lampiran btn btn-link btn-sm btn-block"
                                                                    type="button" style="border: 1px solid #ccc">
                                                                    <i class="fa fa-search"></i></button>
                                                            </span>
                                                        </div>
                                                        <span class="help-block" style="text-transform: none;">
                                                        <sub id="count_lampiran"></sub>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <button type="reset" class="btn btn-link btn-sm"
                                                                style="border: 1px solid #ccc">
                                                            <i class="fa fa-undo mr-2"></i>BATAL
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-read-more">
                                            <button class="btn btn-link btn-block">
                                                <i class="fa fa-tools"></i>&nbsp;SIMPAN PERUBAHAN
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="pengerjaan" aria-labelledby="pengerjaan-tab"
                                 style="border: none">
                                <div class="table-responsive" id="dt-pengerjaan">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Detail</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $no = 1; @endphp
                                        @foreach($pengerjaan as $row)
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
                                            <tr>
                                                <td style="vertical-align: middle" align="center">{{$no++}}</td>
                                                <td style="vertical-align: middle">
                                                    <div class="row mb-1" style="border-bottom: 1px solid #eee;">
                                                        <div class="col-lg-12">
                                                            <a href="{{route('detail.proyek', ['username' => $user->username,
                                                            'judul' => $row->get_project->permalink])}}">
                                                                <img class="img-responsive float-left mr-2"
                                                                     alt="Thumbnail" width="80"
                                                                     src="{{$row->get_project->thumbnail != "" ?
                                                                     asset('storage/proyek/thumbnail/'.$row->get_project->thumbnail)
                                                                     : asset('images/slider/beranda-proyek.jpg')}}">
                                                                @if(!is_null($row->get_project->get_pembayaran))
                                                                    @if(!is_null($row->get_project->get_pembayaran->bukti_pembayaran))
                                                                        @if($row->get_project->get_pembayaran->jumlah_pembayaran == $row->get_project->harga)
                                                                            <span
                                                                                class="label label-success">LUNAS</span>
                                                                        @else
                                                                            <span class="label label-default">DP {{round($row
                                                                            ->get_pembayaran->jumlah_pembayaran / $row
                                                                            ->get_project->harga * 100,1)}}%</span>
                                                                        @endif |
                                                                        <span class="label label-{{$row->selesai == false ?
                                                                        'warning' : 'success'}}">{{$row->selesai == false ?
                                                                        'PROSES PENGERJAAN' : 'SELESAI'}}</span>
                                                                    @else
                                                                        <span class="label label-default">MENUNGGU KONFIRMASI</span>
                                                                    @endif
                                                                @else
                                                                    <span
                                                                        class="label label-danger">MENUNGGU PEMBAYARAN</span>
                                                                @endif
                                                                <br><b>{{$row->get_project->judul}}</b>
                                                            </a>
                                                            <p>Rp{{number_format($row->get_project->harga,2,',','.')}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1" style="border-bottom: 1px solid #eee">
                                                        <div class="col-lg-12">
                                                            <b>PEKERJA</b><br>
                                                            <div class="media">
                                                                <div class="media-left media-middle">
                                                                    <a href="{{route('profil.user', ['username' => $pekerja->username])}}">
                                                                        <img width="48" alt=""
                                                                             class="media-object img-thumbnail"
                                                                             src="{{$pekerja->get_bio->foto == "" ?
                                                                 asset('images/faces/thumbs50x50/'.rand(1,6).'.jpg') :
                                                                 asset('storage/users/foto/'.$pekerja->get_bio->foto)}}"
                                                                             style="border-radius: 100%">
                                                                    </a>
                                                                </div>
                                                                <div class="media-body">
                                                                    <p class="media-heading">
                                                                        <i class="fa fa-hard-hat mr-2"
                                                                           style="color: #4d4d4d"></i>
                                                                        <a href="{{route('profil.user', ['username' => $pekerja->username])}}">
                                                                            {{$pekerja->name}}</a>
                                                                        <i class="fa fa-star"
                                                                           style="color: #ffc100;margin: 0 0 0 .5rem"></i>
                                                                        <b>{{round($rating_pekerja * 2) / 2}}</b>
                                                                    </p>
                                                                    <blockquote>
                                                                        {!! !is_null($pekerja->get_bio->summary) ? $pekerja->get_bio->summary :
                                                                        $pekerja->name.' belum menuliskan apapun di profilnya.' !!}
                                                                    </blockquote>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1" style="border-bottom: 1px solid #eee">
                                                        <div class="col-lg-12">
                                                            <ul class="none-margin">
                                                                <li><b>HASIL PENGERJAAN</b></li>
                                                                <li style="list-style: none">
                                                                    @if($row->file_hasil != "")
                                                                        <div class="row use-lightgallery">
                                                                            @foreach($row->file_hasil as $file)
                                                                                <div class="col-md-3 item"
                                                                                     data-src="{{asset('storage/proyek/hasil/'.$file)}}"
                                                                                     data-sub-html="<h4>{{$row->get_project->judul}}</h4><p>{{$file}}</p>">
                                                                                    <div class="content-area">
                                                                                        <img alt="File hasil"
                                                                                             src="{{asset('storage/proyek/hasil/'.$file)}}"
                                                                                             class="img-responsive">
                                                                                        <div class="custom-overlay">
                                                                                            <div class="custom-text">
                                                                                                <b>{{$file}}</b>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        (kosong)
                                                                    @endif
                                                                </li>
                                                                <li><b>TAUTAN</b></li>
                                                                <li style="list-style: none">
                                                                    @if($row->tautan != "")
                                                                        <a href="{{$row->tautan}}"
                                                                           target="_blank">{{$row->tautan}}</a>
                                                                    @else
                                                                        (kosong)
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1" style="border-bottom: 1px solid #eee">
                                                        <div class="col-lg-12">
                                                            <b>ULASAN ANDA</b><br>
                                                            @if(!is_null($row->get_ulasan_pekerja))
                                                                <div class="media">
                                                                    <div class="media-left media-middle">
                                                                        <a href="{{route('profil.user', ['username' => $user->username])}}">
                                                                            <img width="48" alt="avatar" src="{{$user->get_bio->foto == "" ?
                                                                        asset('images/faces/thumbs50x50/'.rand(1,6).'.jpg') :
                                                                        asset('storage/users/foto/'.$user->get_bio->foto)}}"
                                                                                 class="media-object img-thumbnail"
                                                                                 style="border-radius: 100%">
                                                                        </a>
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <p class="media-heading">
                                                                            <i class="fa fa-user-tie mr-2"
                                                                               style="color: #4d4d4d"></i>
                                                                            <a href="{{route('profil.user', ['username' => $user->username])}}">
                                                                                {{$user->name}}</a>
                                                                            <i class="fa fa-star"
                                                                               style="color: #ffc100;margin: 0 0 0 .5rem"></i>
                                                                            <b>{{round($row->get_ulasan_pekerja->bintang * 2) / 2}}</b>
                                                                            <span class="pull-right"
                                                                                  style="color: #999">
                                                                                <i class="fa fa-clock"
                                                                                   style="color: #aaa;margin: 0"></i>
                                                                                {{$row->get_ulasan_pekerja->created_at->diffForHumans()}}
                                                                            </span>
                                                                        </p>
                                                                        <blockquote>
                                                                            {!! $row->get_ulasan_pekerja->deskripsi !!}
                                                                        </blockquote>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                (kosong)
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <b>ULASAN PEKERJA</b><br>
                                                            <div class="media">
                                                                <div class="media-left media-middle">
                                                                    <a href="{{route('profil.user', ['username' => $row->get_user->username])}}">
                                                                        <img width="48" alt="avatar" src="{{$row->get_user->get_bio->foto == "" ?
                                                                            asset('images/faces/thumbs50x50/'.rand(1,6).'.jpg') :
                                                                            asset('storage/users/foto/'.$row->get_user->get_bio->foto)}}"
                                                                             class="media-object img-thumbnail"
                                                                             style="border-radius: 100%">
                                                                    </a>
                                                                </div>
                                                                <div class="media-body">
                                                                    <p class="media-heading">
                                                                        <i class="fa fa-hard-hat mr-2"
                                                                           style="color: #4d4d4d"></i>
                                                                        <a href="{{route('profil.user', ['username' => $row->get_user->username])}}">
                                                                            {{$row->get_user->name}}</a>
                                                                        @if(!is_null($row->get_project->get_ulasan))
                                                                            <i class="fa fa-star"
                                                                               style="color: #ffc100;margin: 0 0 0 .5rem"></i>
                                                                            <b>{{round($row->get_project->get_ulasan->bintang * 2) / 2}}</b>
                                                                            <span class="pull-right"
                                                                                  style="color: #999">
                                                                                <i class="fa fa-clock"
                                                                                   style="color: #aaa;margin: 0"></i>
                                                                                {{$row->get_project->get_ulasan->created_at->diffForHumans()}}
                                                                            </span>
                                                                        @endif
                                                                    </p>
                                                                    <blockquote>
                                                                        {!! !is_null($row->get_project->get_ulasan) ? $row->get_project->get_ulasan->deskripsi : '(kosong)' !!}
                                                                    </blockquote>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle" align="center">
                                                    <a class="btn btn-link btn-sm btn-block" title="Lihat Proyek"
                                                       data-toggle="tooltip" href="{{route('detail.proyek',
                                                               ['username' => $user->username,
                                                               'judul' => $row->get_project->permalink])}}">
                                                        <i class="fa fa-info-circle" style="margin-right: 0"></i></a>
                                                    <hr style="margin: .5em 0">
                                                    @if(!is_null($row->get_project->get_pembayaran))
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                @if($row->get_project->get_pembayaran->dp == false)
                                                                    <button class="btn btn-link btn-sm" type="button"
                                                                            data-toggle="tooltip" title="Bayar Sekarang"
                                                                            disabled>
                                                                        <i class="fa fa-wallet"
                                                                           style="margin-right: 0"></i>
                                                                    </button>
                                                                @else
                                                                    <button class="btn btn-link btn-sm" type="button"
                                                                            data-toggle="tooltip" title="Bayar Sekarang"
                                                                            onclick="bayarSekarang('{{$row->id}}','{{$row->get_project->judul}}',
                                                                                '{{route('klien.update-pembayaran.proyek',['id' => $row->id])}}',
                                                                                '{{$row->get_project->harga}}',
                                                                                '{{$row->get_project->get_pembayaran->jumlah_pembayaran}}')">
                                                                        <i class="fa fa-wallet"
                                                                           style="margin-right: 0"></i>
                                                                    </button>
                                                                @endif
                                                                <button class="btn btn-link btn-sm" type="button"
                                                                        data-toggle="tooltip" title="Bukti Pembayaran"
                                                                        onclick="buktiPembayaran('{{$row->id}}','#INV/{{\Carbon\Carbon::parse($row->get_project->get_pembayaran->created_at)->format('Ymd').'/'.$row->get_project->get_pembayaran->id}}',
                                                                            '{{route('klien.update-pembayaran.proyek',['id' => $row->id])}}',
                                                                            '{{route('klien.data-pembayaran.proyek',['id' => $row->get_project->get_pembayaran->id])}}',
                                                                            '{{$row->get_project->harga}}',0)">
                                                                    <i class="fa fa-upload" style="margin-right: 0"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    @else
                                                        <button class="btn btn-link btn-sm btn-block" type="button"
                                                                data-toggle="tooltip" title="Bayar Sekarang"
                                                                onclick="bayarSekarang('{{$row->id}}','{{$row->get_project->judul}}',
                                                                    '{{route('klien.update-pembayaran.proyek',['id' => $row->id])}}',
                                                                    '{{$row->get_project->harga}}')">
                                                            <i class="fa fa-wallet" style="margin-right: 0"></i>
                                                        </button>
                                                    @endif
                                                    <hr style="margin: .5em 0">
                                                    <button class="btn btn-link btn-sm btn-block" data-toggle="tooltip"
                                                            title="Ulas Hasil" onclick="ulasHasil('{{$row->id}}',
                                                        '{{route('klien.ulas-pengerjaan.proyek', ['id' => $row->id])}}',
                                                        '{{route('klien.data-ulasan.proyek', ['id' => $row->id])}}',
                                                        '{{$row->get_project->judul}}','{{$row->selesai}}')"
                                                        {{is_null($row->get_project->get_pembayaran) || (!is_null($row->get_project->get_pembayaran) &&
                                                        $row->get_project->get_pembayaran->jumlah_pembayaran != $row->get_project->harga) ||
                                                        (is_null($row->file_hasil) && is_null($row->tautan)) || $row->selesai == true ? 'disabled' : ''}}>
                                                        <i class="fa fa-edit" style="margin-right: 0"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div id="bayar-sekarang" style="display: none">
                                    <div class="card">
                                        <form id="pay-form" class="form-horizontal" role="form" method="POST">
                                            @csrf
                                            {{method_field('put')}}
                                            <input type="hidden" name="id">
                                            <input type="hidden" name="rekening">
                                            <div class="card-content">
                                                <div class="card-title">
                                                    <small id="judul-bayar"></small>
                                                    <hr class="mt-0">
                                                    <div class="row form-group">
                                                        <div class="col-md-12">
                                                            <label for="dp" class="control-label">
                                                                Jenis Pembayaran <span class="required">*</span></label>
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline"
                                                                id="dp"
                                                                style="padding-left: 3rem">
                                                                <input type="radio" class="custom-control-input"
                                                                       id="jp-1"
                                                                       name="dp" value="1"
                                                                       onchange="jenisPembayaran('dp')"
                                                                       required>
                                                                <label class="custom-control-label" for="jp-1">
                                                                    DP (minimal <b>30%</b>)</label>
                                                            </div>
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline"
                                                                style="padding-left: 1.5rem">
                                                                <input type="radio" class="custom-control-input"
                                                                       id="jp-2"
                                                                       name="dp" value="0"
                                                                       onchange="jenisPembayaran('fp')"
                                                                       required>
                                                                <label class="custom-control-label"
                                                                       for="jp-2">LUNAS</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-md-5">
                                                            <label for="harga2" class="form-control-label">
                                                                Harga/Budget Proyek</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><b>Rp</b></span>
                                                                <input id="harga2" class="form-control rupiah"
                                                                       type="text" readonly>
                                                                <span class="input-group-addon">
                                                        <i class="fa fa-money-bill-wave-alt"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <label class="form-control-label" for="jumlah_pembayaran">
                                                                Jumlah Pembayaran <span
                                                                    class="required">*</span></label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><b>Rp</b></span>
                                                                <input id="jumlah_pembayaran"
                                                                       class="form-control rupiah" readonly
                                                                       name="jumlah_pembayaran" type="text"
                                                                       placeholder="0">
                                                                <span class="input-group-addon">
                                                        <i class="fa fa-money-bill-wave-alt"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="payment_methods" class="control-label">
                                                                Metode Pembayaran <span
                                                                    class="required">*</span></label>
                                                            <div class="pm-selector">
                                                                <input class="pm-radioButton" id="pm-bca" type="radio"
                                                                       name="metode_pembayaran" value="bca">
                                                                <label class="pm-label" for="pm-bca"
                                                                       onclick="paymentMethod('{{\Faker\Factory::create()->bankAccountNumber}}')"
                                                                       style="background-image: url({{asset('images/payment/bca.png')}});"></label>

                                                                <input class="pm-radioButton" id="pm-bni" type="radio"
                                                                       name="metode_pembayaran" value="bni">
                                                                <label class="pm-label" for="pm-bni"
                                                                       onclick="paymentMethod('{{\Faker\Factory::create()->bankAccountNumber}}')"
                                                                       style="background-image: url({{asset('images/payment/bni.png')}});"></label>

                                                                <input class="pm-radioButton" id="pm-bri" type="radio"
                                                                       name="metode_pembayaran" value="bri">
                                                                <label class="pm-label" for="pm-bri"
                                                                       onclick="paymentMethod('{{\Faker\Factory::create()->bankAccountNumber}}')"
                                                                       style="background-image: url({{asset('images/payment/bri.png')}});"></label>

                                                                <input class="pm-radioButton" id="pm-btn" type="radio"
                                                                       name="metode_pembayaran" value="btn">
                                                                <label class="pm-label" for="pm-btn"
                                                                       onclick="paymentMethod('{{\Faker\Factory::create()->bankAccountNumber}}')"
                                                                       style="background-image: url({{asset('images/payment/btn.png')}});"></label>

                                                                <input class="pm-radioButton" id="pm-mandiri"
                                                                       type="radio"
                                                                       name="metode_pembayaran" value="mandiri">
                                                                <label class="pm-label" for="pm-mandiri"
                                                                       onclick="paymentMethod('{{\Faker\Factory::create()->bankAccountNumber}}')"
                                                                       style="background-image: url({{asset('images/payment/mandiri.png')}});"></label>
                                                            </div>
                                                            <div id="pm-details"
                                                                 class="alert alert-warning text-justify"
                                                                 style="font-size: 14px;text-transform:none;display:none"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-lg-12">
                                                            <button type="reset" class="btn btn-link btn-sm"
                                                                    style="border: 1px solid #ccc">
                                                                <i class="fa fa-undo mr-2"></i>BATAL
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-read-more">
                                                <button class="btn btn-link btn-block">
                                                    <i class="fa fa-wallet"></i>&nbsp;BAYAR SEKARANG
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="bukti-pembayaran" style="display: none">
                                    <div class="card">
                                        <form id="upload-form" class="form-horizontal" role="form" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            {{method_field('put')}}
                                            <div class="card-content">
                                                <div class="card-title">
                                                    <small id="invoice"></small>
                                                    <hr class="mt-0">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="uploader">
                                                                <input id="file-upload" type="file"
                                                                       name="bukti_pembayaran"
                                                                       accept="image/*">
                                                                <label for="file-upload" id="file-drag">
                                                                    <img id="file-image" src="#" alt="Bukti Pembayaran"
                                                                         class="hidden img-responsive">
                                                                    <div id="start"><i class="fa fa-download"
                                                                                       aria-hidden="true"></i>
                                                                        <div>Pilih file bukti pembayaran Anda atau seret
                                                                            filenya
                                                                            kesini
                                                                        </div>
                                                                        <div id="notimage" class="hidden">Mohon untuk
                                                                            memilih file
                                                                            gambar
                                                                        </div>
                                                                        <span id="file-upload-btn"
                                                                              class="btn btn-link btn-sm">Pilih File</span>
                                                                    </div>
                                                                    <div id="response" class="hidden">
                                                                        <div id="messages"></div>
                                                                    </div>
                                                                    <div id="progress-upload">
                                                                        <div
                                                                            class="progress-bar progress-bar-info progress-bar-striped progress-bar-animated active"
                                                                            role="progressbar" aria-valuenow="0"
                                                                            aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-read-more">
                                                <button type="reset" class="btn btn-link btn-block">
                                                    <i class="fa fa-undo mr-2"></i>BATAL
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="ulas-hasil" style="display: none">
                                    <div class="card">
                                        <form class="form-horizontal" role="form" method="POST">
                                            @csrf
                                            <div class="card-content">
                                                <div class="card-title">
                                                    <small id="judul"></small>
                                                    <hr class="mt-0">
                                                    <div class="row form-group">
                                                        <div class="col-md-8">
                                                            <fieldset id="rating" class="rating" aria-required="true">
                                                                <label class="full" for="star5" data-toggle="tooltip"
                                                                       title="Terbaik"></label>
                                                                <input type="radio" id="star5" name="rating" value="5"
                                                                       required>

                                                                <label class="half" for="star4half"
                                                                       data-toggle="tooltip"
                                                                       title="Keren"></label>
                                                                <input type="radio" id="star4half" name="rating"
                                                                       value="4.5">

                                                                <label class="full" for="star4" data-toggle="tooltip"
                                                                       title="Cukup baik"></label>
                                                                <input type="radio" id="star4" name="rating" value="4">

                                                                <label class="half" for="star3half"
                                                                       data-toggle="tooltip"
                                                                       title="Baik"></label>
                                                                <input type="radio" id="star3half" name="rating"
                                                                       value="3.5">

                                                                <label class="full" for="star3" data-toggle="tooltip"
                                                                       title="Standar"></label>
                                                                <input type="radio" id="star3" name="rating" value="3">

                                                                <label class="half" for="star2half"
                                                                       data-toggle="tooltip"
                                                                       title="Cukup buruk"></label>
                                                                <input type="radio" id="star2half" name="rating"
                                                                       value="2.5">

                                                                <label class="full" for="star2" data-toggle="tooltip"
                                                                       title="Buruk"></label>
                                                                <input type="radio" id="star2" name="rating" value="2">

                                                                <label class="half" for="star1half"
                                                                       data-toggle="tooltip"
                                                                       title="Sangat buruk"></label>
                                                                <input type="radio" id="star1half" name="rating"
                                                                       value="1.5">

                                                                <label class="full" for="star1" data-toggle="tooltip"
                                                                       title="Menyedihkan"></label>
                                                                <input type="radio" id="star1" name="rating" value="1">

                                                                <label class="half" for="starhalf" data-toggle="tooltip"
                                                                       title="Sangat menyedihkan"></label>
                                                                <input type="radio" id="starhalf" name="rating"
                                                                       value="0.5">
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-md-4 text-right">
                                                            <div class="custom-checkbox custom-control">
                                                                <input id="cb-selesai" type="checkbox"
                                                                       class="custom-control-input"
                                                                       name="selesai" value="1">
                                                                <label for="cb-selesai" class="custom-control-label"
                                                                       style="text-transform: none;">saya sudah puas
                                                                    dengan hasilnya
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-md-12">
                                                            <textarea id="deskripsi2" name="deskripsi"
                                                                      class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-lg-12">
                                                            <button type="reset" class="btn btn-link btn-sm"
                                                                    style="border: 1px solid #ccc">
                                                                <i class="fa fa-undo mr-2"></i>BATAL
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-read-more">
                                                <button class="btn btn-link btn-block">
                                                    <i class="fa fa-edit"></i>&nbsp;SIMPAN PERUBAHAN
                                                </button>
                                            </div>
                                        </form>
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
    <script src="{{asset('admins/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('admins/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('admins/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <script src="{{asset('admins/modules/datatables/Buttons-1.5.6/js/buttons.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/masonry/masonry.pkgd.min.js')}}"></script>
    <script src="{{asset('vendor/lightgallery/lib/picturefill.min.js')}}"></script>
    <script src="{{asset('vendor/lightgallery/dist/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('vendor/lightgallery/modules/lg-video.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>
    <script>
        $(function () {
            var export_proyek = 'Daftar Tugas/Proyek ({{now()->format('j F Y')}})',
                export_pengerjaan = 'Daftar Pengerjaan Tugas/Proyek ({{now()->format('j F Y')}})';

            $("#dt-proyek table").DataTable({
                dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-5'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                columnDefs: [{"sortable": false, "targets": 5}],
                language: {
                    "emptyTable": "Anda belum menambahkan tugas/proyek apapun",
                    "info": "Menampilkan _START_ to _END_ of _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 entri",
                    "infoFiltered": "(difilter dari _MAX_ total entri)",
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "loadingRecords": "Memuat...",
                    "processing": "Mengolah...",
                    "search": "Cari:",
                    "zeroRecords": "Data yang Anda cari tidak ditemukan.",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "aria": {
                        "sortAscending": ": aktifkan untuk mengurutkan kolom dari kecil ke besar (asc)",
                        "sortDescending": ": aktifkan untuk mengurutkan kolom dari besar ke kecil (desc)"
                    }
                },
                buttons: [
                    {
                        text: '<b class="text-uppercase"><i class="far fa-file-excel mr-2"></i>Excel</b>',
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        },
                        className: 'btn btn-link btn-sm assets-export-btn export-xls ttip',
                        title: export_proyek,
                        extension: '.xls'
                    }, {
                        text: '<b class="text-uppercase"><i class="fa fa-print mr-2"></i>Cetak</b>',
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        },
                        className: 'btn btn-link btn-sm assets-select-btn export-print'
                    }, {
                        text: '<b class="text-uppercase"><i class="fa fa-tools mr-2"></i>Tambah</b>',
                        className: 'btn btn-link btn-sm btn-tambah'
                    }
                ],
                fnDrawCallback: function (oSettings) {
                    $('.use-nicescroll').getNiceScroll().resize();
                    $('[data-toggle="tooltip"]').tooltip();

                    $(".btn-tambah").on('click', function () {
                        $("#form-proyek .card-title small").text('Tambah Tugas/Proyek Baru');
                        $("#subkategori_id").val(null).trigger('change');
                        $("#form-proyek input[name=_method], #form-proyek input[name=id], #judul2, #attach-thumbnail, #txt_thumbnail, #waktu_pengerjaan, #harga").val(null);
                        $("#deskripsi").summernote('code', null);
                        $("#txt_thumbnail[data-toggle=tooltip]").attr('data-original-title', 'Ekstensi yang diizinkan: jpg, jpeg, gif, png. Ukuran yang diizinkan: < 2 MB');

                        $("#div-thumbnail").removeClass('col-md-12').addClass('col-md-5');
                        $("#div-lampiran").show();
                        $("#dt-proyek").hide();
                        $("#form-proyek").show().attr('action', '{{route('klien.tambah.proyek')}}');
                    });
                },
            });

            $("#dt-pengerjaan table").DataTable({
                dom: "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-5'B><'col-sm-12 col-md-4'f>>" +
                    "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                columnDefs: [{"sortable": false, "targets": 2}],
                language: {
                    "emptyTable": "Anda belum memiliki daftar pengerjaan tugas/proyek apapun",
                    "info": "Menampilkan _START_ to _END_ of _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 entri",
                    "infoFiltered": "(difilter dari _MAX_ total entri)",
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "loadingRecords": "Memuat...",
                    "processing": "Mengolah...",
                    "search": "Cari:",
                    "zeroRecords": "Data yang Anda cari tidak ditemukan.",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                    "aria": {
                        "sortAscending": ": aktifkan untuk mengurutkan kolom dari kecil ke besar (asc)",
                        "sortDescending": ": aktifkan untuk mengurutkan kolom dari besar ke kecil (desc)"
                    }
                },
                buttons: [
                    {
                        text: '<b class="text-uppercase"><i class="far fa-file-excel mr-2"></i>Excel</b>',
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1]
                        },
                        className: 'btn btn-link btn-sm assets-export-btn export-xls ttip',
                        title: export_pengerjaan,
                        extension: '.xls'
                    }, {
                        text: '<b class="text-uppercase"><i class="fa fa-file-pdf mr-2"></i>PDF</b>',
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1]
                        },
                        className: 'btn btn-link btn-sm assets-select-btn export-pdf',
                        title: export_pengerjaan,
                        extension: '.pdf'
                    }, {
                        text: '<b class="text-uppercase"><i class="fa fa-print mr-2"></i>Cetak</b>',
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1]
                        },
                        className: 'btn btn-link btn-sm assets-select-btn export-print'
                    }
                ],
                fnDrawCallback: function (oSettings) {
                    $('.use-nicescroll').getNiceScroll().resize();
                    $('[data-toggle="tooltip"]').tooltip();

                    var file_hasil = $(".use-lightgallery");
                    file_hasil.masonry({
                        itemSelector: '.item'
                    });
                    file_hasil.lightGallery({
                        selector: '.item',
                        loadYoutubeThumbnail: true,
                        youtubeThumbSize: 'default',
                    });
                },
            });

            $("#deskripsi").summernote({
                placeholder: 'Tulis deskripsi tugas/proyek Anda disini...',
                tabsize: 2,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $("#deskripsi2").summernote({
                placeholder: 'Tulis ulasan Anda disini...',
                tabsize: 2,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            @if(session('pengerjaan'))
            swal('Sukses!', '{{ session('pengerjaan') }}', 'success');
            $("#pengerjaan-tab").click();
            @elseif(session('bid'))
            swal('Sukses!', '{{ session('bid') }}', 'success');
            $("#pengerjaan-tab").click();
            bayarSekarang('{{$req_id}}', '{{$req_judul}}',
                '{{route('klien.update-pembayaran.proyek',['id' => $req_id])}}', '{{$req_harga}}');
            @endif

            @if(!is_null($req_id) && !is_null($req_invoice) && !is_null($req_url) && !is_null($req_data_url) && !is_null($req_harga))
            buktiPembayaran('{{$req_id}}', '{{$req_invoice}}', '{{$req_url}}', '{{$req_data_url}}', '{{$req_harga}}');
            @endif
        });

        function suntingProyek(data_url) {
            $.get(data_url, function (data) {
                $("#form-proyek .card-title small").html('Sunting Tugas/Proyek #<b>' + data.judul + '</b>');
                $("#form-proyek input[name=_method]").val('PUT');
                $("#form-proyek input[name=id]").val(data.id);
                $("#subkategori_id").val(data.subkategori_id).trigger('change');
                $("#judul2").val(data.judul);
                $("#txt_thumbnail").val(data.thumbnail);
                $("#waktu_pengerjaan").val(data.waktu_pengerjaan);
                $("#harga").val(data.harga);
                $("#deskripsi").summernote('code', data.deskripsi);

                $("#div-thumbnail").addClass('col-md-12').removeClass('col-md-5');
                $("#div-lampiran").hide();
                $("#dt-proyek").toggle(300);
                $("#form-proyek").toggle(300).attr('action', '{{route('klien.update.proyek')}}');

                $('html,body').animate({scrollTop: $(".none-margin").offset().top}, 500);
            });
        }

        $("#form-proyek button[type=reset]").on('click', function () {
            $("#form-proyek .card-title small").text(null);
            $("#subkategori_id").val(null).trigger('change');
            $("#form-proyek input[name=_method], #form-proyek input[name=id], #judul2, #attach-thumbnail, #txt_thumbnail, #waktu_pengerjaan, #harga").val(null);
            $("#txt_thumbnail[data-toggle=tooltip]").attr('data-original-title', 'Ekstensi yang diizinkan: jpg, jpeg, gif, png. Ukuran yang diizinkan: < 2 MB');
            $("#deskripsi").summernote('code', null);
            $("#dt-proyek").toggle(300);
            $("#form-proyek").toggle(300).removeAttr('action');

            $('html,body').animate({scrollTop: $(".none-margin").offset().top}, 500);
        });

        $(".browse_thumbnail").on('click', function () {
            $("#attach-thumbnail").trigger('click');
        });

        $("#attach-thumbnail").on('change', function () {
            var thumbnail = $(this).prop("files"), names = $.map(thumbnail, function (val) {
                return val.name;
            });
            $("#txt_thumbnail").val(names);
            $("#txt_thumbnail[data-toggle=tooltip]").attr('data-original-title', names);
        });

        $(".browse_lampiran").on('click', function () {
            $("#attach-lampiran").trigger('click');
        });

        $("#attach-lampiran").on('change', function () {
            var lampiran = $(this).prop("files"), names = $.map(lampiran, function (val) {
                return val.name;
            });
            $("#txt_lampiran").val(names);
            $("#txt_lampiran[data-toggle=tooltip]").attr('data-original-title', names);
            $("#count_lampiran").text($(this).get(0).files.length + " file dipilih!");
        });

        $("#form-proyek").on('submit', function (e) {
            e.preventDefault();
            if ($('#deskripsi').summernote('isEmpty')) {
                swal('PERHATIAN!', 'Deskripsi tugas/proyek Anda tidak boleh kosong!', 'warning');
            } else {
                $(this)[0].submit();
            }
        });

        function hapusProyek(url, judul) {
            swal({
                title: 'Hapus Tugas/Proyek',
                text: 'Apakah Anda yakin akan menghapus tugas/proyek "' + judul + '"? Anda tidak dapat mengembalikannya!',
                icon: 'warning',
                dangerMode: true,
                buttons: ["Tidak", "Ya"],
                closeOnEsc: false,
                closeOnClickOutside: false,
            }).then((confirm) => {
                if (confirm) {
                    swal({icon: "success", buttons: false});
                    window.location.href = url;
                }
            });
        }

        <!-- pembayaran -->
        var amount = 0, amountToPay = 0, amount_30 = 0, sisa_pembayaran = 0;

        function bayarSekarang(id, judul, url, harga, jumlah_pembayaran) {
            $("#judul-bayar").text(judul);
            $("#dt-pengerjaan").toggle(300);
            $("#bayar-sekarang").toggle(300);
            $("#harga2").val(harga);

            amount = harga;
            amountToPay = harga;
            $("#pay-form input[name=id]").val(id);
            $("#bayar-sekarang form").attr('action', url);

            if (parseInt(jumlah_pembayaran) > 0) {
                sisa_pembayaran = parseInt(harga) - parseInt(jumlah_pembayaran);
                $("#jp-2").prop('checked', true).trigger('change');
            }
        }

        $("#bayar-sekarang button[type=reset]").on('click', function () {
            $("#judul-bayar").text(null);
            $("#dt-pengerjaan").toggle(300);
            $("#bayar-sekarang").toggle(300);
            $("#harga2").val(null);
            amount = 0;
            amountToPay = 0;
            amount_30 = 0;
            sisa_pembayaran = 0;
            $("#bayar-sekarang form").removeAttr('action');

            $('html,body').animate({scrollTop: $(".none-margin").offset().top}, 500);
        });

        function jenisPembayaran(jenis) {
            var x = parseInt(amountToPay), input = $("#jumlah_pembayaran");

            if (jenis == 'dp') {
                amountToPay = Math.ceil(x * .3);
                input.val(amountToPay).attr('required', 'required').removeAttr('readonly');
            } else {
                if (parseInt(sisa_pembayaran) > 0) {
                    $("#jp-1").attr('disabled', 'disabled').removeAttr('required');
                    $("label[for=jumlah_pembayaran]").html('Sisa Pembayaran <span class="required">*</span>');
                    input.val(sisa_pembayaran).removeAttr('required', 'required').attr('readonly', 'readonly');
                } else {
                    $("#jp-1").removeAttr('disabled').attr('required', 'required');
                    $("label[for=jumlah_pembayaran]").html('Jumlah Pembayaran <span class="required">*</span>');
                    amountToPay = amount;
                    input.val(amountToPay).removeAttr('required', 'required').attr('readonly', 'readonly');
                }
            }

            input.on('change', function () {
                var val = parseInt($(this).val().split('.').join(''));

                if (parseInt(sisa_pembayaran) > 0) {
                    input.val(sisa_pembayaran);
                } else {
                    if (val >= amount) {
                        $("#jp-2").prop('checked', true).trigger('change');
                    }

                    if (val < amountToPay) {
                        input.val(amountToPay);
                    }
                }
            });

            $(".pm-radioButton").prop("checked", false).trigger('change');
            $("#pm-details").hide();
        }

        function paymentMethod(rekening) {
            if ($("input[name=dp]").is(":checked")) {
                $("#pay-form input[name=rekening]").val(rekening);
                $("#pm-details").show().html(
                    'Jumlah yang harus Anda transfer ke nomor rekening <u>' + rekening + '</u> ' +
                    '(a/n <u>{{env('APP_NAME')}}</u>) adalah sebesar ' +
                    '<u>Rp' + thousandSeparator(parseInt($("#jumlah_pembayaran").val().split('.').join(''))) + ',00</u>.');
            } else {
                $(".pm-radioButton").prop("checked", false).trigger('change');
                $("#pm-details").hide();
                $("#pay-form button[type=submit]").click();
            }
        }

        $("#pay-form").on('submit', function (e) {
            e.preventDefault();
            if ($(".pm-radioButton").is(":checked")) {
                swal({
                    title: 'Apakah anda yakin?',
                    text: 'Kami akan mengirimkan rincian tagihan pembayaran melalui email ' +
                        'sesaat setelah Anda menekan tombol "Ya" berikut!',
                    icon: 'warning',
                    dangerMode: true,
                    closeOnEsc: false,
                    closeOnClickOutside: false,
                    buttons: {
                        cancel: "Tidak",
                        confirm: {
                            text: "Ya",
                            closeModal: false,
                        }
                    }
                }).then((confirm) => {
                    if (confirm) {
                        $(this)[0].submit();
                    }
                });

            } else {
                swal('PERHATIAN!', 'Anda belum memilih metode pembayaran!', 'warning');
            }
        });

        <!-- bukti pembayaran -->
        function buktiPembayaran(id, invoice, url, data_url, harga) {
            var bisa_upload = false;
            $.get(data_url, function (data) {
                $("#invoice").html('Bukti Pembayaran: <b>' + invoice + '</b>');
                $("#dt-pengerjaan").toggle(300);
                $("#bukti-pembayaran").toggle(300);

                if (data.bukti_pembayaran == null || data.bukti_pembayaran == "") {
                    $("#messages").html('');
                    $('#start').removeClass("hidden");
                    $('#response').addClass("hidden");
                    $('#notimage').removeClass("hidden");
                    $('#file-image').addClass("hidden").attr('src', '#');

                    bisa_upload = true;

                } else {
                    setImage(data.bukti_pembayaran);

                    if (parseInt(data.jumlah_pembayaran) == parseInt(harga)) {
                        bisa_upload = false;
                    } else {
                        bisa_upload = true;
                    }
                }

                ekUpload(id, url, bisa_upload);
            });
        }

        $("#bukti-pembayaran button[type=reset]").on('click', function () {
            $("#invoice").empty().html();
            $("#dt-pengerjaan").toggle(300);
            $("#bukti-pembayaran").toggle(300);

            setImage(null);

            $('html,body').animate({scrollTop: $(".none-margin").offset().top}, 500);
        });

        function ekUpload(id, url, bisa_upload) {
            function Init() {
                var fileSelect = document.getElementById('file-upload'),
                    fileDrag = document.getElementById('file-drag');

                fileSelect.addEventListener('change', fileSelectHandler, false);

                var xhr = new XMLHttpRequest();
                if (xhr.upload) {
                    fileDrag.addEventListener('dragover', fileDragHover, false);
                    fileDrag.addEventListener('dragleave', fileDragHover, false);
                    fileDrag.addEventListener('drop', fileSelectHandler, false);
                }
            }

            function fileDragHover(e) {
                var fileDrag = document.getElementById('file-drag');

                e.stopPropagation();
                e.preventDefault();

                fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
            }

            function fileSelectHandler(e) {
                var files = e.target.files || e.dataTransfer.files;
                $("#file-upload").prop("files", files);

                fileDragHover(e);

                for (var i = 0, f; f = files[i]; i++) {
                    uploadPaymentProof(f);
                }
            }

            function uploadPaymentProof(file) {
                var files_size = file.size, max_file_size = 2000000, file_name = file.name,
                    allowed_file_types = (/\.(?=gif|jpg|png|jpeg)/gi).test(file_name);

                if (bisa_upload == false) {
                    swal('PERHATIAN!', "Pesanan Anda telah lunas! Mohon untuk tidak mengubah bukti pembayarannya, terimakasih.", 'warning');

                } else {
                    if (!window.File && window.FileReader && window.FileList && window.Blob) {
                        swal('PERHATIAN!', "Browser yang Anda gunakan tidak support! Silahkan perbarui atau gunakan browser yang lainnya.", 'warning');

                    } else {
                        if (files_size > max_file_size) {
                            swal('ERROR!', "Ukuran total " + file_name + " adalah " + humanFileSize(files_size) +
                                ", ukuran file yang diperbolehkan adalah " + humanFileSize(max_file_size) +
                                ", coba unggah file yang ukurannya lebih kecil!", 'error');

                            $("#messages-" + id).html('Silahkan unggah file dengan ukuran yang lebih kecil (< ' + humanFileSize(max_file_size) + ').');
                            document.getElementById('file-image').classList.add("hidden");
                            document.getElementById('start').classList.remove("hidden");
                            document.getElementById("upload-form").reset();

                        } else {
                            if (!allowed_file_types) {
                                swal('ERROR!', "Tipe file " + file_name + " tidak support!", 'error');

                                document.getElementById('file-image').classList.add("hidden");
                                document.getElementById('notimage').classList.remove("hidden");
                                document.getElementById('start').classList.remove("hidden");
                                document.getElementById('response').classList.add("hidden");
                                document.getElementById("upload-form").reset();

                            } else {
                                $.ajax({
                                    type: 'POST',
                                    url: url,
                                    data: new FormData($("#upload-form")[0]),
                                    contentType: false,
                                    processData: false,
                                    mimeType: "multipart/form-data",
                                    xhr: function () {
                                        var xhr = $.ajaxSettings.xhr(),
                                            progress_bar_id = $("#progress-upload .progress-bar");
                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function (event) {
                                                var percent = 0;
                                                var position = event.loaded || event.position;
                                                var total = event.total;
                                                if (event.lengthComputable) {
                                                    percent = Math.ceil(position / total * 100);
                                                }
                                                progress_bar_id.css("display", "block");
                                                progress_bar_id.css("width", +percent + "%");
                                                progress_bar_id.text(percent + "%");
                                                if (percent == 100) {
                                                    progress_bar_id.removeClass("progress-bar-info");
                                                    progress_bar_id.addClass("progress-bar");
                                                } else {
                                                    progress_bar_id.removeClass("progress-bar");
                                                    progress_bar_id.addClass("progress-bar-info");
                                                }
                                            }, true);
                                        }
                                        return xhr;
                                    },
                                    success: function (data) {
                                        swal('Sukses!', 'Bukti pembayaran berhasil diunggah!', 'success');
                                        setImage(data);
                                        $("#progress-upload").css("display", "none");
                                    },
                                    error: function () {
                                        swal('Oops...', 'Terjadi suatu kesalahan!', 'error')
                                    }
                                });
                                return false;
                            }
                        }
                    }
                }
            }

            if (window.File && window.FileList && window.FileReader) {
                Init();
            } else {
                document.getElementById('file-drag').style.display = 'none';
            }
        }

        function setImage(image) {
            if (image != "") {
                $("#messages").html('<strong>' + image + '</strong>');
                $('#start').addClass("hidden");
                $('#response').removeClass("hidden");
                $('#notimage').addClass("hidden");
                $('#file-image').removeClass("hidden").attr('src', '{{asset('storage/users/pembayaran/layanan')}}/' + image);
            }
        }

        function humanFileSize(size) {
            var i = Math.floor(Math.log(size) / Math.log(1024));
            return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
        }

        <!-- ulasan -->
        function ulasHasil(id, action, data_url, judul, selesai) {
            $.get(data_url, function (data) {
                $("#judul").text(judul);
                if (selesai == 1) {
                    $("#cb-selesai").prop('checked', true);
                } else {
                    $("#cb-selesai").prop('checked', false);
                }
                $("#rating input[type=radio]").filter('[value="' + data.bintang + '"]').attr('checked', 'checked');
                $("#deskripsi2").summernote('code', data.deskripsi);
                $("#dt-pengerjaan").toggle(300);
                $("#ulas-hasil").toggle(300);
                $("#ulas-hasil form").attr('action', action);
            });
        }

        $("#ulas-hasil button[type=reset]").on('click', function () {
            $("#judul").text(null);
            $("#rating input[type=radio]").removeAttr('checked');
            $("#deskripsi2").summernote('code', null);
            $("#dt-pengerjaan").toggle(300);
            $("#ulas-hasil").toggle(300);
            $("#ulas-hasil form").removeAttr('action');

            $('html,body').animate({scrollTop: $(".none-margin").offset().top}, 500);
        });

        $("#ulas-hasil form").on('submit', function (e) {
            e.preventDefault();
            if ($('#deskripsi2').summernote('isEmpty')) {
                swal('PERHATIAN!', 'Deskripsi ulasan Anda tidak boleh kosong!', 'warning');
            } else {
                $(this)[0].submit();
            }
        });

        $("#proyek-tab, #pengerjaan-tab").on('shown.bs.tab', function () {
            var file_hasil = $(".use-lightgallery");
            file_hasil.masonry({
                itemSelector: '.item'
            });
            file_hasil.lightGallery({
                selector: '.item',
                loadYoutubeThumbnail: true,
                youtubeThumbSize: 'default',
            });
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
