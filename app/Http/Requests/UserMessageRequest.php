<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // user is checked with middleware
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
            'message' => 'required',
        ];
    }
}
