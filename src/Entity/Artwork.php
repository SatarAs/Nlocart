<?php

namespace App\Entity;

use App\Repository\ArtworkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtworkRepository::class)
 */
class Artwork
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
    private $artworkName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $artworkPicture;

    /**
     * @ORM\Column(type="date")
     */
    private $artworkCreationDate;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $artworkHeight;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $artworkWidth;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $artworkDepth;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $artworkWeight;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $artworkSalePrice;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $artworkRentalPrice;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $artworkDescription;

    /**
     * @ORM\Column(type="boolean")
     */
    private $artworkAvailability;

    /**
     * @ORM\Column(type="boolean")
     */
    private $artworkSpecial;

    /**
     * @ORM\ManyToOne(targetEntity=ArtworkCategory::class, inversedBy="artworks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artworkCategory;

    /**
     * @ORM\ManyToOne(targetEntity=Artist::class, inversedBy="artworks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artist;

    /**
     * @ORM\ManyToOne(targetEntity=ArtworkSupport::class, inversedBy="artworks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artworkSupport;

    /**
     * @ORM\OneToMany(targetEntity=TechArtwork::class, mappedBy="artwork")
     */
    private $techArtworks;

    /**
     * @ORM\OneToMany(targetEntity=Ordered::class, mappedBy="artwork")
     */
    private $orders;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->techArtworks = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
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

    public function getArtworkName(): ?string
    {
        return $this->artworkName;
    }

    public function setArtworkName(string $artworkName): self
    {
        $this->artworkName = $artworkName;

        return $this;
    }

    public function getArtworkPicture(): ?string
    {
        return $this->artworkPicture;
    }

    public function setArtworkPicture(string $artworkPicture): self
    {
        $this->artworkPicture = $artworkPicture;

        return $this;
    }

    public function getArtworkCreationDate(): ?\DateTimeInterface
    {
        return $this->artworkCreationDate;
    }

    public function setArtworkCreationDate(\DateTimeInterface $artworkCreationDate): self
    {
        $this->artworkCreationDate = $artworkCreationDate;

        return $this;
    }

    public function getArtworkHeight(): ?float
    {
        return $this->artworkHeight;
    }

    public function setArtworkHeight(?float $artworkHeight): self
    {
        $this->artworkHeight = $artworkHeight;

        return $this;
    }

    public function getArtworkWidth(): ?float
    {
        return $this->artworkWidth;
    }

    public function setArtworkWidth(?float $artworkWidth): self
    {
        $this->artworkWidth = $artworkWidth;

        return $this;
    }

    public function getArtworkDepth(): ?float
    {
        return $this->artworkDepth;
    }

    public function setArtworkDepth(?float $artworkDepth): self
    {
        $this->artworkDepth = $artworkDepth;

        return $this;
    }

    public function getArtworkWeight(): ?float
    {
        return $this->artworkWeight;
    }

    public function setArtworkWeight(?float $artworkWeight): self
    {
        $this->artworkWeight = $artworkWeight;

        return $this;
    }

    public function getArtworkSalePrice(): ?float
    {
        return $this->artworkSalePrice;
    }

    public function setArtworkSalePrice(?float $artworkSalePrice): self
    {
        $this->artworkSalePrice = $artworkSalePrice;

        return $this;
    }

    public function getArtworkRentalPrice(): ?float
    {
        return $this->artworkRentalPrice;
    }

    public function setArtworkRentalPrice(?float $artworkRentalPrice): self
    {
        $this->artworkRentalPrice = $artworkRentalPrice;

        return $this;
    }

    public function getArtworkDescription(): ?string
    {
        return $this->artworkDescription;
    }

    public function setArtworkDescription(?string $artworkDescription): self
    {
        $this->artworkDescription = $artworkDescription;

        return $this;
    }

    public function getArtworkAvailability(): ?bool
    {
        return $this->artworkAvailability;
    }

    public function setArtworkAvailability(bool $artworkAvailability): self
    {
        $this->artworkAvailability = $artworkAvailability;

        return $this;
    }

    public function getArtworkSpecial(): ?bool
    {
        return $this->artworkSpecial;
    }

    public function setArtworkSpecial(bool $artworkSpecial): self
    {
        $this->artworkSpecial = $artworkSpecial;

        return $this;
    }

    public function getArtworkCategory(): ?ArtworkCategory
    {
        return $this->artworkCategory;
    }

    public function setArtworkCategory(?ArtworkCategory $artworkCategory): self
    {
        $this->artworkCategory = $artworkCategory;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArtist() {
        return $this->artist;
    }

    /**
     * @param mixed $artist
     */
    public function setArtist( $artist ) {
        $this->artist = $artist;
    }

    public function getArtworkSupport(): ?ArtworkSupport
    {
        return $this->artworkSupport;
    }

    public function setArtworkSupport(?ArtworkSupport $artworkSupport): self
    {
        $this->artworkSupport = $artworkSupport;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTechArtworks(): ArrayCollection
    {
        return $this->techArtworks;
    }

    /**
     * @param ArrayCollection $techArtworks
     */
    public function setTechArtworks(ArrayCollection $techArtworks): void
    {
        $this->techArtworks = $techArtworks;
    }

    /**
     * @return Collection|Ordered[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Ordered $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setArtwork($this);
        }

        return $this;
    }

    public function removeOrder(Ordered $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getArtwork() === $this) {
                $order->setArtwork(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

}