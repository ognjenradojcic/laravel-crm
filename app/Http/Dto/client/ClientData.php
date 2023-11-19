<?php

namespace App\Http\Dto\client;

use Spatie\LaravelData\Data;

class ClientData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $number,
        public string $address,
        public string $industry,
        public string $company_id,
    ){}

    public static function rules(): array
    {
        return [
            "name" => "required",
            "email" => "required|email",
            "number" => "required",
            "address" => "required",
            "industry" => "required",
            "company_id" => "required"
        ];
    }

}
