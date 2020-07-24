<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string|min:3|max:50',
            'value' => 'required|numeric|min:1',
            'max_uses' => 'required|numeric|min:1',
        ];
    }
}
