<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EmployeeRequest extends Request
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
            $email_rule = 'unique:employee,id,' . $this->get('id');
        }
        else
        {
            $email_rule = 'unique:employee,email';
        }
        return [
            'surname'	=> 'required',
            'name'	=> 'required',
            'email' => $email_rule,
            'alias' => 'required',
            'hireDate' => 'required'
        ];
    }
}
