<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: user::class, inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private $envoi_id;

    #[ORM\ManyToOne(targetEntity: user::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $reception_id;

    #[ORM\Column(type: 'text')]
    private $texte;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnvoiId(): ?user
    {
        return $this->envoi_id;
    }

    public function setEnvoiId(?user $envoi_id): self
    {
        $this->envoi_id = $envoi_id;

        return $this;
    }

    public function getReceptionId(): ?user
    {
        return $this->reception_id;
    }

    public function setReceptionId(?user $reception_id): self
    {
        $this->reception_id = $reception_id;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
