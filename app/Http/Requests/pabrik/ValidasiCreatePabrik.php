<?php

namespace App\Http\Requests\pabrik;

use Illuminate\Foundation\Http\FormRequest;

class ValidasiCreatePabrik extends FormRequest
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
            'nama_pabrik' => 'required|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'nama_pabrik.required' => 'Nama Role harus diisi',
            'nama_pabrik.string' => 'Nama Role harus berupa string',
            'nama_pabrik.max' => 'Nama Role maksimal 50 karakter',
        ];
    }
}