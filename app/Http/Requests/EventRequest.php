<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'eventdate' => 'required|date',
            'place' => 'required|string|max:25',
            'meetingtime' => 'required',
            
            'deadlinedate' => 'required|date',
            'title' => 'required|string|max:20',
        ];
    }
}
