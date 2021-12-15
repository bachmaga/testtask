<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use App\Database\TaskQuery;
use App\Entity\ValueObject\Id;
use App\Repository\TaskRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ExistValidator extends ConstraintValidator
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Exist) {
            throw new UnexpectedTypeException($constraint, Exist::class);
        }

        $result = $this->taskRepository->getByQuery(new TaskQuery(new Id($value)));

        if ($result->getTask() === null) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->addViolation();
        }
    }
}
