<?php

declare(strict_types=1);

namespace Anaxago\CoreBundle\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class DataTransferObjectConverter implements ParamConverterInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $data = $request->getContent();
        $class = $configuration->getClass();
        $options = $configuration->getOptions();
        $context = [
            ObjectNormalizer::ALLOW_EXTRA_ATTRIBUTES => false,
        ];
        if (isset($options['groups'])) {
            $context = [
                'groups' => $options['groups'],
            ];
        }

        $dto = $this->serializer->deserialize($data, $class, 'json', $context);

        if (null !== $dto) {
            $request->attributes->set($configuration->getName(), $dto);

            return true;
        }

        return false;
    }

    public function supports(ParamConverter $configuration): bool
    {
        $class = $configuration->getClass();

        return null !== $class && \class_exists($class) && 0 === \mb_strpos($class, 'Anaxago\CoreBundle\Dto\\');
    }
}
