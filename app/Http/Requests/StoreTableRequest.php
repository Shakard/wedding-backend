<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTableRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'table.name' => [
                '',
            ],
            'table.code' => [
                '',
            ]
        ];
        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'table.name' => 'name',
            'table.code' => 'code',
        ];
        return $attributes;
    }
}
