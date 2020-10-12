<?php

namespace App\Entity;

use App\Repository\OrderedRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderedRepository::class)
 */
class Ordered
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $orderNumber;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $orderType;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $orderReservationStartDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $orderReservationEndDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $orderDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $orderStatus;

    /**
     * @ORM\Column(type="boolean")
     */
    private $orderRental;

    /**
     * @ORM\Column(type="boolean")
     */
    private $decision;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity=Artwork::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artwork;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderNumber(): ?int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getOrderType(): ?bool
    {
        return $this->orderType;
    }

    public function setOrderType(?bool $orderType): self
    {
        $this->orderType = $orderType;

        return $this;
    }

    public function getOrderReservationStartDate(): ?\DateTimeInterface
    {
        return $this->orderReservationStartDate;
    }

    public function setOrderReservationStartDate(?\DateTimeInterface $orderReservationStartDate): self
    {
        $this->orderReservationStartDate = $orderReservationStartDate;

        return $this;
    }

    public function getOrderReservationEndDate(): ?\DateTimeInterface
    {
        return $this->orderReservationEndDate;
    }

    public function setOrderReservationEndDate(?\DateTimeInterface $orderReservationEndDate): self
    {
        $this->orderReservationEndDate = $orderReservationEndDate;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getOrderStatus(): ?bool
    {
        return $this->orderStatus;
    }

    public function setOrderStatus(bool $orderStatus): self
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

    public function getOrderRental(): ?bool
    {
        return $this->orderRental;
    }

    public function setOrderRental(bool $orderRental): self
    {
        $this->orderRental = $orderRental;

        return $this;
    }

    public function getDecision() {
        return $this->decision;
    }

    public function setDecision( $decision ) {
        $this->decision = $decision;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
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
}
