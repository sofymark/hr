<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PermissionRequest extends Request
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
            $machine_rule = 'required|unique:permissions,id,' . $this->get('id');
        }
        else
        {
            $machine_rule = 'required|unique:permissions,machine';
        }
        return [
            'name'	=> 'required',
            'machine' => $machine_rule,
            'group'	=> 'required',
        ];
    }
}
