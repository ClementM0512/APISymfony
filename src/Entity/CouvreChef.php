<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CouvreChefRepository")
 */
class CouvreChef
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coupable", mappedBy="couvreChef")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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
            $coupable->setCouvreChef($this);
        }

        return $this;
    }

    public function removeCoupable(Coupable $coupable): self
    {
        if ($this->coupables->contains($coupable)) {
            $this->coupables->removeElement($coupable);
            // set the owning side to null (unless already changed)
            if ($coupable->getCouvreChef() === $this) {
                $coupable->setCouvreChef(null);
            }
        }

        return $this;
    }
}
