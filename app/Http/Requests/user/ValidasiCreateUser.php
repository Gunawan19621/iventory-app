<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class ValidasiCreateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:32',
            'id_role' => 'nullable|exists:roles,id',
            'email' => 'required|email|string|max:45|unique:users,email',
            'email_verified_at' => 'nullable|date_format:Y-m-d H:i:s',
            'password' => 'required|string|min:6|max:16',
            'foto' => 'nullable|string|max:255',
            'alamat' => 'nullable|string', // Mengganti 'address' menjadi 'alamat'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom name wajib diisi.',
            'name.string' => 'Kolom name harus berupa teks.',
            'name.max' => 'Kolom name tidak boleh lebih dari :max karakter.',
            'id_role.exists' => 'Role yang dipilih tidak valid.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.string' => 'Kolom email harus berupa teks.',
            'email.max' => 'Kolom email tidak boleh lebih dari :max karakter.',
            'email.unique' => 'Email sudah digunakan.',
            'email_verified_at.date_format' => 'Format tanggal email_verified_at tidak valid.',
            'password.required' => 'Kolom password wajib diisi.',
            'password.string' => 'Kolom password harus berupa teks.',
            'password.min' => 'Kolom password minimal harus :min karakter.',
            'password.max' => 'Kolom password tidak boleh lebih dari :max karakter.',
            'foto.string' => 'Kolom foto harus berupa teks.',
            'foto.max' => 'Kolom foto tidak boleh lebih dari :max karakter.',
            'alamat.string' => 'Kolom alamat harus berupa teks.',
        ];
    }
}