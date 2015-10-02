<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cart
 *
 * @ORM\Table(name="cart", indexes={@ORM\Index(name="products", columns={"products"}), @ORM\Index(name="customer", columns={"customer"})})
 * @ORM\Entity
 */
class Cart
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="jumlah", type="integer", nullable=false)
     */
    private $jumlah;

    /**
     * @var \Product
     *
     * @ORM\ManyToOne(targetEntity="Product",inversedBy="carts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="products", referencedColumnName="id")
     * })
     */
    private $products;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="UsersBundle\Entity\User",inversedBy="carts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer", referencedColumnName="id")
     * })
     */
    private $customer;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set jumlah
     *
     * @param integer $jumlah
     *
     * @return Cart
     */
    public function setJumlah($jumlah)
    {
        $this->jumlah = $jumlah;

        return $this;
    }

    /**
     * Get jumlah
     *
     * @return integer
     */
    public function getJumlah()
    {
        return $this->jumlah;
    }

    /**
     * Set products
     *
     * @param \ProductBundle\Entity\Product $products
     *
     * @return Cart
     */
    public function setProducts(\ProductBundle\Entity\Product $products = null)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * Get products
     *
     * @return \ProductBundle\Entity\Product
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set customer
     *
     * @param \ProductBundle\Entity\Users $customer
     *
     * @return Cart
     */
    public function setCustomer(\UsersBundle\Entity\User $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \ProductBundle\Entity\Users
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
