<?php

declare(strict_types=1);

namespace App\Dbal\Type;

use Acelaya\Doctrine\Type\PhpEnumType;
use App\Enum\TaskStatusEnum;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use UnitEnum;

class StatusEnumType extends PhpEnumType
{
    public function getName(): string
    {
        return 'task_status';
    }
    
    /**
     * @param array<string, mixed> $fieldDeclaration
     * @psalm-suppress ParamNameMismatch
     * @phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        $enums = array_map(
            fn(UnitEnum $value): string => sprintf("'%s'", $value->value),
            TaskStatusEnum::cases()
        );

        return "ENUM(" . implode(',', $enums) . ")";
    }
}
