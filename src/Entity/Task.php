<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\ValueObject\Description;
use App\Entity\ValueObject\Id;
use App\Entity\ValueObject\Name;
use App\Entity\ValueObject\Status;
use App\Entity\ValueObject\Time;
use App\Enum\TaskStatusEnum;
use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:TaskRepository::class)]
class Task
{
    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type:"integer")]
    private ?int $id = null;

    #[ORM\Embedded(class: Name::class)]
    private Name $name;

    #[ORM\Embedded(class: Description::class)]
    private Description $description;

    #[ORM\Embedded(class: Time::class)]
    private Time $time;

    private Status $status;

    public function __construct()
    {
        $this->status = new Status(TaskStatusEnum::NEW);
    }

    public function getId(): Id
    {
        return new Id($this->id);
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }

    public function setDescription(Description $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setTime(Time $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getTime(): Time
    {
        return $this->time;
    }
}
