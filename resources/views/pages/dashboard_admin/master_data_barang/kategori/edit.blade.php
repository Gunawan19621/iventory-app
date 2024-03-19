@extends('layouts.master')

@section('title')
    Edit Kategori
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Master Data Barang</li>
    <li class="breadcrumb-item">Kategori</li>
    <li class="breadcrumb-item active">Edit Kategori</li>
@endsection

@section('content')
    @include('layouts.alert')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Kategori</h3>
                        </div>
                        <!-- form update -->
                        <form action="{{ route('dashboard.kategori.update', [$kategori->id]) }}" method="POST"
                            enctype="multipart/form-data" id="editForm">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_kategori">Nama Kategori<span class="text-danger">*</span></label>
                                    <input type="nama_kategori" name="nama_kategori" class="form-control" id="nama_kategori"
                                        placeholder="Enter Nama Katagori" value="{{ $kategori->nama_kategori }}" required>
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
@endpush
