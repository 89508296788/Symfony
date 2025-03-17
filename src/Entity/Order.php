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

    #[ORM\ManyToOne(targetEntity: Cart::class, inversedBy: 'orders')]
    private ?Cart $cart = null;

    /**
     * @var Collection<int, Client>
     */
    #[ORM\OneToMany(targetEntity: Client::class, mappedBy: 'client_order')]
    private Collection $client_id;

    public function __construct()
    {
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

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): static
    {
        $this->cart = $cart;

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
