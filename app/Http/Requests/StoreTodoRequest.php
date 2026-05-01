<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreTodoRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'status' => 'required|in:pending,in_progress,completed',
            'date' => 'required|date|after_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'title.string' => 'Title must be a string.',
            'title.max' => 'Title cannot exceed 100 characters.',
            'description.string' => 'Description must be a string.',
            'description.max' => 'Description cannot exceed 500 characters.',
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be one of the following: pending, in_progress, completed.',
            'date.required' => 'Date is required.',
            'date.date' => 'Date must be a valid date.',
            'date.after_or_equal' => 'Date must be today or a future date.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation Failed!',
            'errors' => $validator->errors()
        ], 422));
    }
}
