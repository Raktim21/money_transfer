<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'role'                  => 'required|in:admin,sender,receiver',
            'phone'                 => 'required|string|max:11',
            'avatar'                => 'nullable|image|mimes:png,jpg,jpeg',
        ];
    }


    //custom message 
    public function messages()
    {
        return [
            'name.required'                  => 'Name is required',
            'name.string'                    => 'Invalide name',
            'name.max'                       => 'Name is too long',
            'email.required'                 => 'Email is required',
            'email.string'                   => 'Invalide email',
            'email.max'                      => 'Email is too long',
            'email.email'                    => 'Invalide email',
            'email.unique'                   => 'Email is already exist',
            'password.required'              => 'Password is required',
            'password.string'                => 'Invalide password',
            'password.min'                   => 'Password is too short',
            'password.confirmed'             => 'Password is not match',
            'password_confirmation.required' => 'Password confirmation is required',
            'role.required'                  => 'Role is required',
            'role.string'                    => 'Invalide role',
            'phone.required'                 => 'Phone is required',
            'phone.string'                   => 'Invalide phone',
            'phone.max'                      => 'Phone is too long',
            
        ];
    }
}
