<?php

namespace App\Http\Requests\role;

use Illuminate\Foundation\Http\FormRequest;

class ValidasiCreateRole extends FormRequest
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
            'name' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Kolom name harus berupa teks.',
            'name.max' => 'Kolom name tidak boleh lebih dari :max karakter.',
            'description.string' => 'Kolom description harus berupa teks.',
        ];
    }
}