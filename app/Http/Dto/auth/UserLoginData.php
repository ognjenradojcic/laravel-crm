<?php

namespace App\Http\Dto\auth;

use Spatie\LaravelData\Data;

class UserLoginData extends Data
{
    public function __construct(
        public string $email,
        public string $password
    ){}

    public static function rules(): array
    {
        return [
            "email" => "required|email",
            "password" => "required"
        ];
    }

}
