<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VetementRepository")
 */
class Vetement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Couleur", inversedBy="vetements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_color;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Coupable", mappedBy="vetements")
     */
    private $coupables;

    public function __construct()
    {
        $this->coupables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIdColor(): ?Couleur
    {
        return $this->id_color;
    }

    public function setIdColor(?Couleur $id_color): self
    {
        $this->id_color = $id_color;

        return $this;
    }

    /**
     * @return Collection|Coupable[]
     */
    public function getCoupables(): Collection
    {
        return $this->coupables;
    }

    public function addCoupable(Coupable $coupable): self
    {
        if (!$this->coupables->contains($coupable)) {
            $this->coupables[] = $coupable;
            $coupable->addVetement($this);
        }

        return $this;
    }

    public function removeCoupable(Coupable $coupable): self
    {
        if ($this->coupables->contains($coupable)) {
            $this->coupables->removeElement($coupable);
            $coupable->removeVetement($this);
        }

        return $this;
    }
}
