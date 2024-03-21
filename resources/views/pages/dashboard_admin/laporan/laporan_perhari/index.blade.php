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
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Custom Select</label>
                                                <select class="custom-select">
                                                    <option>option 1</option>
                                                    <option>option 2</option>
                                                    <option>option 3</option>
                                                    <option>option 4</option>
                                                    <option>option 5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputdate2">Tanggal</label>
                                                <input type="date" class="form-control" id="exampleInputdate2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 d-flex align-items-center justify-content-end">
                                    <a href="{{ route('dashboard.pabrik.create') }}" class="btn btn-success btn-sm"><i
                                            class="fa fa-plus-circle"></i> Tambah</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-stiped table-bordered" id="user-table">
                                <thead>
                                    <tr>
                                        <th width="6%">No</th>
                                        <th>Surat Jalan</th>
                                        <th>Nama Pabrik</th>
                                        <th>Nama User</th>
                                        <th width="15%"><i class="fa fa-cog"></i></th>
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
