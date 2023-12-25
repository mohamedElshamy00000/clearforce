<?php

namespace App\Http\Requests;

use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;

use Illuminate\Foundation\Http\FormRequest;

class CardVerificationRequest extends FormRequest
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
            'number' => ['required', new CardNumber],
            'name'   => ['required', 'string'],
            'year'   => ['required', new CardExpirationYear($this->get('year'))],
            'month'  => ['required', new CardExpirationMonth($this->get('month'))],
            'cvc'    => ['required', new CardCvc($this->get('number'))]
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
