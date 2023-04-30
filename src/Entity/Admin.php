<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
#[ORM\Table(name: '`admin`')]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $motdepasse = null;

    #[ORM\Column(nullable: true)]
    private ?int $ncin = null;

    #[ORM\Column(nullable: true)]
    private ?int $numerotelephone = null;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\OneToMany(mappedBy: 'adminrendezvous', targetEntity: RendezVous::class)]
    private Collection $Rendezvous;

    #[ORM\OneToMany(mappedBy: 'adminPatient', targetEntity: Patient::class)]
    private Collection $adminPatient;

    public function __construct()
    {
        $this->Rendezvous = new ArrayCollection();
        $this->adminPatient = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getMotdepasse(): ?string
    {
        return $this->motdepasse;
    }

    public function setMotdepasse(string $motdepasse): self
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    public function getNcin(): ?int
    {
        return $this->ncin;
    }

    public function setNcin(?int $ncin): self
    {
        $this->ncin = $ncin;

        return $this;
    }

    public function getNumerotelephone(): ?int
    {
        return $this->numerotelephone;
    }

    public function setNumerotelephone(?int $numerotelephone): self
    {
        $this->numerotelephone = $numerotelephone;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection<int, RendezVous>
     */
    public function getRendezvous(): Collection
    {
        return $this->Rendezvous;
    }

    public function addRendezvou(RendezVous $rendezvou): self
    {
        if (!$this->Rendezvous->contains($rendezvou)) {
            $this->Rendezvous->add($rendezvou);
            $rendezvou->setAdminrendezvous($this);
        }

        return $this;
    }

    public function removeRendezvou(RendezVous $rendezvou): self
    {
        if ($this->Rendezvous->removeElement($rendezvou)) {
            // set the owning side to null (unless already changed)
            if ($rendezvou->getAdminrendezvous() === $this) {
                $rendezvou->setAdminrendezvous(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Patient>
     */
    public function getAdminPatient(): Collection
    {
        return $this->adminPatient;
    }

    public function addAdminPatient(Patient $adminPatient): self
    {
        if (!$this->adminPatient->contains($adminPatient)) {
            $this->adminPatient->add($adminPatient);
            $adminPatient->setAdminPatient($this);
        }

        return $this;
    }

    public function removeAdminPatient(Patient $adminPatient): self
    {
        if ($this->adminPatient->removeElement($adminPatient)) {
            // set the owning side to null (unless already changed)
            if ($adminPatient->getAdminPatient() === $this) {
                $adminPatient->setAdminPatient(null);
            }
        }

        return $this;
    }
}
