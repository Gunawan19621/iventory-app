@extends('layouts.master')

@section('title')
    Profile
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="card">
                <div class="card-body">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            Profile Information
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            Update your account's profile information and email address.
                        </p>
                    </header>

                    @include('layouts.alert')


                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>

                    <form method="post" action="{{ route('profile.update', ['id' => auth()->user()->id]) }}" enctype="multipart/form-data"
                        class="mt-6 space-y-6">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="patch">

                        <div class="row">
                            <div class="col-9">
                                <label for="name" class="col-form-label" style="font-size: 14px;">Nama</label>
                                <div class="mb-2">
                                    <input pattern="[^0-9]+" required oninput="this.value=this.value.replace(/[0-9]/g,'');"
                                        class="form-control" type="text" id="name" name="name"
                                        value="{{ old('name', auth()->user()->name) }}" placeholder="Masukan nama anda">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="col-form-label" style="font-size: 14px;">Email</label>
                                    <input id="email" name="email" type="email" class="form-control"
                                        value="{{ old('email', $user->email) }}" placeholder="Masukan email anda">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                        <div>
                                            <p class="text-sm mt-2 text-gray-800">
                                                Your email address is unverified.
                                                <button form="send-verification"
                                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Click here to re-send the verification email.
                                                </button>
                                            </p>

                                            @if (session('status') === 'verification-link-sent')
                                                <p class="mt-2 font-medium text-sm text-green-600">
                                                    A new verification link has been sent to your email address.
                                                </p>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <label for="id_role" class="col-form-label" style="font-size: 14px;">Hak Akses</label>
                                <div class="mb-2">
                                    <input class="form-control" value="{{ $user->role->name }}" readonly>
                                    @error('id_role')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <label for="alamat" class="col-form-label" style="font-size: 14px;">Alamat</label>
                                <div class="mb-2">
                                    <textarea pattern="[^0-9]+" required oninput="this.value=this.value.replace(/[0-9]/g,'');" class="form-control"
                                        id="alamat" name="alamat" placeholder="Masukkan alamat Anda">{{ old('alamat', auth()->user()->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3 text-center">
                                <label for="photo">Foto Profil</label><br>
                                @if (auth()->user()->foto == null)
                                    <img src="{{ asset('assets/img/default-profile.png') }}"
                                        alt="{{ auth()->user()->name }}" class="rounded-circle thumb-xl profile-image"
                                        style="width: 155px; height: 155px; cursor: pointer;"><br>
                                @else
                                    <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                                        alt="{{ auth()->user()->name }}"
                                        class="rounded-circle img-thumbnail thumb-xl profile-image"
                                        style="width: 155px; height: 155px; cursor: pointer;"><br>
                                @endif
                                <div class="button-items mt-2">
                                    <label for="photo" class="btn btn-sm col-4 btn-info mt-2">
                                        <input type="file" name="foto" id="photo" class="d-none" accept="image/*">
                                        Upload
                                    </label>
                                    <button type="button" class="btn btn-sm col-4 btn-danger"
                                        onclick="window.location.reload()">Batal</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary mt-2"
                                onclick="window.location.href = '{{ route('profile.edit-password') }}';">EDIT
                                PASSWORD</button>
                            <button type="submit" class="btn btn-success mt-2 ml-2 col-1">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#photo').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('.profile-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('.profile-image').click(function() {
                $('.form-control-file').click();
            });
        });
    </script>
@endpush
