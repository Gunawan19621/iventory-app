<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $data = [
            'user' => $request->user(),
            // 'profile' => User::get(),
        ];
        return view('profile.profile', $data);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $user = $request->user();

            $user->fill($request->validated());

            // Handle foto upload if provided
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto')->storeAs('public/profile_foto', $request->user()->id . '.' . $request->file('foto')->extension());
                $user->foto = str_replace('public/', '', $foto);
            }

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            return redirect()->route('profile.edit')->with('success', 'Profile berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()
                ->route('profile.edit')
                ->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }

    // Halaman Ganti Password
    public function changePassword(Request $request): View
    {
        $data = [
            'user' => $request->user(),
            // 'profile' => User::get(),
        ];
        return view('profile.edit_password', $data);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
