<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // السماح للمستخدمين المصرح لهم
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lecture_id' => 'nullable|exists:lectures,id',
            'pass_score' => 'required|integer|min:0|max:100',
            'duration_min' => 'required|integer|min:1',
            'max_attempts' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'total_questions' => 'nullable|integer|min:1',
            'total_points' => 'nullable|integer|min:1',
        ];
    }
}
