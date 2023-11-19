<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "number",
        "address",
        "industry",
        "company_id"
    ];
    public function company(): BelongsTo {
        return $this -> belongsTo(Company::class);
    }
}
