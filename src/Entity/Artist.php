<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtistRepository::class)
 */
class Artist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Customer::class, inversedBy="artist", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $artistBiography;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $artistWebsite;

    /**
     * @ORM\OneToMany(targetEntity=Artwork::class, mappedBy="artist")
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

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getArtistBiography(): ?string
    {
        return $this->artistBiography;
    }

    public function setArtistBiography(?string $artistBiography): self
    {
        $this->artistBiography = $artistBiography;

        return $this;
    }

    public function getArtistWebsite(): ?string
    {
        return $this->artistWebsite;
    }

    public function setArtistWebsite(?string $artistWebsite): self
    {
        $this->artistWebsite = $artistWebsite;

        return $this;
    }

    /**
     * @return Collection|ArtworkCategory[]
     */
    public function getArtworks(): Collection
    {
        return $this->artworks;
    }

    public function addArtwork(ArtworkCategory $artwork): self
    {
        if (!$this->artworks->contains($artwork)) {
            $this->artworks[] = $artwork;
            $artwork->setArtist($this);
        }

        return $this;
    }

    public function removeArtwork(ArtworkCategory $artwork): self
    {
        if ($this->artworks->contains($artwork)) {
            $this->artworks->removeElement($artwork);
            // set the owning side to null (unless already changed)
            if ($artwork->getArtist() === $this) {
                $artwork->setArtist(null);
            }
        }

        return $this;
    }
}
