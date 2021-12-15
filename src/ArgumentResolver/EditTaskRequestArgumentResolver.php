<?php

declare(strict_types=1);

namespace App\ArgumentResolver;

use App\DTO\EditTaskRequest;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;

class EditTaskRequestArgumentResolver implements ArgumentValueResolverInterface
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    /**
     * @phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     */
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === EditTaskRequest::class;
    }

    /**
     * @phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     */
    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $editRequest = $this->serializer->deserialize(
            $request->getContent(),
            EditTaskRequest::class,
            'json',
        );

        $editRequest->id = (int)$request->attributes->get('id', 0);

        yield $editRequest;
    }
}
