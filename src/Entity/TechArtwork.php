<?php

namespace App\Entity;

use App\Repository\TechArtworkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TechArtworkRepository::class)
 */
class TechArtwork
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Artwork::class, inversedBy="techArtworks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artwork;

    /**
     * @ORM\ManyToOne(targetEntity=ArtworkTechnical::class, inversedBy="techArtworks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artworkTechnical;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getArtwork(): ?Artwork
    {
        return $this->artwork;
    }

    public function setArtwork(?Artwork $artwork): self
    {
        $this->artwork = $artwork;

        return $this;
    }

    public function getArtworkTechnical(): ?ArtworkTechnical
    {
        return $this->artworkTechnical;
    }

    public function setArtworkTechnical(?ArtworkTechnical $artworkTechnical): self
    {
        $this->artworkTechnical = $artworkTechnical;

        return $this;
    }
}
