<?php

namespace App\Http\Dto\user;


use Spatie\LaravelData\Data;

class CreateUserData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $role
    ){}

    public static function rules(): array
    {
        return [
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
            "role" => "required"
        ];
    }
}
