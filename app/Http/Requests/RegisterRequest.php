<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'name'                       => ['required','string','min:8','max:40'],
            'user_name'                  => ['required','alpha_dash','string','min:5','max:30','unique:users,user_name'],
            'phone'                      => ['required','numeric','regex:/(01)[0-9]{9}/','digits:11'], //Egypt mobile numbers regex
            'password'                   => ['required','string','min:8'], //to get strong password use regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/
            'email'                      => ['required','email','unique:users'],
            'birth_day'                  => ['required','date'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));

    }
}
