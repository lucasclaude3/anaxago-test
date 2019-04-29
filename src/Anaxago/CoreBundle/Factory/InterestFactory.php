<?php declare(strict_types = 1);

namespace Anaxago\CoreBundle\Factory;

use Anaxago\CoreBundle\Entity\User;
use Anaxago\CoreBundle\Entity\Project;
use Anaxago\CoreBundle\Entity\Interest;
use Doctrine\ORM\EntityManagerInterface;
use Anaxago\CoreBundle\Dto\InterestCreateDto;

class InterestFactory
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function create(User $user, InterestCreateDto $interestCreateDto): Interest
    {
        $project = $this->entityManager->getRepository(Project::class)->find($interestCreateDto->getProjectId());

        $interest = new Interest();
        $interest->setUser($user)
            ->setProject($project)
            ->setAmount($interestCreateDto->getAmount());
        
        return $interest;
    }
}
