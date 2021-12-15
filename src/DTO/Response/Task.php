<?php

declare(strict_types=1);

namespace App\DTO\Response;

class Task
{
    public int $id;

    public string $name;

    public string $description;

    public string $createdAt;

    public string $expiredAt;
}
