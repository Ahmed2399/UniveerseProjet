<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExerciceRepository::class)
 */
class Exercice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=ProgMuscul::class, inversedBy="exercices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $progMus;

    /**
     * @ORM\Column(type="integer")
     */
    private $repetition;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity=Exc::class, inversedBy="exercices")
     */
    private $exc;
    public function __toString() {
        return $this->nom;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getProgMus(): ?ProgMuscul
    {
        return $this->progMus;
    }

    public function setProgMus(?ProgMuscul $progMus): self
    {
        $this->progMus = $progMus;

        return $this;
    }

    public function getRepetition(): ?int
    {
        return $this->repetition;
    }

    public function setRepetition(int $repetition): self
    {
        $this->repetition = $repetition;

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

    public function getExc(): ?Exc
    {
        return $this->exc;
    }

    public function setExc(?Exc $exc): self
    {
        $this->exc = $exc;

        return $this;
    }
}
