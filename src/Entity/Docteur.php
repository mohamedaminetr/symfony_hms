<?php

namespace App\Entity;

use App\Repository\DocteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocteurRepository::class)]
class Docteur
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

    #[ORM\Column(nullable: true)]
    private ?int $ncin = null;

    #[ORM\Column(nullable: true)]
    private ?int $numerotelephone = null;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\Column(length: 255)]
    private ?string $motdepasse = null;

    #[ORM\Column(length: 255)]
    private ?string $specialite = null;

    #[ORM\ManyToMany(targetEntity: Patient::class)]
    private Collection $consultPatient;

    public function __construct()
    {
        $this->consultPatient = new ArrayCollection();
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

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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

    public function setAge(int $age): self
    {
        $this->age = $age;

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

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * @return Collection<int, Patient>
     */
    public function getConsultPatient(): Collection
    {
        return $this->consultPatient;
    }

    public function addConsultPatient(Patient $consultPatient): self
    {
        if (!$this->consultPatient->contains($consultPatient)) {
            $this->consultPatient->add($consultPatient);
        }

        return $this;
    }

    public function removeConsultPatient(Patient $consultPatient): self
    {
        $this->consultPatient->removeElement($consultPatient);

        return $this;
    }
}
