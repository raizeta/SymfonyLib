<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Product
 *
 * @ORM\Table(name="product", indexes={@ORM\Index(name="category_product", columns={"product_category"}), @ORM\Index(name="product_brand", columns={"product_brand"})})
 * @ORM\Entity
 */
class Product
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
     * @var string
     *
     * @ORM\Column(name="nama", type="string", length=50, nullable=false)
     */
    private $nama;

    /**
     * @var string
     *
     * @ORM\Column(name="image_name", type="string", length=50, nullable=true)
     */
    private $imageName;
    /**
     * @var integer
     *
     * @ORM\Column(name="harga", type="integer", nullable=false)
     */
    private $harga;

    /**
     * @var \ProductCategory
     *
     * @ORM\ManyToOne(targetEntity="ProductCategory",inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_category", referencedColumnName="id")
     * })
     */
    private $productCategory;

    /**
     * @var \ProductBrand
     *
     * @ORM\ManyToOne(targetEntity="ProductBrand",inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_brand", referencedColumnName="id")
     * })
     */
    private $productBrand;

    /**
     * @ORM\OneToMany(targetEntity="Cart", mappedBy="products")
     */
    protected $carts;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->carts = new ArrayCollection();
    }


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
     * Set nama
     *
     * @param string $nama
     *
     * @return Product
     */
    public function setNama($nama)
    {
        $this->nama = $nama;

        return $this;
    }

    /**
     * Get nama
     *
     * @return string
     */
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Product
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set harga
     *
     * @param integer $harga
     *
     * @return Product
     */
    public function setHarga($harga)
    {
        $this->harga = $harga;

        return $this;
    }

    /**
     * Get harga
     *
     * @return integer
     */
    public function getHarga()
    {
        return $this->harga;
    }

    /**
     * Set productCategory
     *
     * @param \ProductBundle\Entity\ProductCategory $productCategory
     *
     * @return Product
     */
    public function setProductCategory(\ProductBundle\Entity\ProductCategory $productCategory = null)
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    /**
     * Get productCategory
     *
     * @return \ProductBundle\Entity\ProductCategory
     */
    public function getProductCategory()
    {
        return $this->productCategory;
    }

    /**
     * Set productBrand
     *
     * @param \ProductBundle\Entity\ProductBrand $productBrand
     *
     * @return Product
     */
    public function setProductBrand(\ProductBundle\Entity\ProductBrand $productBrand = null)
    {
        $this->productBrand = $productBrand;

        return $this;
    }

    /**
     * Get productBrand
     *
     * @return \ProductBundle\Entity\ProductBrand
     */
    public function getProductBrand()
    {
        return $this->productBrand;
    }

    /**
     * Add cart
     *
     * @param \ProductBundle\Entity\Cart $cart
     *
     * @return Product
     */
    public function addCart(\ProductBundle\Entity\Cart $cart)
    {
        $this->carts[] = $cart;

        return $this;
    }

    /**
     * Remove cart
     *
     * @param \ProductBundle\Entity\Cart $cart
     */
    public function removeCart(\ProductBundle\Entity\Cart $cart)
    {
        $this->carts->removeElement($cart);
    }

    /**
     * Get carts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarts()
    {
        return $this->carts;
    }
}
