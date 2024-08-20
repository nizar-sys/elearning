<?php

namespace App\Http\Requests;

use App\Enums\ArticleStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class RequestStoreArticle extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'created_by' => 'required|integer|exists:users,id',
            'thumbnail' => '|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|' . new EnumValue(ArticleStatus::class),
        ];

        if ($this->isMethod('POST')) {
            $rules['thumbnail'] = 'required' . $rules['thumbnail'];
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
            'status.enum_value' => 'The selected status is invalid. It must be one of: ' . implode(', ', ArticleStatus::getValues()),
            'title.required' => 'The title field is required.',
            'title.string' => 'The title field must be a string.',
            'title.max' => 'The title field must not exceed 255 characters.',
            'content.required' => 'The content field is required.',
            'content.string' => 'The content field must be a string.',
            'category_id.required' => 'The category field is required.',
            'category_id.integer' => 'The category field must be an integer.',
            'category_id.exists' => 'The selected category is invalid.',
            'created_by.required' => 'The creator field is required.',
            'created_by.integer' => 'The creator field must be an integer.',
            'created_by.exists' => 'The selected creator is invalid.',
            'thumbnail.image' => 'The thumbnail must be an image.',
            'thumbnail.mimes' => 'The thumbnail must be a file of type: jpeg, png, jpg.',
            'thumbnail.max' => 'The thumbnail may not be greater than 2048 kilobytes.',
            'status.required' => 'The status field is required.',
            'thumbnail.required' => 'The thumbnail field is required.',
        ];
    }
}
