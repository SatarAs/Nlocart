<?php

namespace App\Entity;

use App\Repository\ArtworkCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtworkCategoryRepository::class)
 */
class ArtworkCategory
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
    private $ArtworkCategoryLabel;

    /**
     * @ORM\OneToMany(targetEntity=Artwork::class, mappedBy="artworkCategory")
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

    public function getArtworkCategoryLabel(): ?string
    {
        return $this->ArtworkCategoryLabel;
    }

    public function setArtworkCategoryLabel(string $ArtworkCategoryLabel): self
    {
        $this->ArtworkCategoryLabel = $ArtworkCategoryLabel;

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
            $artwork->setArtworkCategory($this);
        }

        return $this;
    }

    public function removeArtwork(Artwork $artwork): self
    {
        if ($this->artworks->contains($artwork)) {
            $this->artworks->removeElement($artwork);
            // set the owning side to null (unless already changed)
            if ($artwork->getArtworkCategory() === $this) {
                $artwork->setArtworkCategory(null);
            }
        }

        return $this;
    }

}
