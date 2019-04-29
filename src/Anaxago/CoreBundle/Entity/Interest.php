<?php

declare(strict_types = 1);

namespace Anaxago\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Anaxago\CoreBundle\Entity\User;
use Anaxago\CoreBundle\Entity\Project;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Interest
 *
 * @ORM\Table(name="interest",
 *    uniqueConstraints={@UniqueConstraint(name="unique_interest", columns={"user_id", "project_id"})})
 * @ORM\Entity(repositoryClass="Anaxago\CoreBundle\Repository\InterestRepository")
 */
class Interest
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="interests")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="interests")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    public function setProject(Project $project): self
    {
        $this->project = $project;

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
