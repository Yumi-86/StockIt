<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncomingPlanRequest extends FormRequest
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
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer','min:1'],
            'arriving_date' => ['required', 'date', 'after_or_equal:today'],
        ];
    }

    public function attributes()
    {
        return [
            'quantity' => '入荷予定数',
            'product_id' => '入荷予定商品',
        ];
    }

    public function messages()
    {
        return [
            'arriving_date.after_or_equal' => '入荷予定日は今日以降を入力してください。',
        ];
    }
}
