<?php declare(strict_types = 1);

namespace Anaxago\CoreBundle\Persistor;

use Anaxago\CoreBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Anaxago\CoreBundle\Dto\InterestCreateDto;
use Anaxago\CoreBundle\Factory\InterestFactory;

class InterestPersistor
{
    /** @var InterestFactory */
    private $interestFactory;

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(
        InterestFactory $interestFactory,
        EntityManagerInterface $entityManager
    ) {
        $this->interestFactory = $interestFactory;
        $this->entityManager = $entityManager;
    }

    public function createAndPersist(User $user, InterestCreateDto $interestCreateDto): int
    {
        $interest = $this->interestFactory->create($user, $interestCreateDto);
        $this->entityManager->persist($interest);
        $this->entityManager->flush();

        return $interest->getId();
    }
}
