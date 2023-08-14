<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TweetRequest extends FormRequest
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
            'content' =>'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'content.required' => '文字を一文字以上入力して下さい。',
            'content.max' =>'255文字以下で入力して下さい',

        ];
    }
}
