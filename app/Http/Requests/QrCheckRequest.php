<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validates QR code redemption (purchase) request.
 */
class QrCheckRequest extends FormRequest
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
            'Buy' => 'required|string|min:6|max:50',
            'id_lec' => 'required|integer',
            'name_lec' => 'required|string',
            'lec_std' => 'required|integer',
            'role_lec' => 'required|integer',
            'monthly_lec' => 'nullable|integer',
            'termely_lec' => 'nullable|integer',
            'date_exp' => 'required|integer',
        ];
    }
}
