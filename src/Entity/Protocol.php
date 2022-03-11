<?php

namespace App\Entity;

use App\Repository\ProtocolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProtocolRepository::class)
 */
class Protocol
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Raport::class, mappedBy="protocol")
     */
    private $raports;

    /**
     * @ORM\OneToMany(targetEntity=Demande::class, mappedBy="protocol")
     */
    private $demandes;

    public function __construct()
    {
        $this->raports = new ArrayCollection();
        $this->demandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection<int, Raport>
     */
    public function getRaports(): Collection
    {
        return $this->raports;
    }

    public function addRaport(Raport $raport): self
    {
        if (!$this->raports->contains($raport)) {
            $this->raports[] = $raport;
            $raport->setProtocol($this);
        }

        return $this;
    }

    public function removeRaport(Raport $raport): self
    {
        if ($this->raports->removeElement($raport)) {
            // set the owning side to null (unless already changed)
            if ($raport->getProtocol() === $this) {
                $raport->setProtocol(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes[] = $demande;
            $demande->setProtocol($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getProtocol() === $this) {
                $demande->setProtocol(null);
            }
        }

        return $this;
    }
}
