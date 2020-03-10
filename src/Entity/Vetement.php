<?php

namespace App\Entity;

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
}
