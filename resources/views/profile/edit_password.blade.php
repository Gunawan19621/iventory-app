@extends('layouts.master')

@section('title')
    Password
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Profile</li>
    <li class="breadcrumb-item active">Edit Password</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    Update Password
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Ensure your account is using a long, random password to stay secure.
                </p>
            </header>

            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="put">

                <div>
                    <label for="update_password_current_password" class="col-form-label" style="font-size: 14px;">Current
                        Password</label>
                    <input id="update_password_current_password" name="current_password" type="password"
                        class="form-control" autocomplete="current-password" required>
                    <p class="mt-2 text-sm text-red-600">
                        @foreach ($errors->updatePassword->get('current_password') as $message)
                            {{ $message }}
                        @endforeach
                    </p>
                </div>

                <div>
                    <label for="update_password_password" class="col-form-label" style="font-size: 14px;">New
                        Password</label>
                    <input id="update_password_password" name="password" type="password" class="form-control"
                        autocomplete="new-password" required>
                    <p class="mt-2 text-sm text-red-600">
                        @foreach ($errors->updatePassword->get('password') as $message)
                            {{ $message }}
                        @endforeach
                    </p>
                </div>

                <div>
                    <label for="update_password_password_confirmation" class="col-form-label"
                        style="font-size: 14px;">Confirm
                        Password</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                        class="form-control" autocomplete="new-password" required>
                    <p class="mt-2 text-sm text-red-600">
                        @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                            {{ $message }}
                        @endforeach
                    </p>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit"class="btn btn-success mt-2 ml-2 col-1">{{ __('Save') }}</button>

                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    Delete Account
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Before
                    deleting your account, please download any data or information that you wish to retain.
                </p>
            </header>

            <button onclick="openModal('confirm-user-deletion')"
                class="btn btn-danger mt-2 ml-2 col-2">{{ __('Delete Account') }}</button>

            <div id="confirm-user-deletion" class="modal" style="display: none;">
                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="delete">

                    <h2 class="text-lg font-medium text-gray-900">
                        Are you sure you want to delete your account?
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Once your account is deleted, all of its resources and data will be permanently deleted.
                        Please enter your password to confirm you would like to permanently delete your account.
                    </p>

                    <div class="mt-6">
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" class="mt-1 block w-3/4"
                            placeholder="Password">
                        <p class="mt-2 text-sm text-red-600">
                            @foreach ($errors->userDeletion->get('password') as $message)
                                {{ $message }}
                            @endforeach
                        </p>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="button" onclick="closeModal('confirm-user-deletion')"
                            class="btn btn-danger mt-2 ml-2 col-1">
                            Cancel
                        </button>

                        <button type="submit"class="btn btn-success mt-2 ml-2 col-1">
                            Delete Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
