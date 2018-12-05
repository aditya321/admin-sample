<?php

namespace App\Http\Request\Admin;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'g-recaptcha-response' => 'required'
        ];
    }
    

    public function messages() {
        return ['g-recaptcha-response.required' => 'Please click on checkbox to prove you are human.'];
    }

}
