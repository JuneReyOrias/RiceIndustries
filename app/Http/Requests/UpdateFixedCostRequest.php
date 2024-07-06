<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFixedCostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        $rule= [
            'particular'=>[
                'required',
                'string',
                'max:50',
            ],
            'no_of_ha'=>[
                'required',
                'string',
                'max:50',
            ],
            'cost_per_ha'=>[
                'required',
                'string',
                'max:50',
            ],
            'total_amount'=>[
                'required',
                'string',
                'max:50',
            ],
           
        ];
        return $rule;
    }
    public function messages(){
       return [
            'particular.required'=>'Please input particular',
            'no_of_ha.required'=>'Please input your no of ha',
            'cost_per_ha.required'=>'Please input cost per ha',
            'gps_longitude.required'=>'Please input total amount',
            
       ];
    
    }
}
