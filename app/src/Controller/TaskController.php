<?php

namespace App\Controller;

use App\DTO\Input\CreateTaskDto;
use App\DTO\Output\GetTaskDto;
use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TaskController extends AbstractController
{
    public function __construct(private readonly TaskRepository $repository)
    {
    }

    #[Route('/tasks', name: 'tasks.index', methods: 'GET')]
    public function index(): JsonResponse
    {
        return $this->json(array_map(fn(Task $task) => GetTaskDto::fromEntity($task), $this->repository->findAll()));
    }

    #[Route('/tasks/{id}', name: 'tasks.show', methods: 'GET')]
    public function show(Task $task): JsonResponse
    {
        return $this->json(GetTaskDto::fromEntity($task));
    }

    #[Route('/tasks', name: 'tasks.create', methods: 'POST')]
    public function store(
        #[MapRequestPayload] CreateTaskDto $dto,
        ValidatorInterface $validator
    ): JsonResponse
    {
        $errors = $validator->validate($dto);
        if (count($errors) > 0) {
            return $this->json((string) $errors, 422);
        }
        return $this->json(GetTaskDto::fromEntity($this->repository->create($dto)));
    }
}
