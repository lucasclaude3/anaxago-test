<?php declare(strict_types = 1);

namespace Anaxago\CoreBundle\Controller;

use Anaxago\CoreBundle\Entity\User;
use Anaxago\CoreBundle\Entity\Interest;
use Doctrine\ORM\EntityManagerInterface;
use Anaxago\CoreBundle\Dto\InterestCreateDto;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Anaxago\CoreBundle\Persistor\InterestPersistor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class InterestController
 *
 * @package Anaxago\CoreBundle\Controller
 */
class InterestController extends Controller
{
    /** @var NormalizerInterface */
    private $normalizer;

    /** @var TokenStorageInterface */
    private $tokenStorage;

    /** @var InterestPersistor */
    private $interestPersistor;

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(
        NormalizerInterface $normalizer,
        TokenStorageInterface $tokenStorage,
        InterestPersistor $interestPersistor,
        EntityManagerInterface $entityManager
    ) {
        $this->normalizer = $normalizer;
        $this->tokenStorage = $tokenStorage;
        $this->interestPersistor = $interestPersistor;
        $this->entityManager = $entityManager;
    }

    /** @ParamConverter("interestCreateDto", options={"groups"={"interestCreateDto"}}) */
    public function postAction(InterestCreateDto $interestCreateDto = null): JsonResponse
    {
        if (null === $interestCreateDto) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, 'Request body format is wrong');
        }

        $user = $this->tokenStorage->getToken()->getUser();
        if (!$user instanceof User) {
            throw new HttpException(Response::HTTP_UNAUTHORIZED);
        }
        
        try {
            $interestId = $this->interestPersistor->createAndPersist($user, $interestCreateDto);
        } catch (UniqueConstraintViolationException $e) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, 'An interest corresponding to this userId and projectId already exists');
        }

        return new JsonResponse([
            'content' => [
                'id' => $interestId,
            ],
        ], Response::HTTP_CREATED);
    }
}
