<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            //
            'name'=>'required | string | min:10 | max:150',
            'surname'=>'required | string | min:10 | max:150 ',
            'email'=>'required | email',
            'password'=>'required | alpha_dash | min:10 | max:50',
            'rol_id'=> 'required | integer ',
            'ip'=>'required | ip |',
            'status'=>'min:1',

        ];
    }
}
