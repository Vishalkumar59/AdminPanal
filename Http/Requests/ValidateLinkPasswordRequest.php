<?php

namespace Modules\Qrcode\Http\Requests;

use Modules\Qrcode\Rules\ValidateLinkPasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class ValidateLinkPasswordRequest extends FormRequest
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
            'password' => ['required', new ValidateLinkPasswordRule($this->route('id'))]
        ];
    }
}