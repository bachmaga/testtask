<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class CreateTaskRequest implements RequestDTOInterface
{
    #[Assert\NotBlank(message: "name cannot be blank")]
    public string $name;

    #[Assert\NotBlank(message: "description cannot be blank")]
    public string $description;

    #[Assert\NotBlank(message: "expiry date cannot be blank")]
    public string $expiryDate;
}
