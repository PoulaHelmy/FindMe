<?php

namespace App\Http\Requests\BackEnd\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
     * 'name' => 'required|unique:|max:191',

     * @return array
     */
    public function rules()
    {
        return [
            'name'=>['min:3', 'max:191','string'],
            'user_id'=>['integer'],
            'item_id'=>['integer'],
            'des'=>['min:3', 'string'],
            'status'=>['digits_between:0,1']
        ];
    }
}
