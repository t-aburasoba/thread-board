<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThreadRequest extends FormRequest
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
            'name' => 'required',
            'content' => 'required|min:10',
        ];
    }

    public function messages()
    {
        return [
            'name.required'  => trans('validation.required'),
            'content.required'  => trans('validation.required'),
            'content.min'  => trans('validation.min')
        ];
    }
}
