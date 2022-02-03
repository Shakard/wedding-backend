<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Portfolio\PortfolioFormRequest;

class StoreLibroRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'libro.code' => [
                '',
            ],
            'libro.name' => [
                '',
            ],
            'libro.slug' => [
                '',
            ],
            'libro.image' => [
                '',
            ],
            'libro.description' => [
                '',
            ]
        ];
        return $rules;
    }

    public function attributes()
    {
        $attributes = [

            'libro.code' => 'code',
            'libro.name' => 'name',
            'libro.slug' => 'slug',
            'libro.image' => 'image',
            'libro.description' => 'description'
        ];
        return $attributes;
    }
}
