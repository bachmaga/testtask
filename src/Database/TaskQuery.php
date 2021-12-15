<?php

declare(strict_types=1);

namespace App\Database;

use App\Entity\ValueObject\Id;
use App\Entity\ValueObject\Time;

class TaskQuery
{
    public function __construct(private Id|null $id = null, private Time|null $time = null)
    {
    }

    public function getId(): Id|null
    {
        return $this->id;
    }

    public function getTime(): Time|null
    {
        return $this->time;
    }
}
