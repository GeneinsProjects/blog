<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class UpdateUsers extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         
         $validation = [ 
            'name'          =>  'required|max:255',  
            'email'         => 'email|required|unique:users,email,'.$this->segment(2),               
            'password'           => '',
            'confirm_password'   => 'same:password', 
        ];

        return $validation; 
    }
}
