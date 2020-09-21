<?php

namespace App\Entity;

use App\Repository\ArtworkTechnicalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtworkTechnicalRepository::class)
 */
class ArtworkTechnical
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
    private $artworkTechnicalLabel;

    /**
     * @ORM\OneToMany(targetEntity=TechArtwork::class, mappedBy="ArtworkTechnical")
     */
    private $techArtworks;

    public function __construct()
    {
        $this->techArtworks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtworkTechnicalLabel(): ?string
    {
        return $this->artworkTechnicalLabel;
    }

    public function setArtworkTechnicalLabel(string $artworkTechnicalLabel): self
    {
        $this->artworkTechnicalLabel = $artworkTechnicalLabel;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTechArtworks() {
        return $this->techArtworks;
    }

    /**
     * @param mixed $techArtworks
     */
    public function setTechOeuvres( $techArtworks ) {
        $this->techArtworks = $techArtworks;
    }

}
