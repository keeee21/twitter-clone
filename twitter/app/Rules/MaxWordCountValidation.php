<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxWordCountValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @param int $MaxWordCount
     */
    public function __construct(private int $MaxWordCount)
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $count = 0;
        $characters = mb_str_split($value);

        foreach ($characters as $char) {
            if (mb_strlen($char) == strlen($char)) {
                $count += 0.5; // 半角文字
            } else {
                $count += 1; // 全角文字
            }
        }

        return $this->MaxWordCount >= $count;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "ツイートは全角で140文字、半角で280文字以下で入力してください";
    }
}

