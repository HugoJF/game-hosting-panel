<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServerStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $periods = collect(config('ghp.billing-periods'))->filter(fn ($p) => $p)->keys()->toArray();
        list($cpu, $memory, $disk, $databases) = config('ghp.limits');

        return [
            'billing_period' => ['required', Rule::in($periods)],
            'name'           => "required|min:3|max:170",
            'cpu'            => "required|min:0|max:$cpu",
            'memory'         => "required|min:0|max:$memory",
            'disk'           => "required|min:0|max:$disk",
            'databases'      => "required|min:0|max:$databases",
        ];
    }
}
