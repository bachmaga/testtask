<?php

declare(strict_types=1);

namespace App\Database;

use App\Entity\Task;
use Generator;

class TaskResult
{
    public function __construct(private Generator|iterable $collection)
    {
    }

    public function getTask(): Task|null
    {
        return $this->collection->current();
    }

    /**
     * @return iterable<Task>
     */
    public function getTasks(): iterable
    {
        return $this->collection;
    }
}
