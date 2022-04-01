<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUpdateUser extends FormRequest
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

        $rules = [
            'user.name' => [''],
            'user.email' => [''],
            'user.password' => [''],
            'user.file' => [''],
        ];

        return $rules;
    }

    public function attributes()
    {
        $attributes = [

            'user.name' => 'name',
            'user.email' => 'email',
            'user.password' => 'password',
            'user.file' => 'file'

        ];
        return $attributes;
    }

}

