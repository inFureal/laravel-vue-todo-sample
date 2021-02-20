<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoApiRequest extends FormRequest
{

    public function rules()
    {
        return [
            'text' => ['required', 'string', 'max:255'],
            'finished' => ['nullable', 'boolean']
        ];
    }
}
