<?php

namespace App\Entity\Enums;

enum TaskStatusEnum: int
{
    case Open = 1;
    case InProgress = 2;
    case InReview = 3;
    case Done = 4;

    public function getName(): string
    {
        return match ($this->value) {
            TaskStatusEnum::Open->value => 'Open',
            TaskStatusEnum::InProgress->value => 'In progress',
            TaskStatusEnum::InReview->value => 'In review',
            TaskStatusEnum::Done->value => 'Done',
            default => '',
        };
    }
}
