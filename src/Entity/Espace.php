<?php

namespace App\Entity;

use App\Repository\EspaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EspaceRepository::class)
 */
class Espace
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
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\OneToMany(targetEntity=ProgMuscul::class, mappedBy="espace")
     */
    private $progMusculs;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="espaces")
     */
    private $sportif;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="espaces")
     */
    private $coach;

    public function __construct()
    {
        $this->progMusculs = new ArrayCollection();
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

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return Collection|ProgMuscul[]
     */
    public function getProgMusculs(): Collection
    {
        return $this->progMusculs;
    }

    public function addProgMuscul(ProgMuscul $progMuscul): self
    {
        if (!$this->progMusculs->contains($progMuscul)) {
            $this->progMusculs[] = $progMuscul;
            $progMuscul->setEspace($this);
        }

        return $this;
    }

    public function removeProgMuscul(ProgMuscul $progMuscul): self
    {
        if ($this->progMusculs->removeElement($progMuscul)) {
            // set the owning side to null (unless already changed)
            if ($progMuscul->getEspace() === $this) {
                $progMuscul->setEspace(null);
            }
        }

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
