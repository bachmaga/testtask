<?php

declare(strict_types=1);

namespace App\Operation;

use App\Database\TaskQuery;
use App\DTO\TaskRequest;
use App\Entity\ValueObject\Id;
use App\Mapper\TaskMapper;
use App\Repository\TaskRepository;

class GetTaskOperation
{
    public function __construct(
        private TaskRepository $taskRepository,
        private TaskMapper $mapper,
    ) {
    }

    public function execute(TaskRequest $request): object
    {
        $query = new TaskQuery(new Id($request->id));

        return $this->mapper->toDto(
            $this->taskRepository->getByQuery($query)->getTask()
        );
    }
}
