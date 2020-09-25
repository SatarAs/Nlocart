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
     * @ORM\Column(type="string", length=255)
     */
    private $artistLastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artistFirstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artistNickname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artistEmail;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $artistBiography;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $artistPhoneHome;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $artistCellPhone;

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

    public function getArtistLastName(): ?string
    {
        return $this->artistLastName;
    }

    public function setArtistLastName(string $artistLastName): self
    {
        $this->artistLastName = $artistLastName;

        return $this;
    }

    public function getArtistFirstName(): ?string
    {
        return $this->artistFirstName;
    }

    public function setArtistFirstName(string $artistFirstName): self
    {
        $this->artistFirstName = $artistFirstName;

        return $this;
    }

    public function getArtistNickname(): ?string
    {
        return $this->artistNickname;
    }

    public function setArtistNickname(string $artistNickname): self
    {
        $this->artistNickname = $artistNickname;

        return $this;
    }

    public function getArtistEmail(): ?string
    {
        return $this->artistEmail;
    }

    public function setArtistEmail(string $artistEmail): self
    {
        $this->artistEmail = $artistEmail;

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

    public function getArtistPhoneHome(): ?string
    {
        return $this->artistPhoneHome;
    }

    public function setArtistPhoneHome(?string $artistPhoneHome): self
    {
        $this->artistPhoneHome = $artistPhoneHome;

        return $this;
    }

    public function getArtistCellPhone(): ?string
    {
        return $this->artistCellPhone;
    }

    public function setArtistCellPhone(string $artistCellPhone): self
    {
        $this->artistCellPhone = $artistCellPhone;

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
