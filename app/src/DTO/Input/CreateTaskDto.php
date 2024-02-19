<?php

namespace App\DTO\Input;
use Symfony\Component\Validator\Constraints as Assert;

class CreateTaskDto
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $title,
        public readonly ?string $description,
        #[Assert\DateTime]
        public readonly ?string $deadline,
    )
    {
    }
}