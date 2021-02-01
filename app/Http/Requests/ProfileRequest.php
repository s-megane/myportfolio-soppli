<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        return [
            'mynum' => 'integer', 
            'dominant_bat' => 'string',
            'dominant_def' => 'string' ,
            'year' => 'required|date_format:"Y"',
            'month' => 'required|date_format:"m"',
            'day' => 'required|date_format:"d"',
            'Email' => 'required|email',
            'Name' => 'required|string|max:20',
        ];
    }
}
