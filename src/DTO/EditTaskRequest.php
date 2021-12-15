<?php

declare(strict_types=1);

namespace App\DTO;

use App\Validator\Constraints\Exist;

class EditTaskRequest extends CreateTaskRequest
{
    #[Exist()]
    public int $id;
}
