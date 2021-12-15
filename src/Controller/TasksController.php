<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\CreateTaskRequest;
use App\DTO\EditTaskRequest;
use App\DTO\ListTaskRequest;
use App\DTO\TaskRequest;
use App\Operation\CompleteTaskOperation;
use App\Operation\CreateTaskOperation;
use App\Operation\EditTaskOperation;
use App\Operation\GetTaskOperation;
use App\Operation\ListTaskOperation;
use App\Operation\RemoveTaskOperation;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

#[Route('/tasks', name: 'api_tasks')]
final class TasksController
{
    public function __construct(
        private RouterInterface $router,
    ) {
    }

    #[Route('', name: '_list', methods: ['GET'])]
    public function tasks(ListTaskOperation $operation): JsonResponse
    {
        return new JsonResponse(
            $operation->execute(new ListTaskRequest()),
        );
    }

    #[Route('/{id}', name: '_get', methods: ['GET'])]
    public function task(TaskRequest $request, GetTaskOperation $operation): JsonResponse
    {
        return new JsonResponse(
            $operation->execute($request),
        );
    }

    #[Route('', name: '_add', methods: ['POST'])]
    public function add(CreateTaskRequest $request, CreateTaskOperation $operation): JsonResponse
    {
        $task = $operation->execute($request);

        return new JsonResponse(
            data:null,
            status: Response::HTTP_CREATED,
            headers: [
                'Location' => $this->router->generate(
                    name: 'api_tasks_get',
                    parameters: ['id' => $task->getId()->getValue()]
                ),
            ]
        );
    }

    #[Route('/{id}', name: '_edit', methods: ['PUT'])]
    public function edit(EditTaskRequest $request, EditTaskOperation $operation): JsonResponse
    {
        return new JsonResponse(data:$operation->execute($request));
    }

    #[Route('/{id}', name: '_complete', methods: ['PATCH'])]
    public function complete(TaskRequest $request, CompleteTaskOperation $operation): JsonResponse
    {
        $operation->execute($request);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/{id}', name: '_remove', methods: ['DELETE'])]
    public function remove(TaskRequest $request, RemoveTaskOperation $operation): JsonResponse
    {
        $operation->execute($request);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
