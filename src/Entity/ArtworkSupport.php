<?php

namespace App\Entity;

use App\Repository\ArtworkSupportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtworkSupportRepository::class)
 */
class ArtworkSupport
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
    private $artworkSupportLabel;

    /**
     * @ORM\OneToMany(targetEntity=Artwork::class, mappedBy="artworkSupport")
     */
    private $artworks;

    public function __construct()
    {
        $this->artworks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getArtworkSupportLabel(): ?string
    {
        return $this->artworkSupportLabel;
    }

    public function setArtworkSupportLabel(string $artworkSupportLabel): self
    {
        $this->artworkSupportLabel = $artworkSupportLabel;

        return $this;
    }

    /**
     * @return Collection|Artwork[]
     */
    public function getArtworks(): Collection
    {
        return $this->artworks;
    }

    public function addArtwork(Artwork $artwork): self
    {
        if (!$this->artworks->contains($artwork)) {
            $this->artworks[] = $artwork;
            $artwork->setArtworkSupport($this);
        }

        return $this;
    }

    public function removeArtwork(Artwork $artwork): self
    {
        if ($this->artworks->contains($artwork)) {
            $this->artworks->removeElement($artwork);
            // set the owning side to null (unless already changed)
            if ($artwork->getArtworkSupport() === $this) {
                $artwork->setArtworkSupport(null);
            }
        }

        return $this;
    }
}
