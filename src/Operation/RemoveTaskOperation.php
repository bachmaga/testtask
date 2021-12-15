<?php

declare(strict_types=1);

namespace App\Operation;

use App\Database\TaskQuery;
use App\DTO\TaskRequest;
use App\Entity\ValueObject\Id;
use App\Entity\ValueObject\Status;
use App\Enum\TaskStatusEnum;
use App\Repository\TaskRepository;

class RemoveTaskOperation
{
    public function __construct(
        private TaskRepository $taskRepository,
    ) {
    }

    public function execute(TaskRequest $request): void
    {
        $task = $this->taskRepository->getByQuery(
            new TaskQuery(id: new Id($request->id))
        )->getTask();

        $task->setStatus(
            new Status(TaskStatusEnum::REMOVED)
        );

        $this->taskRepository->save($task);
    }
}
