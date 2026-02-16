<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates assistant answer store request.
 */
class StoreAssistantAnswerRequest extends FormRequest
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
            'content' => 'required|min:10',
            'question_id' => 'required|exists:questionlecs,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
}
