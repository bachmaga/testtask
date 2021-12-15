<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\DTO\RequestDTOInterface;
use App\DTO\TaskRequest;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidationRequestSubscriber implements EventSubscriberInterface
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    public function onKernelControllerArgument(ControllerArgumentsEvent $event): void
    {
        foreach ($event->getArguments() as $argument) {
            if ($argument instanceof RequestDTOInterface) {
                $violationList = $this->validator->validate($argument);

                if ($violationList->count() > 0) {
                    if ($argument instanceof TaskRequest) {
                        throw new NotFoundHttpException();
                    }

                    $errors = [];

                    foreach ($violationList as $violation) {
                        assert($violation instanceof ConstraintViolation);
                        $errors[$violation->getPropertyPath()] = $violation->getMessage();
                    }

                    throw new BadRequestHttpException(json_encode($errors));
                }
            }
        }
    }

    /**
     * @return array<string>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ControllerArgumentsEvent::class => 'onKernelControllerArgument',
        ];
    }
}
