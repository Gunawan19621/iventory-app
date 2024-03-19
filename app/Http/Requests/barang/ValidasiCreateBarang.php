<?php

namespace App\Http\Requests\barang;

use Illuminate\Foundation\Http\FormRequest;

class ValidasiCreateBarang extends FormRequest
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
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'nullable|string|max:255|unique:barangs,kode_barang',
            'kode_kategori' => 'required|string|max:255',
            'foto_barang' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_barang.required' => 'Nama barang wajib diisi',
            'nama_barang.string' => 'Nama barang harus berupa string',
            'nama_barang.max' => 'Nama barang maksimal 255 karakter',
            'kode_barang.string' => 'Kode barang harus berupa string',
            'kode_barang.max' => 'Kode barang maksimal 255 karakter',
            'kode_barang.unique' => 'Kode barang sudah ada',
            'kode_kategori.required' => 'Kode kategori wajib diisi',
            'kode_kategori.string' => 'Kode kategori harus berupa string',
            'kode_kategori.max' => 'Kode kategori maksimal 255 karakter',
            'foto_barang.image' => 'Foto barang harus berupa gambar',
            'foto_barang.mimes' => 'Foto barang harus berformat jpg, jpeg, atau png',
            'foto_barang.max' => 'Foto barang maksimal 2MB',
        ];
    }
}
