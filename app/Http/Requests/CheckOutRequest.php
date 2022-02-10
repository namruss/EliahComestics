<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckOutRequest extends FormRequest
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
        return[
            'name'=>'required',
            'phone'=>'required|regex:/[0-9]{9}/',
            'address'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'The name not empty!',
            'address.required'=>'The address not empty!',
            'phone.required'=>'The phone not empty!',
            'phone.regex'=>'The phone Invalid format (0->9 and has 9 number)!',
        ];
    }
}
