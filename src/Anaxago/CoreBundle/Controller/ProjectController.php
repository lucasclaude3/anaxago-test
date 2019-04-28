<?php declare(strict_types = 1);

namespace Anaxago\CoreBundle\Controller;

use Anaxago\CoreBundle\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class ProjectController
 *
 * @package Anaxago\CoreBundle\Controller
 */
class ProjectController extends Controller
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var NormalizerInterface */
    private $normalizer;

    public function __construct(
        EntityManagerInterface $entityManager,
        NormalizerInterface $normalizer
    ) {
        $this->entityManager = $entityManager;
        $this->normalizer = $normalizer;
    }

    public function getAction(): JsonResponse
    {
        $projects = $this->entityManager->getRepository(Project::class)->findAll();

        return new JsonResponse($this->normalizer->normalize($projects, 'json'));
    }
}
