<?php

declare(strict_types=1);

namespace App\Operation;

use App\Database\TaskQuery;
use App\DTO\EditTaskRequest;
use App\Entity\Task;
use App\Entity\ValueObject\Description;
use App\Entity\ValueObject\Id;
use App\Entity\ValueObject\Name;
use App\Entity\ValueObject\Time;
use App\Repository\TaskRepository;
use DateTimeImmutable;

class EditTaskOperation
{
    public function __construct(
        private TaskRepository $taskRepository,
    ) {
    }

    public function execute(EditTaskRequest $request): Task
    {
        $task = $this->taskRepository->getByQuery(
            new TaskQuery(id: new Id($request->id))
        )->getTask();

        $time = new Time(
            createdAt: $task->getTime()->getCreatedAt(),
            expiredAt: new DateTimeImmutable($request->expiryDate),
        );

        $task->setName(new Name($request->name));
        $task->setDescription(new Description($request->description));
        $task->setTime($time);

        $this->taskRepository->save($task);

        return $task;
    }
}
