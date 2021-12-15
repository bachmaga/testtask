<?php

declare(strict_types=1);

namespace App\Operation;

use App\Database\TaskQuery;
use App\DTO\ListTaskRequest;
use App\Mapper\ListTaskMapper;
use App\Repository\TaskRepository;

class ListTaskOperation
{
    public function __construct(
        private TaskRepository $taskRepository,
        private ListTaskMapper $mapper,
    ) {
    }

    /**
     * @phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     */
    public function execute(ListTaskRequest $request): object
    {
        $query = new TaskQuery();

        return $this->mapper->toDto(
            $this->taskRepository->getByQuery($query)
        );
    }
}
