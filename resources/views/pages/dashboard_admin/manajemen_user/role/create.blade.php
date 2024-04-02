@extends('layouts.master')

@section('title')
    Tambah Role
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Manajemen User</li>
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard.role.index') }}" style="color: black;">Role</a>
    </li>
    <li class="breadcrumb-item active">Tambah Role</li>
@endsection

@section('content')
    @include('layouts.alert')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Role</h3>
                        </div>
                        <!-- form store -->
                        <form action="{{ route('dashboard.role.store') }}" method="POST" enctype="multipart/form-data"
                            id="userForm">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Role<span class="text-danger">*</span></label>
                                    <input type="name" name="name" class="form-control" id="name"
                                        placeholder="Enter Nama Role" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi Role <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control" rows="3" id="description" placeholder="Enter deskripsi"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                                <a href="{{ route('dashboard.role.index') }}" class="btn btn-danger">Kembali</a>
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
