<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * ProductBrand
 *
 * @ORM\Table(name="product_brand")
 * @ORM\Entity
 */
class ProductBrand
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
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="zip", type="integer", nullable=false)
     */
    private $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="telp", type="string", length=255, nullable=false)
     */
    private $telp;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="brand_name", type="string", length=255, nullable=false)
     */
    private $brandName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="date", nullable=false)
     */
    private $createAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="date", nullable=false)
     */
    private $updateAt;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="productBrand")
     */
    protected $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
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
     * Set address
     *
     * @param string $address
     *
     * @return ProductBrand
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zip
     *
     * @param integer $zip
     *
     * @return ProductBrand
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return integer
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set telp
     *
     * @param string $telp
     *
     * @return ProductBrand
     */
    public function setTelp($telp)
    {
        $this->telp = $telp;

        return $this;
    }

    /**
     * Get telp
     *
     * @return string
     */
    public function getTelp()
    {
        return $this->telp;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return ProductBrand
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set brandName
     *
     * @param string $brandName
     *
     * @return ProductBrand
     */
    public function setBrandName($brandName)
    {
        $this->brandName = $brandName;

        return $this;
    }

    /**
     * Get brandName
     *
     * @return string
     */
    public function getBrandName()
    {
        return $this->brandName;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return ProductBrand
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return ProductBrand
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Add product
     *
     * @param \ProductBundle\Entity\Product $product
     *
     * @return ProductBrand
     */
    public function addProduct(\ProductBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \ProductBundle\Entity\Product $product
     */
    public function removeProduct(\ProductBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
