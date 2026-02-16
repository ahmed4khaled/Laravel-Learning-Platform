<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates store exam question request (dashboard).
 */
class StoreExamQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'question' => 'required|string',
            'points' => 'required|integer|min:1',
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'exam_id' => 'required|exists:exams,id',
            'question_type' => 'required|in:multiple_choice,true_false,essay',
            'option_a' => 'required_if:question_type,multiple_choice|nullable|string',
            'option_b' => 'required_if:question_type,multiple_choice|nullable|string',
            'option_c' => 'required_if:question_type,multiple_choice|nullable|string',
            'option_d' => 'required_if:question_type,multiple_choice|nullable|string',
            'correct_option' => 'required_if:question_type,multiple_choice|nullable|string',
            'explanation' => 'nullable|string',
            'is_active' => 'boolean',
            'attempt_number' => 'required|integer|min:1',
        ];
    }
}
