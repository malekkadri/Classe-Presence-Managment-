<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;



#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idClasse")]
    private ?int $idClasse = null;

    #[ORM\Column(name: "nomClasse",length: 255)]
    #[Assert\NotBlank(message: 'Veuillez saisir le nom de la classe')]
    #[Assert\Regex(
        pattern: '/^(?:[1-5][AB]|[2][ABP])(?:[1-9]|[12]\d|30)$/',
        message: 'Le format du nom de la classe n\'est pas valide.'
    )]
    private ?string $nom = null;

    #[ORM\Column(name: "nbreEtudi",length: 255)]
    #[Assert\NotBlank(message: 'Veuillez saisir le nombre de la classe')]
    private ?int $nombre = null;

    #[ORM\Column(name: "niveaux",length: 255)]
    #[Assert\NotBlank(message: 'Veuillez saisir le niveau de la classe')]
    private ?string $niveau = null;


    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez saisir la filiere de la classe')]
    private ?string $filiere = null;


    #[ORM\OneToMany(targetEntity: Presence::class, mappedBy: 'classe')]
    private Collection $presences;

    public function __construct()
    {
        $this->presences = new ArrayCollection();
    }

   

    public function getidClasse(): ?int
    {
        return $this->idClasse;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNombre(): ?int
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    

    public function __toString(): string
    {
        return $this->nom . ' (' . $this->niveau . ')';
    }

    public function getFiliere(): ?string
    {
        return $this->filiere;
    }

    public function setFiliere(string $filiere): static
    {
        $this->filiere = $filiere;

        return $this;
    }



    /**
     * @return Collection<int, Presence>
     */
    public function getPresences(): Collection
    {
        return $this->presences;
    }

    public function addPresence(Presence $presence): static
    {
        if (!$this->presences->contains($presence)) {
            $this->presences->add($presence);
            $presence->setClasse($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): static
    {
        if ($this->presences->removeElement($presence)) {
            // set the owning side to null (unless already changed)
            if ($presence->getClasse() === $this) {
                $presence->setClasse(null);
            }
        }

        return $this;
    }

  
}
