@extends('layouts.master')

@section('title')
    Tambah User
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Manajemen User</li>
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard.user.index') }}" style="color: black;">User</a>
    </li>
    <li class="breadcrumb-item active">Tambah User</li>
@endsection

@section('content')
    @include('layouts.alert')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah User</h3>
                        </div>
                        <!-- form store -->
                        <form action="{{ route('dashboard.user.store') }}" method="POST" enctype="multipart/form-data"
                            id="userForm">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama <span class="text-danger">*</span></label>
                                    <input type="name" name="name" class="form-control" id="name"
                                        placeholder="Enter Nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_role">Role</label>
                                    <select class="form-control" name="id_role" id="id_role" required>
                                        <option disabled selected>Select Hak Akses User</option>
                                        @foreach ($role as $dt_role)
                                            <option value="{{ $dt_role->id }}">{{ $dt_role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="3" id="alamat" placeholder="Enter Alamat"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Enter Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password: <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input class="form-control" name="password" type="password" id="password"
                                            placeholder="Masukkan password user" minlength="8" minlength="8" required
                                            title="Minimal 8 karakter">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="showPasswordButton">
                                                Tampilkan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                                <a href="{{ route('dashboard.user.index') }}" class="btn btn-danger">Kembali</a>
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
