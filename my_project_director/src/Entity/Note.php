<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $score;

    #[ORM\ManyToOne(targetEntity: user::class, inversedBy: 'notes')]
    #[ORM\JoinColumn(nullable: false)]
    private $prof_id;

    #[ORM\ManyToOne(targetEntity: user::class)]
    private $etudiant_id;

    #[ORM\Column(type: 'string', length: 255)]
    private $matiere;

    #[ORM\Column(type: 'text', nullable: true)]
    private $commentaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?float
    {
        return $this->score;
    }

    public function setScore(float $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getProfId(): ?user
    {
        return $this->prof_id;
    }

    public function setProfId(?user $prof_id): self
    {
        $this->prof_id = $prof_id;

        return $this;
    }

    public function getEtudiantId(): ?user
    {
        return $this->etudiant_id;
    }

    public function setEtudiantId(?user $etudiant_id): self
    {
        $this->etudiant_id = $etudiant_id;

        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->matiere;
    }

    public function setMatiere(string $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
