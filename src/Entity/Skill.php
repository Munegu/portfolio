<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
class Skill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide")
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide")
     * @Assert\Range(min=1,
     *      max= 10,
     *      minMessage="Le niveau doit être supérieur ou égal à 1",
     *      maxMessage="Le niveau doit être inférieur ou égal à 10")
     */
    private $level;

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
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }

    /**
     * @param int|null $level
     * @return $this
     */
    public function setLevel(?int $level): self
    {
        $this->level = $level;

        return $this;
    }
}
