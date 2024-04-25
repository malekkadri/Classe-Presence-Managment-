<?php

namespace App\Entity;

use App\Repository\PresenceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Validator\Constraints\IsOnTheHour;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: PresenceRepository::class)]
class Presence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"idPresence")]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[IsOnTheHour]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $date = null;
    
    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez saisir la seance de la classe')]
    private ?string $seance = null;

    #[ORM\ManyToOne(inversedBy: 'presences')]
    #[ORM\JoinColumn(name: "idClasse", referencedColumnName: "idClasse")]
    private ?Classe $classe = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self {
        $this->date = $date;
        return $this;
    }
    


    public function getSeance(): ?string
    {
        return $this->seance;
    }

    public function setSeance(string $seance): static
    {
        $this->seance = $seance;

        return $this;
    }

 
    

    public function __toString(): string
    {
        return $this->seance . ' on ' . $this->date->format('Y-m-d');
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }
}
