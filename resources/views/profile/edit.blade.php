{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}



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

                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="patch">

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input id="name" name="name" type="text" class="mt-1 block w-full"
                                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="email" name="email" type="email" class="mt-1 block w-full"
                                value="{{ old('email', $user->email) }}" required autocomplete="username">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
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

                        <div class="flex items-center gap-4">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md">{{ __('Save') }}</button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600">Saved.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

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
                            <label for="update_password_current_password"
                                class="block text-sm font-medium text-gray-700">Current
                                Password</label>
                            <input id="update_password_current_password" name="current_password" type="password"
                                class="mt-1 block w-full" autocomplete="current-password">
                            <p class="mt-2 text-sm text-red-600">
                                @foreach ($errors->updatePassword->get('current_password') as $message)
                                    {{ $message }}
                                @endforeach
                            </p>
                        </div>

                        <div>
                            <label for="update_password_password" class="block text-sm font-medium text-gray-700">New
                                Password</label>
                            <input id="update_password_password" name="password" type="password" class="mt-1 block w-full"
                                autocomplete="new-password">
                            <p class="mt-2 text-sm text-red-600">
                                @foreach ($errors->updatePassword->get('password') as $message)
                                    {{ $message }}
                                @endforeach
                            </p>
                        </div>

                        <div>
                            <label for="update_password_password_confirmation"
                                class="block text-sm font-medium text-gray-700">Confirm
                                Password</label>
                            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full" autocomplete="new-password">
                            <p class="mt-2 text-sm text-red-600">
                                @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                                    {{ $message }}
                                @endforeach
                            </p>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Save') }}</button>

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
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{ __('Delete Account') }}</button>

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
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                    Cancel
                                </button>

                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ms-3">
                                    Delete Account
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
