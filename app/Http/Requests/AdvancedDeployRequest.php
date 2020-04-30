<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdvancedDeployRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cpu'       => 'required|gte:25|lte:100',
            'memory'    => 'required|gte:500|lte:4000',
            'disk'      => 'required|gte:1000|lte:50000',
            'databases' => 'required|gte:0|lte:3',
            'period' => [
                Rule::in(config('ghp.billing-periods'))
            ]
        ];
    }
}
