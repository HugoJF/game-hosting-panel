<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/** @deprecated  */
class ServerDeployRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $periods = collect(config('ghp.billing-periods'))->filter(fn($p) => $p)->keys()->toArray();
        [
            'cpu'       => $cpu,
            'memory'    => $memory,
            'disk'      => $disk,
            'databases' => $databases,
        ] = config('ghp.limits');

        return [
            'billing_period' => ['required', Rule::in($periods)],
            'cpu'            => "required|numeric|min:0|max:$cpu",
            'memory'         => "required|numeric|min:0|max:$memory",
            'disk'           => "required|numeric|min:0|max:$disk",
            'databases'      => "required|numeric|min:0|max:$databases",
        ];
    }
}
