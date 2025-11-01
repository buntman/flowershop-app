<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case READY_FOR_PICKUP = 'ready_for_pickup';
    case COMPLETED = 'completed';
}
