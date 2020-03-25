@extends('layouts.mst_admin')
@section('title', 'Admin '.env('APP_NAME').': Kelola Data Pembayaran Service | '.env('APP_TITLE'))

@push('styles')
    <style></style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelola Data Pembayaran Layanan</h1>
        </div>

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Pembayaran Layanan</h4>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped" id="dt-service">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Nama Layanan</th>
                                    <th>Pemilik</th>
                                    <th>Pembeli</th>
                                    <th>Status Pengerjaan</th>
                                    <th>Status Pembayaran</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($service as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{$item->get_pengerjaan_layanan->get_service->judul}}</td>
                                        <td>{{$item->get_pengerjaan_layanan->get_service->get_user->name}}</td>
                                        <td>{{$item->get_pengerjaan_layanan->get_user->name}}</td>
                                        <td>@if($item->get_pengerjaan_layanan->selesai == 1)
                                                <div class="badge badge-success" data-toggle="tooltip"
                                                     title="Pengerjaan Layanan Telah Selesai"><i
                                                        class="fa fa-check-circle"></i></div>
                                            @else
                                                <div class="badge badge-danger" data-toggle="tooltip"
                                                     title="Pengerjaan Layanan Belum Selesai"><i
                                                        class="fa fa-times-circle"></i></div>
                                            @endif</td>
                                        <td>
                                            @if($item->jumlah_pembayaran < $item->get_pengerjaan_layanan->get_service->harga)
                                                {{--                                                belum lunas--}}
                                                <div class="badge badge-danger">Belum Lunas</div>
                                            @else
                                                <div class="badge badge-info">Lunas</div>
                                            @endif
                                            @if($item->selesai == 0)
                                                <div class="badge badge-warning">Belum Dibayarkan</div>
                                            @else
                                                <div class="badge badge-primary">Telah Dibayarkan</div>
                                            @endif
                                        </td>
                                        <td>{{$item->updated_at->diffForHumans()}}</td>
                                        <th>
                                            @if($item->jumlah_pembayaran < $item->get_pengerjaan_layanan->get_service->harga)
                                                {{--                                                belum lunas--}}
                                                <button class="btn btn-warning btn-icon" data-toggle="tooltip"
                                                        title="Pembayaran Belum Selesai"
                                                        onclick=""><i
                                                        class="fa fa-info-circle"></i></button>
                                            @else
                                                @if($item->selesai == 0)
                                                    <button class="btn btn-primary btn-icon" data-toggle="tooltip"
                                                            title="Konfimasi Pengelesaian Layanan"
                                                            onclick="action_modal('{{$item->get_pengerjaan_layanan->get_service->get_user->get_bio->rekening}}',
                                                                '{{$item->get_pengerjaan_layanan->get_user->get_bio->bank}}',
                                                                '{{$item->get_pengerjaan_layanan->get_user->get_bio->an}}',
                                                                '{{number_format($item->get_pengerjaan_layanan->get_service->harga)}}',
                                                                '{{$item->id}}')">
                                                        <i
                                                            class="fa fa-cog"></i></button>

                                                @else
                                                    <button class="btn btn-success btn-icon" data-toggle="tooltip"
                                                            title="Pekerja Telah Dibayar"
                                                            onclick=""><i
                                                            class="fa fa-check-circle"></i></button>
                                                @endif
                                            @endif
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{asset('admins/modules/datatables/datatables.js')}}"></script>
    <script src="{{asset('admins/js/page/modules-datatables.js')}}"></script>
    <script !src="">

        $("#dt-service").DataTable({
            fnDrawCallback: function (oSettings) {
                $('.use-nicescroll').getNiceScroll().resize();
                $('[data-toggle="tooltip"]').tooltip();
            },
        });


        function action_modal(rekening, bank, an, harga, id) {
            $('#rekening_service').val(rekening.toString());
            $('#bank_service').val(bank.toString());
            $('#an_service').val(an.toString());
            $('#harga_service').val(harga.toString());
            $('#id_service').val(id.toString());
            $("#modalProsesService").modal('show');
        }

        function service() {
            $('#modal-service').ajaxSubmit({
                success: function (data) {
                    $("#modalProsesService").modal('hide');
                    console.log(data);
                    swal("Data Pembayaran Berhasil Diproses", {
                        icon: "success",
                    });
                    setTimeout(function () {// wait for 5 secs(2)
                        location.reload(); // then reload the page.(3)
                    }, 1500);
                },
                error: function (xhr, modal) {
                    $('#result-code').text(xhr.status);
                    modal.find('.modal-body').prepend('<div class="alert alert-danger">Tejadi Kesalahan Silahkan Coba Lagi</div>')
                }
            });
        }
    </script>
@endpush
