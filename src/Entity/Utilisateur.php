<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=ProgMuscul::class, mappedBy="utilisateur")
     */
    private $progMusculs;

    /**
     * @ORM\OneToMany(targetEntity=ProgMuscul::class, mappedBy="sportif")
     */
    private $progS;

    /**
     * @ORM\OneToMany(targetEntity=ProgMuscul::class, mappedBy="coach")
     */
    private $progC;

    /**
     * @ORM\OneToMany(targetEntity=Espace::class, mappedBy="sportif")
     */
    private $espaces;

    public function __construct()
    {
        $this->progMusculs = new ArrayCollection();
        $this->progS = new ArrayCollection();
        $this->progC = new ArrayCollection();
        $this->espaces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }
    public function __toString() {
        return $this->username;
    }
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }



    public function addRoles(string $roles): self
    {
        if (!in_array($roles, $this->roles)) {
            $this->roles[] = $roles;
        }

        return $this;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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
            $progMuscul->setUtilisateur($this);
        }

        return $this;
    }

    public function removeProgMuscul(ProgMuscul $progMuscul): self
    {
        if ($this->progMusculs->removeElement($progMuscul)) {
            // set the owning side to null (unless already changed)
            if ($progMuscul->getUtilisateur() === $this) {
                $progMuscul->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProgMuscul[]
     */
    public function getProgS(): Collection
    {
        return $this->progS;
    }

    public function addProg(ProgMuscul $prog): self
    {
        if (!$this->progS->contains($prog)) {
            $this->progS[] = $prog;
            $prog->setSportif($this);
        }

        return $this;
    }

    public function removeProg(ProgMuscul $prog): self
    {
        if ($this->progS->removeElement($prog)) {
            // set the owning side to null (unless already changed)
            if ($prog->getSportif() === $this) {
                $prog->setSportif(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProgMuscul[]
     */
    public function getProgC(): Collection
    {
        return $this->progC;
    }

    public function addProgC(ProgMuscul $progC): self
    {
        if (!$this->progC->contains($progC)) {
            $this->progC[] = $progC;
            $progC->setCoach($this);
        }

        return $this;
    }

    public function removeProgC(ProgMuscul $progC): self
    {
        if ($this->progC->removeElement($progC)) {
            // set the owning side to null (unless already changed)
            if ($progC->getCoach() === $this) {
                $progC->setCoach(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Espace[]
     */
    public function getEspaces(): Collection
    {
        return $this->espaces;
    }

    public function addEspace(Espace $espace): self
    {
        if (!$this->espaces->contains($espace)) {
            $this->espaces[] = $espace;
            $espace->setSportif($this);
        }

        return $this;
    }

    public function removeEspace(Espace $espace): self
    {
        if ($this->espaces->removeElement($espace)) {
            // set the owning side to null (unless already changed)
            if ($espace->getSportif() === $this) {
                $espace->setSportif(null);
            }
        }

        return $this;
    }
}
