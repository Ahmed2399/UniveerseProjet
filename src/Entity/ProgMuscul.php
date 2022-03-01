<?php

namespace App\Entity;

use App\Repository\ProgMusculRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgMusculRepository::class)
 */
class ProgMuscul
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Exercice::class, mappedBy="progMus")
     */
    private $exercices;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity=Espace::class, inversedBy="progMusculs")
     */
    private $espace;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="progS")
     */
    private $sportif;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="progC")
     */
    private $coach;

    

    public function __construct()
    {
        $this->exercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Exercice[]
     */
    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercice $exercice): self
    {
        if (!$this->exercices->contains($exercice)) {
            $this->exercices[] = $exercice;
            $exercice->setProgMus($this);
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): self
    {
        if ($this->exercices->removeElement($exercice)) {
            // set the owning side to null (unless already changed)
            if ($exercice->getProgMus() === $this) {
                $exercice->setProgMus(null);
            }
        }

        return $this;
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

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getEspace(): ?Espace
    {
        return $this->espace;
    }

    public function setEspace(?Espace $espace): self
    {
        $this->espace = $espace;

        return $this;
    }

    public function getSportif(): ?Utilisateur
    {
        return $this->sportif;
    }

    public function setSportif(?Utilisateur $sportif): self
    {
        $this->sportif = $sportif;

        return $this;
    }

    public function getCoach(): ?Utilisateur
    {
        return $this->coach;
    }

    public function setCoach(?Utilisateur $coach): self
    {
        $this->coach = $coach;

        return $this;
    }

    
}
