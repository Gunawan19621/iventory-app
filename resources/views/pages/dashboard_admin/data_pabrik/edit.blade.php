@extends('layouts.master')

@section('title')
    Edit Pabrik
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard.pabrik.index') }}" style="color: black;">Pabrik</a>
    </li>
    <li class="breadcrumb-item active">Edit Pabrik</li>
@endsection

@section('content')
    @include('layouts.alert')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Pabrik</h3>
                        </div>
                        <!-- form update -->
                        <form action="{{ route('dashboard.pabrik.update', [$pabrik->id]) }}" method="POST"
                            enctype="multipart/form-data" id="editForm">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_pabrik">Nama Pabrik<span class="text-danger">*</span></label>
                                    <input type="nama_pabrik" name="nama_pabrik" class="form-control" id="nama_pabrik"
                                        placeholder="Enter Nama Pabrik" value="{{ $pabrik->nama_pabrik }}" required>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                                <a href="{{ route('dashboard.pabrik.index') }}" class="btn btn-danger">Kembali</a>
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
