@extends('layouts.master')

@section('title')
    Tambah Barang
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Master Data Barang</li>
    <li class="breadcrumb-item">Barang</li>
    <li class="breadcrumb-item active">Tambah Barang</li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.alert')

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Barang</h3>
                        </div>
                        <!-- form store -->
                        <form action="{{ route('dashboard.barang.store') }}" method="POST" enctype="multipart/form-data"
                            id="userForm">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang <span class="text-danger">*</span></label>
                                    <input type="nama_barang" name="nama_barang" class="form-control" id="nama_barang"
                                        placeholder="Enter Nama Barang" required>
                                </div>
                                <div class="form-group">
                                    <label for="kode_barang">Kode Barang <span class="text-danger">*</span></label>
                                    <input type="kode_barang" name="kode_barang" class="form-control" id="kode_barang"
                                        placeholder="Enter Kode Barang">
                                </div>
                                <div class="form-group">
                                    <label for="kode_kategori">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-control" name="kode_kategori" id="kode_kategori" required>
                                        <option disabled selected>Select Kategori</option>
                                        @foreach ($kategori as $dt_kategori)
                                            <option value="{{ $dt_kategori->kode_kategori }}">
                                                {{ $dt_kategori->nama_kategori }}</option>
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
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
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
