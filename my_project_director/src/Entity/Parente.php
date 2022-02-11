<?php

namespace App\Entity;

use App\Repository\ParenteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParenteRepository::class)]
class Parente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'parente', targetEntity: User::class, cascade: ['persist', 'remove'])]
    private $enfant;

    #[ORM\OneToOne(targetEntity: User::class, cascade: ['persist', 'remove'])]
    private $parent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnfant(): ?User
    {
        return $this->enfant;
    }

    public function setEnfant(?User $enfant): self
    {
        $this->enfant = $enfant;

        return $this;
    }

    public function getParent(): ?User
    {
        return $this->parent;
    }

    public function setParent(?User $parent): self
    {
        $this->parent = $parent;

        return $this;
    }
}
