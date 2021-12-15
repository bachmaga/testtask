<?php

declare(strict_types=1);

namespace App\Entity\ValueObject;

use App\Enum\TaskStatusEnum;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable()]
class Status
{
    #[ORM\Column(type:"task_status", length:25)]
    private TaskStatusEnum $status;

    public function __construct(TaskStatusEnum $status)
    {
        $this->status = $status;
    }

    public function getStatus(): TaskStatusEnum
    {
        return $this->status;
    }

    public function __toString(): string
    {
        return $this->status->value;
    }
}
