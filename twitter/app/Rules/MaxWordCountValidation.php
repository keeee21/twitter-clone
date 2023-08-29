<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxWordCountValidation implements Rule
{
    const SINGLE_BYTE_CHAR_COUNT = 0.5;
    const DOUBLE_BYTE_CHAR_COUNT = 1;

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
            $count += (mb_strlen($char) == strlen($char)) ? self::SINGLE_BYTE_CHAR_COUNT : self::DOUBLE_BYTE_CHAR_COUNT;
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
        $fullWidthMax = (int) ($this->MaxWordCount * self::SINGLE_BYTE_CHAR_COUNT);
        $halfWidthMax = $this->MaxWordCount;
        return "ツイートは全角で{$fullWidthMax}文字、半角で{$halfWidthMax}文字以下で入力してください";
    }
}
