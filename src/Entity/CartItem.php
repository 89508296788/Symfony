<?php

namespace App\Entity;

use App\Repository\CartItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartItemRepository::class)]
class CartItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne]
    private ?Product $product = null;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'cartItem')]
    private Collection $cart_id;

    public function __construct()
    {
        $this->cart_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getCartId(): Collection
    {
        return $this->cart_id;
    }

    public function addCartId(Product $cartId): static
    {
        if (!$this->cart_id->contains($cartId)) {
            $this->cart_id->add($cartId);
            $cartId->setCartItem($this);
        }

        return $this;
    }

    public function removeCartId(Product $cartId): static
    {
        if ($this->cart_id->removeElement($cartId)) {
            // set the owning side to null (unless already changed)
            if ($cartId->getCartItem() === $this) {
                $cartId->setCartItem(null);
            }
        }

        return $this;
    }
}
