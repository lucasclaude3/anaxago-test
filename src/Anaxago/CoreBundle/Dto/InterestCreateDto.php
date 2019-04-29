<?php declare(strict_types = 1);

namespace Anaxago\CoreBundle\Dto;

use Symfony\Component\Serializer\Annotation\Groups;

class InterestCreateDto
{
    /** @var int
     * @Groups({"interestCreateDto"})
    */
    private $projectId;

    /** @var int
     * @Groups({"interestCreateDto"})
    */
    private $amount;

    public function getProjectId(): int
    {
        return $this->projectId;
    }

    public function setProjectId(int $projectId): self
    {
        $this->projectId = $projectId;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
