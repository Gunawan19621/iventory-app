@extends('layouts.master')

@section('title')
    List Barang
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Laporan</li>
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard.laporan-perhari.index') }}" style="color: black;">Laporan Perhari</a>
    </li>
    <li class="breadcrumb-item active">List Barang</li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">List Barang - {{ $surat_jalan->surat_jalan }}</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-stiped table-bordered" id="user-table">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Foto Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Kode barang</th>
                                        <th>Kode Kategori</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        {{-- <div class="m-3 text-right"> --}}
                        <div class="card-footer text-center">
                            <a href="{{ route('dashboard.laporan-perhari.index') }}" class="btn btn-danger">Kembali</a>
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
        //             url: '{{ route('dashboard.list-barang.dataListBarang') }}',
        //         },
        //         columns: [{
        //                 data: 'DT_RowIndex',
        //                 searchable: false,
        //                 sortable: false
        //             },
        //             {
        //                 data: 'foto_barang'
        //             },
        //             {
        //                 data: 'nama_barang'
        //             },
        //             {
        //                 data: 'kode_barang'
        //             },
        //             {
        //                 data: 'kode_kategori'
        //             },
        //         ]
        //     });
        // });
        $j(function() {
            var id_sj = "{{ $id }}"; // Ambil id_sj dari PHP dan sisipkan ke JavaScript
            var table = $j('#user-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('dashboard.list-barang.dataListBarang') }}',
                    data: {
                        id_sj: id_sj // Kirim id_sj ke server
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'foto_barang'
                    },
                    {
                        data: 'nama_barang'
                    },
                    {
                        data: 'kode_barang'
                    },
                    {
                        data: 'kode_kategori'
                    },
                ]
            });
        });
    </script>
@endpush
