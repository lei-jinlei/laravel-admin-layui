<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $return = [
            'email' => 'required|unique:users,email,'.$this->get('id').',id|email',
            'username'  => 'required|min:4|max:14|unique:users,username,'.$this->get('id').',id',
        ];
        if ($this->get('password') || $this->get('password_confirmation')){
            $return['password'] = 'required|confirmed|min:6|max:14';
        }
        return $return;
    }
}
