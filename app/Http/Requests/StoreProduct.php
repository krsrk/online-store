<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'product_name'=> 'required | string | alpha | max:255 | min :|0',
            'product_guid'=> 'required | alpha_num',
            'id_user_maker'=> 'required | integer  ',
            'id_user_publisher'=>'required | integer',
            'description'=>'required | min:10 | max:600',
            'price'=> 'required ',
            'image'=>'string',
            'status'=>'required'



            //
        ];
    }
}
