<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActorFormRequest extends FormRequest
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
            'date_of_birth' => 'required|date',
            'country_id' => 'required|exists:countries,id',
            'image' => 'nullable|image'
        ];
    }
}
