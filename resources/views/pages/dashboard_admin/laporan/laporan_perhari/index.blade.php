@extends('layouts.master')

@section('title')
    Laporan Perhari
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Laporan</li>
    <li class="breadcrumb-item active">Laporan Perhari</li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Pilih Pabrik</label>
                                        <select class="custom-select" name="pabrik_id" id="pabrik_id">
                                            <option selected disabled>Pilih Pabrik</option>
                                            @foreach ($pabrik as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_pabrik }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputdate2">Tanggal</label>
                                        <input type="date" class="form-control" id="exampleInputdate2" name="tanggal">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="exampleInputdate2">&nbsp;</label>
                                        <button type="button" class="btn btn-primary btn-block" style="width: 100px;"
                                            id="btnSearch">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-stiped table-bordered" id="user-table">
                                <thead>
                                    <tr>
                                        <th width="6%">No</th>
                                        <th>Surat Jalan</th>
                                        <th>Tgl Surat Jalan</th>
                                        <th>Nama Pabrik</th>
                                        <th>Nama User</th>
                                        <th width="10%"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Memuat jQuery dalam mode noConflict
        var $j = jQuery.noConflict();

        // Menggunakan $j untuk menghindari bentrok
        // $j(function() {
        //     var table = $j('#user-table').DataTable({
        //         responsive: true,
        //         processing: true,
        //         serverSide: true,
        //         autoWidth: false,
        //         ajax: {
        //             url: '{{ route('dashboard.laporan-perhari.data') }}',
        //         },
        //         columns: [{
        //                 data: 'DT_RowIndex',
        //                 searchable: false,
        //                 sortable: false
        //             },
        //             {
        //                 data: 'surat_jalan'
        //             },
        //             {
        //                 data: 'tgl_sj'
        //             },
        //             {
        //                 data: 'id_pabrik'
        //             },
        //             {
        //                 data: 'id_user'
        //             },
        //             {
        //                 data: 'aksi',
        //                 searchable: false,
        //                 sortable: false
        //             },
        //         ]
        //     });
        // });
        $j(function() {
            var table = $j('#user-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('dashboard.laporan-perhari.data') }}',
                    data: function(d) {
                        d.pabrik_id = $j('#pabrik_id').val(); // Mengambil id pabrik dari select
                        d.tanggal = $j('#exampleInputdate2').val(); // Mengambil tanggal dari input
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'surat_jalan'
                    },
                    {
                        data: 'tgl_sj'
                    },
                    {
                        data: 'id_pabrik'
                    },
                    {
                        data: 'id_user'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });

            // Menangani klik tombol Tampilkan Data
            $j('#btnSearch').click(function() {
                table.ajax.reload(); // Memuat ulang data tabel dengan parameter baru
            });
        });
    </script>
@endpush
