<?php

namespace App\Http\Requests\kategori;

use Illuminate\Foundation\Http\FormRequest;

class ValidasiCreateKategori extends FormRequest
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
            'nama_kategori' => 'required|string|max:255',
            'kode_kategori' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kategori.required' => 'Nama Kategori wajib diisi',
            'nama_kategori.string' => 'Nama Kategori harus berupa string',
            'nama_kategori.max' => 'Nama Kategori maksimal 255 karakter',
            'kode_kategori.required' => 'Kode Kategori wajib diisi',
            'kode_kategori.string' => 'Kode Kategori harus berupa string',
            'kode_kategori.max' => 'Kode Kategori maksimal 255 karakter',
        ];
    }
}
