<?php

declare(strict_types=1);

namespace App\DTO;

use App\Validator\Constraints\Exist;

class TaskRequest implements RequestDTOInterface
{
    #[Exist()]
    public int $id;
}
