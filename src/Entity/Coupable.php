<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoupableRepository")
 */
class Coupable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Suspect", inversedBy="coupable")
     */
    private $suspect;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Vetement", inversedBy="coupables")
     */
    private $vetements;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CouvreChef", inversedBy="coupables")
     */
    private $couvreChef;

    /**
     * @ORM\Column(type="integer")
     */
    private $sessionToken;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    public function __construct()
    {
        $this->suspect = new ArrayCollection();
        $this->vetements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function geSuspect(): ?suspect
    {
        return $this->suspect;
    }

    public function setsuspect(?suspect $suspect): self
    {
        $this->suspect = $suspect;

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
        }

        return $this;
    }

    public function removeVetement(Vetement $vetement): self
    {
        if ($this->vetements->contains($vetement)) {
            $this->vetements->removeElement($vetement);
        }

        return $this;
    }

    public function getCouvreChef(): ?CouvreChef
    {
        return $this->couvreChef;
    }

    public function setCouvreChef(?CouvreChef $couvreChef): self
    {
        $this->couvreChef = $couvreChef;

        return $this;
    }

    public function getSessionToken(): ?int
    {
        return $this->sessionToken;
    }

    public function setSessionToken(int $sessionToken): self
    {
        $this->sessionToken = $sessionToken;

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
}