<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    /**
     * @var Collection<int, Cart>
     */
    #[ORM\OneToMany(targetEntity: Cart::class, mappedBy: '��order')]
    private Collection $cart_id;

    /**
     * @var Collection<int, Client>
     */
    #[ORM\OneToMany(targetEntity: Client::class, mappedBy: 'client_order')]
    private Collection $client_id;

    public function __construct()
    {
        $this->cart_id = new ArrayCollection();
        $this->client_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Cart>
     */
    public function getCartId(): Collection
    {
        return $this->cart_id;
    }

    public function addCartId(Cart $cartId): static
    {
        if (!$this->cart_id->contains($cartId)) {
            $this->cart_id->add($cartId);
            $cartId->setorder($this);
        }

        return $this;
    }

    public function removeCartId(Cart $cartId): static
    {
        if ($this->cart_id->removeElement($cartId)) {
            // set the owning side to null (unless already changed)
            if ($cartId->getorder() === $this) {
                $cartId->setorder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClientId(): Collection
    {
        return $this->client_id;
    }

    public function addClientId(Client $clientId): static
    {
        if (!$this->client_id->contains($clientId)) {
            $this->client_id->add($clientId);
            $clientId->setClientOrder($this);
        }

        return $this;
    }

    public function removeClientId(Client $clientId): static
    {
        if ($this->client_id->removeElement($clientId)) {
            // set the owning side to null (unless already changed)
            if ($clientId->getClientOrder() === $this) {
                $clientId->setClientOrder(null);
            }
        }

        return $this;
    }
}
