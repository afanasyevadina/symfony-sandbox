<?php

namespace App\DTO\Output;

use App\Entity\Task;

class GetTaskDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly ?string $description,
        public readonly ?string $deadline,
        public readonly ?string $status,
    )
    {
    }

    public static function fromEntity(Task $task) : static
    {
        return new static(
            id: $task->getId(),
            title: $task->getTitle(),
            description: $task->getDescription(),
            deadline: $task->getDeadline()?->format('c'),
            status: $task->getStatus()?->getTitle()
        );
    }
}