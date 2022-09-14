<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdateRequest extends FormRequest
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
        $id = $this->route()->parameters['user']->id;

        return [
            'name'                       => ['required','string','min:8','max:40'],
            'user_name'                  => ['required','alpha_dash','string','min:5','max:30','unique:users,user_name,' . $id . ',id'],
            'phone'                      => ['required','numeric','regex:/(01)[0-9]{9}/','digits:11'], //Egypt mobile numbers regex
            'email'                      => ['required','email','unique:users,email,' . $id . ',id'],
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
