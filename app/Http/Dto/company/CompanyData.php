<?php

namespace App\Http\Dto\company;

use Spatie\LaravelData\Data;

class CompanyData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $number,
        public string $address,
        public string $industry,
        public string $eid,
    ){}

    public static function rules(): array
    {
        return [
            "name" => "required",
            "email" => "required|email",
            "number" => "required",
            "address" => "required",
            "industry" => "required",
            "eid" => "required"
        ];
    }

}
