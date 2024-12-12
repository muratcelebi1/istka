<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|max:5000',
            'image'=>'nullable|file|image|max:2048|mimes:jpeg,png,jpg|
            dimensions:min_width=100,min_height=100,max_width=1920,max_height=1080',
        ];
    }
      public function messages(): array
    {
        return[
            'title.required' => 'Kitap adı zorunludur',
        'title.max' => 'Kitap adı en fazla 255 karakter olabilir',
            'category_id.exists' => 'Seçtiğiniz kategori mevcut değil.',
            'category_id.required' => 'Kategori alanı zorunludur.',
           'description.required' => 'Kitap adı zorunludur',
            'description.max' => 'Kitap adı en fazla 255 karakter olabilir',
            'image.required' => 'Lütfen bir resim dosyası yükleyin.',
            'image.file' => 'Yüklenen dosya bir dosya değildir  .',
            'image.image' => 'Yüklenen dosya bir resim olmalıdır.',
            'image.mimes' => 'Resim yalnızca jpeg, png veya jpg formatında olmalıdır.',
            'image.max' => 'Resim boyutu 2MB\'dan büyük olmamalıdır.',
            'image.dimensions' => 'Resim 100x100 ile 1920x1080 boyutları arasında olmalıdır.',
        ];
    }
}
