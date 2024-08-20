<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreRating extends FormRequest
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
            'elearning_id' => 'required|exists:elearnings,id',
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'required|string',
            'reviewer_id' => 'required|exists:users,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'elearning_id.required' => 'Elearning is required',
            'elearning_id.exists' => 'Elearning is not exists',
            'rating.required' => 'Rating is required',
            'rating.numeric' => 'Rating must be a number',
            'rating.min' => 'Rating must be at least 1',
            'rating.max' => 'Rating must be at most 5',
            'review.required' => 'Review is required',
            'review.string' => 'Review must be a string',
            'reviewer_id.required' => 'Reviewer is required',
            'reviewer_id.exists' => 'Reviewer is not exists',
        ];
    }
}
