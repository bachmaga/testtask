<?php

declare(strict_types=1);

namespace App\Mapper;

use App\DTO\Response\Task as TaskDTO;
use App\Entity\Task;

class TaskMapper
{
    public function toDto(Task $task): object
    {
        $dto = new TaskDTO();

        $dto->id = $task->getId()->getValue();
        $dto->name = (string) $task->getName();
        $dto->description = (string) $task->getDescription();
        $dto->createdAt = $task->getTime()->getCreatedAt()->format('Y-m-d H:i');
        $dto->expiredAt = $task->getTime()->getExpiredAt()->format('Y-m-d H:i');

        return $dto;
    }
}
