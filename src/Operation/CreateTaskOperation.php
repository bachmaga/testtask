<?php

declare(strict_types=1);

namespace App\Operation;

use App\DTO\CreateTaskRequest;
use App\Entity\Task;
use App\Entity\ValueObject\Description;
use App\Entity\ValueObject\Name;
use App\Entity\ValueObject\Time;
use App\Repository\TaskRepository;
use DateTimeImmutable;

class CreateTaskOperation
{
    public function __construct(
        private TaskRepository $taskRepository,
    ) {
    }

    public function execute(CreateTaskRequest $request): Task
    {
        $time = new Time(
            createdAt: new DateTimeImmutable(),
            expiredAt: new DateTimeImmutable($request->expiryDate),
        );

        $task = new Task();
        $task->setName(new Name($request->name));
        $task->setDescription(new Description($request->description));
        $task->setTime($time);

        $this->taskRepository->save($task);

        return $task;
    }
}
