@extends('layouts.master')

@section('title')
    Edit Barang
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Master Data Barang</li>
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard.barang.index') }}" style="color: black;">Barang</a>
    </li>
    <li class="breadcrumb-item active">Edit Barang</li>
@endsection

@section('content')
    @include('layouts.alert')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Barang</h3>
                        </div>
                        <!-- form update -->
                        <form action="{{ route('dashboard.barang.update', [$barang->id]) }}" method="POST"
                            enctype="multipart/form-data" id="editForm">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang <span class="text-danger">*</span></label>
                                    <input type="nama_barang" name="nama_barang" class="form-control" id="nama_barang"
                                        placeholder="Enter Nama Barang" value="{{ $barang->nama_barang }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="kode_barang">Kode Barang <span class="text-danger">*</span></label>
                                    <input type="kode_barang" name="kode_barang" class="form-control" id="kode_barang"
                                        placeholder="Enter Kode Barang" value="{{ $barang->kode_barang }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="kode_kategori">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-control" name="kode_kategori" id="kode_kategori" required>
                                        <option disabled selected>Select Kategori</option>
                                        @foreach ($kategori as $dt_kategori)
                                            <option value="{{ $dt_kategori->kode_kategori }}"
                                                {{ $barang->kode_kategori == $dt_kategori->kode_kategori ? 'selected' : '' }}>
                                                {{ $dt_kategori->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="foto_barang">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto_barang"
                                                name="foto_barang" accept="image/*">
                                            <label class="custom-file-label" for="foto_barang">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                                <a href="{{ route('dashboard.barang.index') }}" class="btn btn-danger">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- Show Password -->
    <script>
        const passwordInput = document.getElementById("password");
        const showPasswordButton = document.getElementById("showPasswordButton");

        showPasswordButton.addEventListener("click", function() {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                showPasswordButton.textContent = "Sembunyikan";
            } else {
                passwordInput.type = "password";
                showPasswordButton.textContent = "Tampilkan";
            }
        });
    </script>

    <!-- Disable submit pada saat kliknya doubel -->
    <script>
        document.getElementById('userForm').addEventListener('submit', function() {
            document.getElementById('submitButton').setAttribute('disabled', 'true');
        });
    </script>

    <!-- bs-custom-file-input -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endpush
