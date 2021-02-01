<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class valiRequest extends FormRequest
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
            'meet' => 'integer|between:1,8' ,
            'power' => 'integer|between:1,8' ,
            'run' => 'integer|between:1,8' ,
            'defense' => 'integer|between:1,8' ,
            'shoulder' => 'integer|between:1,8' ,
            'at_bat' => 'nullable|integer',
            'hits' => 'nullable|integer',
            'hr' => 'nullable|integer',
            'rbi' => 'nullable|integer',
            'steal' => 'nullable|integer',
            'innings' => 'nullable|integer',
            'conceded' => 'nullable|integer',
            'strikeout' => 'nullable|integer',
            'getyear' => 'nullable|integer|digits:4',
            'getopponent' => 'nullable|string|max:15',
            'title' => 'nullable|string|max:20',
            'opponent' => 'nullable|string|max:15',
            'myscore' => 'nullable|integer|digits_between:1,2',
            'oppscore' => 'nullable|integer|digits_between:1,2',
            
            
        ];
    }
}
