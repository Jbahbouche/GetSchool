<?php

namespace App\Entity;

use App\Entity\Cycle;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\ManyToOne(targetEntity: Cycle::class, inversedBy: 'classes')]
    #[ORM\JoinColumn(nullable: false)]
    private $cycle_id;

    #[ORM\OneToMany(mappedBy: 'classe_id', targetEntity: User::class)]
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCycleId(): ?cycle
    {
        return $this->cycle_id;
    }

    public function setCycleId(?cycle $cycle_id): self
    {
        $this->cycle_id = $cycle_id;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setClasseId($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getClasseId() === $this) {
                $user->setClasseId(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->nom;
    }
}
