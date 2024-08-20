<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreMaterial extends FormRequest
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
            'title' => [
                'required',
                'min:2', // Minimal 2 karakter
                'max:255', // Maksimal 255 karakter
            ],
            'description' => [
                'required',
                'min:5', // Minimal 5 karakter
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
            'title.required' => 'Title is required.',
            'title.min' => 'Title must be at least :min characters.',
            'title.max' => 'Title may not be greater than :max characters.',
            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least :min characters.',
            'thumbnail.required' => 'Thumbnail is required.',
            'thumbnail.file' => 'Thumbnail must be a file.',
            'thumbnail.mimes' => 'Thumbnail must be a file of type: :values.',
            'thumbnail.max' => 'Thumbnail may not be greater than :max kilobytes.',
            'video.required' => 'Video is required.',
            'video.url' => 'Video must be a valid URL.',
        ];
    }
}
