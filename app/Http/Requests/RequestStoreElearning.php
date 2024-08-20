<?php

namespace App\Http\Requests;

use App\Enums\ElearningStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class RequestStoreElearning extends FormRequest
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
            'teacher_id' => [
                'required',
                'exists:users,id',  // Validasi bahwa teacher_id harus ada di tabel users
            ],
            'benefit_id' => [
                'required',
                'exists:benefits,id',  // Validasi bahwa benefit_id harus ada di tabel benefits
            ],
            'title' => [
                'required',
                'min:2',
                'max:255',
            ],
            'description' => [
                'required',
                'min:5',
            ],
            'thumbnail' => [
                'nullable',
                'image',  // Pastikan ini adalah file gambar
                'mimes:jpg,jpeg,png',  // Hanya izinkan file dengan ekstensi ini
                'max:2048',  // Maksimal ukuran file 2MB
            ],
            'duration' => [
                'required',
            ],
            'status' => [
                'required',
                new EnumValue(ElearningStatus::class),  // Validasi bahwa status harus ada di enum ElearningStatus
            ],
            'category_id' => [
                'required',
                'array', // Pastikan input adalah array
                'min:1', // Minimal satu kategori harus dipilih
            ],
            'category_id.*' => [
                'exists:categories,id', // Validasi bahwa setiap kategori harus ada di tabel categories
            ],
            'material_id' => [
                'required',
                'array', // Pastikan input adalah array
                'min:1', // Minimal satu kategori harus dipilih
            ],
            'material_id.*' => [
                'exists:materials,id', // Validasi bahwa setiap kategori harus ada di tabel materials
            ],
        ];

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
            'teacher_id.required' => 'The teacher field is required.',
            'teacher_id.exists' => 'The selected teacher is invalid.',
            'benefit_id.required' => 'The benefit field is required.',
            'benefit_id.exists' => 'The selected benefit is invalid.',
            'title.required' => 'The title field is required.',
            'title.min' => 'The title field must be at least 2 characters.',
            'title.max' => 'The title field must not exceed 255 characters.',
            'description.required' => 'The description field is required.',
            'description.min' => 'The description field must be at least 5 characters.',
            'thumbnail.image' => 'The thumbnail must be an image.',
            'thumbnail.mimes' => 'The thumbnail must be a file of type: jpg, jpeg, png.',
            'thumbnail.max' => 'The thumbnail may not be greater than 2048 kilobytes.',
            'duration.required' => 'The duration field is required.',
            'status.required' => 'The status field is required.',
            'status.enum_value' => 'The selected status is invalid. It must be one of: ' . implode(', ', ElearningStatus::getValues()),
            'category_id.required' => 'The category field is required.',
            'category_id.array' => 'The category field must be an array.',
            'category_id.min' => 'At least one category must be selected.',
            'category_id.*.exists' => 'The selected category is invalid.',
            'material_id.required' => 'The material field is required.',
            'material_id.array' => 'The material field must be an array.',
            'material_id.min' => 'At least one material must be selected.',
            'material_id.*.exists' => 'The selected material is invalid.',
        ];
    }
}
