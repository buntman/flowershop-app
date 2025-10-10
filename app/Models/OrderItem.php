<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\OrderItemStatus;

class OrderItem extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => OrderItemStatus::class,
        ];
    }
}
