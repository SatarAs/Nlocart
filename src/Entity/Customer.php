<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer implements UserInterface
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
    private $customerLastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $customerFirstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $customerNickname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $customerEmail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $customerPhoneHome;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $customerCellPhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $customerCompany;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $customerSiretCompany;

    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="customer")
     */
    private $addresses;

    /**
     * @ORM\ManyToOne(targetEntity=CustomerCategory::class, inversedBy="customers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customerCategory;

    /**
     * @ORM\OneToMany(targetEntity=Ordered::class, mappedBy="customer")
     */
    private $orders;

    /**
     * @ORM\OneToOne(targetEntity=Artist::class, mappedBy="customer", cascade={"persist", "remove"})
     */
    private $artist;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->orders = new ArrayCollection();
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

    public function getCustomerLastName(): ?string
    {
        return $this->customerLastName;
    }

    public function setCustomerLastName(string $customerLastName): self
    {
        $this->customerLastName = $customerLastName;

        return $this;
    }

    public function getCustomerFirstName(): ?string
    {
        return $this->customerFirstName;
    }

    public function setCustomerFirstName(string $customerFirstName): self
    {
        $this->customerFirstName = $customerFirstName;

        return $this;
    }

    public function getCustomerNickname(): ?string
    {
        return $this->customerNickname;
    }

    public function setCustomerNickname(string $customerNickname): self
    {
        $this->customerNickname = $customerNickname;

        return $this;
    }

    public function getCustomerEmail(): ?string
    {
        return $this->customerEmail;
    }

    public function setCustomerEmail(string $customerEmail): self
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getCustomerPhoneHome(): ?string
    {
        return $this->customerPhoneHome;
    }

    public function setCustomerPhoneHome(?string $customerPhoneHome): self
    {
        $this->customerPhoneHome = $customerPhoneHome;

        return $this;
    }

    public function getCustomerCellPhone(): ?string
    {
        return $this->customerCellPhone;
    }

    public function setCustomerCellPhone(string $customerCellPhone): self
    {
        $this->customerCellPhone = $customerCellPhone;

        return $this;
    }

    public function getCustomerCompany(): ?string
    {
        return $this->customerCompany;
    }

    public function setCustomerCompany(?string $customerCompany): self
    {
        $this->customerCompany = $customerCompany;

        return $this;
    }

    public function getCustomerSiretCompany(): ?string
    {
        return $this->customerSiretCompany;
    }

    public function setCustomerSiretCompany(?string $customerSiretCompany): self
    {
        $this->customerSiretCompany = $customerSiretCompany;

        return $this;
    }

    /**
     * @return Collection|Address[]
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->setCustomer($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->contains($address)) {
            $this->addresses->removeElement($address);
            // set the owning side to null (unless already changed)
            if ($address->getCustomer() === $this) {
                $address->setCustomer(null);
            }
        }

        return $this;
    }

    public function getCustomerCategory(): ?CustomerCategory
    {
        return $this->customerCategory;
    }

    public function setCustomerCategory(?CustomerCategory $customerCategory): self
    {
        $this->customerCategory = $customerCategory;

        return $this;
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
            $order->setCustomer($this);
        }

        return $this;
    }

    public function removeOrder(Ordered $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getCustomer() === $this) {
                $order->setCustomer(null);
            }
        }

        return $this;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(Artist $artist): self
    {
        $this->artist = $artist;

        // set the owning side of the relation if necessary
        if ($artist->getCustomer() !== $this) {
            $artist->setCustomer($this);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return ['ROLE_MEMBER'];
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->customerEmail;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
