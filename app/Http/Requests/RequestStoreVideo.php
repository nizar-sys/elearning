<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreVideo extends FormRequest
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
        $rules = [
            'created_by' => [
                'required',
                'exists:users,id', // Validasi bahwa creator harus ada di tabel users
            ],
            'title' => [
                'required',
                'min:2', // Minimal 2 karakter
                'max:255', // Maksimal 255 karakter
            ],
            'description' => [
                'required',
                'min:5', // Minimal 5 karakter
            ],
            'category_id' => [
                'required',
                'array', // Pastikan input adalah array
                'min:1', // Minimal satu kategori harus dipilih
            ],
            'category_id.*' => [
                'exists:categories,id', // Validasi bahwa setiap kategori harus ada di tabel categories
            ],
            'thumbnail' => [
                'nullable', // Tidak wajib diisi, kecuali pada metode POST
                'file',
                'mimes:jpg,jpeg,png', // Validasi tipe file
                'max:2048', // Maksimal ukuran 2MB
            ],
            'video' => [
                'required',
                'url', // Validasi bahwa input harus berupa URL yang valid
            ],
        ];

        // Jika metode POST, thumbnail wajib diisi
        if ($this->isMethod('POST')) {
            $rules['thumbnail'][] = 'required';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'created_by.required' => 'The creator field is required.',
            'created_by.exists' => 'The selected creator is invalid.',
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least :min characters.',
            'title.max' => 'The title may not be greater than :max characters.',
            'description.required' => 'The description field is required.',
            'description.min' => 'The description must be at least :min characters.',
            'category_id.required' => 'The category field is required.',
            'category_id.array' => 'The category must be an array.',
            'category_id.min' => 'At least one category must be selected.',
            'category_id.*.exists' => 'One or more selected categories are invalid.',
            'thumbnail.file' => 'The thumbnail must be a file.',
            'thumbnail.mimes' => 'The thumbnail must be a file of type: :values.',
            'thumbnail.max' => 'The thumbnail may not be greater than :max kilobytes.',
            'thumbnail.required' => 'The thumbnail field is required.',
            'video.required' => 'The video field is required.',
            'video.url' => 'The video must be a valid URL.',
        ];
    }
}
