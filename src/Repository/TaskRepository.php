<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\TaskQuery;
use App\Database\TaskResult;
use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<Task> findAll()
 * @method array<Task> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function save(Task $task): void
    {
        $this->_em->persist($task);
        $this->_em->flush();
    }

    public function getByQuery(TaskQuery $taskQuery): TaskResult
    {
        $qb = $this->createQueryBuilder('t');

        if ($taskQuery->getId() !== null) {
            $qb->andWhere(
                $qb->expr()->eq('t.id', ':id')
            )->setParameter('id', $taskQuery->getId()->getValue());
        }

        return new TaskResult($qb->getQuery()->toIterable());
    }
}
