<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case READY_FOR_PICKUP = 'ready for pickup';
    case COMPLETED = 'completed';
}
