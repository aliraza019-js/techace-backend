<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->method() === 'PUT') {
            return [
                'full_name'            => 'required|max:255',
                'user_name'            => ['required', Rule::unique('users')->ignore($this->id)],
                'email'                => ['required', 'max:128', 'email', Rule::unique('users')->ignore($this->id)]
            ];
        }
        return [
            'full_name'            => 'required|max:255',
            'user_name'            => 'required|unique:users|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|same:password|min:6',
        ];
    }
}
