<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^(09|03|05|07|08)[0-9]{8}$/', $value);
    }

    public function message()
    {
        return 'Số điện thoại không hợp lệ';
    }
}
