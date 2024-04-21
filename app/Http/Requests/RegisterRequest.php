<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name'=> 'string|required',
            'username'=> 'string|required',
            'email' => 'string|required|email|unique:users,email',
            'password'=> 'string|required',
            'avatar'=> 'string|nullable',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            jsend_fail($errors) //~ composer require shalvah/laravel-jsendcomposer require shalvah/laravel-jsend
/*             response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()]) */
        );
    }

}
