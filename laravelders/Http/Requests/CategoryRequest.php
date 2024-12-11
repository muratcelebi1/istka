<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|max:255',
            'is_active' => 'required|in:active,passive'
        ];
    }
      public function messages(): array
    {
        return[
            'name.required' => 'Kategori adı zorunludur',
            'name.max' => 'Kategori adı en fazla 255 karakter olabilir',
            'is_active.required' => 'Aktiflik durumu zorunludur',
            'is_active.in' => 'Aktiflik durumu sadece Active veya Passive olabilir'
        ];
    }
}
