<?php

declare(strict_types=1);

namespace App\ArgumentResolver;

use App\DTO\TaskRequest;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class TaskRequestArgumentResolver implements ArgumentValueResolverInterface
{
    /**
     * @phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     */
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === TaskRequest::class;
    }

    /**
     * @phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     */
    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $taskRequest = new TaskRequest();
        $taskRequest->id = (int)$request->attributes->get('id', 0);

        yield $taskRequest;
    }
}
