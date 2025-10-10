<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\CartStatus;

class Cart extends Model
{
    protected $guarded = [];

    protected function casts(): array {
        return [
            'status' => CartStatus::class,
        ];
    }
}
