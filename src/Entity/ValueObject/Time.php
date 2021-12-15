<?php

declare(strict_types=1);

namespace App\Entity\ValueObject;

use DateInterval;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable()]
class Time
{
    #[ORM\Column(type:'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type:'datetime_immutable', nullable: true)]
    private DateTimeImmutable|null $expiredAt = null;

    public function __construct(DateTimeImmutable $createdAt, ?DateTimeImmutable $expiredAt = null)
    {
        $this->createdAt = $createdAt;
        $this->expiredAt = $expiredAt;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getExpiredAt(): DateTimeImmutable|null
    {
        return $this->expiredAt;
    }

    public function getDuration(): DateInterval
    {
        return $this->getExpiredAt()->diff($this->getCreatedAt());
    }
}
