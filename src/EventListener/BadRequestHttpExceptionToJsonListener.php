<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class BadRequestHttpExceptionToJsonListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();

        if ($throwable instanceof BadRequestHttpException) {
            $event->setResponse(
                new JsonResponse(
                    data: $throwable->getMessage(),
                    status: Response::HTTP_BAD_REQUEST,
                    json: true,
                )
            );
        }

        if ($throwable->getCode() !== 0) {
            $event->setResponse(
                new JsonResponse(
                    data: $throwable->getMessage(),
                    status: $throwable->getCode(),
                )
            );
        }
    }
}
