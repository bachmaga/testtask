<?php

declare(strict_types=1);

namespace App\Enum;

enum TaskStatusEnum: string
{
    case NEW = "NEW";
    case COMPLETED = "COMPLETED";
    case REMOVED = "REMOVED";
}
