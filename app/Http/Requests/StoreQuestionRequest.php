<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
            'question' => 'required|string|max:1000',
            'question_type' => 'required|in:multiple_choice,true_false,essay',
            'option_a' => 'required_if:question_type,multiple_choice|nullable|string|max:255',
            'option_b' => 'required_if:question_type,multiple_choice|nullable|string|max:255',
            'option_c' => 'required_if:question_type,multiple_choice|nullable|string|max:255',
            'option_d' => 'required_if:question_type,multiple_choice|nullable|string|max:255',
            'correct_option' => 'required_if:question_type,multiple_choice|nullable|string|in:option_a,option_b,option_c,option_d',
            'points' => 'required|integer|min:1|max:100',
            'explanation' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'exam_id' => 'required|exists:exams,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'question.required' => 'نص السؤال مطلوب',
            'question_type.required' => 'نوع السؤال مطلوب',
            'question_type.in' => 'نوع السؤال يجب أن يكون: اختيار متعدد، صح أو خطأ، مقالي',
            'option_a.required_if' => 'الخيار أ مطلوب للأسئلة متعددة الخيارات',
            'option_b.required_if' => 'الخيار ب مطلوب للأسئلة متعددة الخيارات',
            'option_c.required_if' => 'الخيار ج مطلوب للأسئلة متعددة الخيارات',
            'option_d.required_if' => 'الخيار د مطلوب للأسئلة متعددة الخيارات',
            'correct_option.required_if' => 'الإجابة الصحيحة مطلوبة للأسئلة متعددة الخيارات',
            'correct_option.in' => 'الإجابة الصحيحة يجب أن تكون أحد الخيارات المتاحة',
            'points.required' => 'عدد النقاط مطلوب',
            'points.min' => 'عدد النقاط يجب أن يكون 1 على الأقل',
            'points.max' => 'عدد النقاط يجب أن يكون 100 كحد أقصى',
            'img.image' => 'الملف يجب أن يكون صورة',
            'img.mimes' => 'صيغة الصورة يجب أن تكون: jpeg, png, jpg, gif',
            'img.max' => 'حجم الصورة يجب أن يكون أقل من 2 ميجابايت',
        ];
    }
}
