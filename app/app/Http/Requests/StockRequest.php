<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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
        $stock = $this->route('stock');
        return [
            'quantity' => ['required', 'integer', 'min:1', 'max:' . $stock->quantity ],
        ];
    }

    public function attributes()
    {
        return [
            'quantity' => '出庫数',
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => '出庫数を入力してください',
            'quantity.max' => '出庫数が在庫数を上回っています',
        ];
    }
}
