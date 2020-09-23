<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'original_name' => 'required|string',
            'description' => 'required|string',
            'year' => 'required|integer',
            'country_id' => 'required|exists:countries,id',
            'genre_id' => 'required|exists:genres,id',
            'image' => 'nullable|image'
        ];
    }
}
