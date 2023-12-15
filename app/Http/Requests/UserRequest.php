<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
        if ($this->method() == 'PATCH')
        {
            $username_rule = 'required|unique:users,id,' . $this->get('id');
            $email_rule = 'email|unique:users,id,' . $this->get('id');
        }
        else
        {
            $username_rule = 'required|unique:users,username';
            $email_rule = 'email|unique:users,email';
        }
        return [
            'username'	=> $username_rule,
            'email' => $email_rule,
            'password' => 'confirmed|min:6',
            'name'	=> 'required',
        ];
    }
}
