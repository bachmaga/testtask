<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Database\TaskResult;
use App\DTO\Response\ListTask;

class ListTaskMapper
{
    public function __construct(private TaskMapper $taskMapper)
    {
    }

    public function toDto(TaskResult $result): object
    {
        $list = new ListTask();

        foreach ($result->getTasks() as $task) {
            $list->tasks[] = $this->taskMapper->toDto($task);
        }

        return $list;
    }
}
