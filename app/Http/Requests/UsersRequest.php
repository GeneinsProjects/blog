<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class UsersRequest extends FormRequest
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
        ];


        switch ($this->method()) {
            case 'PATCH': 
                $validation = $validation + [
                    'email' => 'email|required|unique:users,email,'.$this->segment(2),               
                    'password'           => 'min:6',
                    'confirm_password'   => 'min:6|same:password', 
                ];
                return $validation;
                break;
            
            default:
                $validation = $validation + [
                    'email' => 'email|required|unique:users,email',
                    'password'           => 'required|min:6',
                    'confirm_password'   => 'required|min:6|same:password', 
                ];
                return $validation;
                break;
        }
    }
}
