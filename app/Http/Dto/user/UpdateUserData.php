<?php

namespace App\Http\Dto\user;


use Spatie\LaravelData\Data;

class UpdateUserData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $role
    ){}

    public static function rules(): array
    {
        return [
            "name" => "required",
            "email" => "required|email",
            "role" => "required"
        ];
    }
}
