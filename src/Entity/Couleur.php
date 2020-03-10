<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CouleurRepository")
 */
class Couleur
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
    private $color_name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vetement", mappedBy="id_color")
     */
    private $vetements;

    public function __construct()
    {
        $this->vetements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColorName(): ?string
    {
        return $this->color_name;
    }

    public function setColorName(?string $color_name): self
    {
        $this->color_name = $color_name;

        return $this;
    }

    /**
     * @return Collection|Vetement[]
     */
    public function getVetements(): Collection
    {
        return $this->vetements;
    }

    public function addVetement(Vetement $vetement): self
    {
        if (!$this->vetements->contains($vetement)) {
            $this->vetements[] = $vetement;
            $vetement->setIdColor($this);
        }

        return $this;
    }

    public function removeVetement(Vetement $vetement): self
    {
        if ($this->vetements->contains($vetement)) {
            $this->vetements->removeElement($vetement);
            // set the owning side to null (unless already changed)
            if ($vetement->getIdColor() === $this) {
                $vetement->setIdColor(null);
            }
        }

        return $this;
    }
}
