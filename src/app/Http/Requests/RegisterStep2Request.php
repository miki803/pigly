<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep2Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'latest_weight' => ['required', 'numeric', 'regex:/^\d{1,4}(\.\d)?$/'],
            'goal_weight' => ['required', 'numeric', 'regex:/^\d{1,4}(\.\d)?$/'],
        ];
    }

    public function messages()
    {
        return [
            'latest_weight.required' => '現在の体重を入力してください',
            'latest_weight.numeric' => '4桁までの数字で入力してください',
            'latest_weight.regex' => '小数点は1桁で入力してください',
            'goal_weight.required' => '目標の体重を入力してください',
            'goal_weight.numeric' => '4桁までの数字で入力してください',
            'goal_weight.regex' => '小数点は1桁で入力してください',
        ];
    }
}
