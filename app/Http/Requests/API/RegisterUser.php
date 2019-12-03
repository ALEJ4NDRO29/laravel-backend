<?php

namespace App\Http\Requests\API;


class RegisterUser extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function validationData()
    {
        return $this->get('user') ?: [];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|alpha_num|unique:users,username',
            'email'    => 'required|email',
            'password' => 'required'
        ];
    }
}
