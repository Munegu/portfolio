<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide")
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide")
     */
    private $gradeLevel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide")
     */
    private $description;

    /**
     * @ORM\Column(type="date_immutable", nullable=true)
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide")
     */
    private $startedAt;

    /**
     * @ORM\Column(type="date_immutable", nullable=true)
     */
    private $endedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $school;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getGradeLevel(): ?int
    {
        return $this->gradeLevel;
    }

    /**
     * @param int $gradeLevel
     * @return $this
     */
    public function setGradeLevel(int $gradeLevel): self
    {
        $this->gradeLevel = $gradeLevel;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getStartedAt(): ?DateTimeInterface
    {
        return $this->startedAt;
    }

    /**
     * @param DateTimeInterface $startedAt
     * @return $this
     */
    public function setStartedAt(DateTimeInterface $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getEndedAt(): ?DateTimeInterface
    {
        return $this->endedAt;
    }

    /**
     * @param DateTimeInterface $endedAt
     * @return $this
     */
    public function setEndedAt(DateTimeInterface $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    public function getSchool(): ?string
    {
        return $this->school;
    }

    public function setSchool(?string $school): self
    {
        $this->school = $school;

        return $this;
    }


}
