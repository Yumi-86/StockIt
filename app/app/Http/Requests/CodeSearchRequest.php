<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodeSearchRequest extends FormRequest
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
            'code' => ['nullable', 'regex: /^[A-Z]{3}-\d{5}$/'],
        ];
    }

    public function messages()
    {
        return [
            'code.regex' => 'コード形式が正しくありません',
        ];
    }
}
