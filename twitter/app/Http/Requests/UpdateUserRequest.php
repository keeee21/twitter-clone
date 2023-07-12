<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        return [
            'name' => 'required|string',
            'email' => 'required|email|regex:/^[a-zA-Z0-9@._-]+$/',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須項目です',
            'email.required' => 'メールアドレスは必須項目です',
            'email.email' => 'メールアドレスの形式で入力してください',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'お名前',
            'email' => 'メールアドレス',
        ];
    }
}
