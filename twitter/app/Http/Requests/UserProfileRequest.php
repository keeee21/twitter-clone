<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
        $userId = auth()->id();
        return [
            'name' => 'sometimes|string|min:2|max:20',
            'email' => 'sometimes|nullable|email:filter,dns'
        ];
    }

    public function messages()
    {
        return [
            'name.min' => '名前は2文字以上で入力して下さい。',
            'name.max' => '名前は20文字以下で入力して下さい。',
            'email.email' => '有効なメールアドレスを入力してください。',
        ];
    }
}
