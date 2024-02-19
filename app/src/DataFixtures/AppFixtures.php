<?php

namespace App\DataFixtures;

use App\Entity\Enums\TaskStatusEnum;
use App\Entity\TaskStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (TaskStatusEnum::cases() as $case) {
            $status = $manager->getRepository(TaskStatus::class)->find($case->value);
            if ($status === null) {
                $status = new TaskStatus();
            }
            $status->setTitle($case->getName());
            $manager->persist($status);
        }
        $manager->flush();
    }
}
