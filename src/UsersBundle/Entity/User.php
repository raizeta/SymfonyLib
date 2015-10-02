<?php

namespace UsersBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="github_id", type="string", nullable=true)
     */
    private $githubID;

    /**
     * @ORM\OneToMany(targetEntity="ProductBundle\Entity\Cart", mappedBy="customer")
     */
    protected $carts;

    public function __construct()
    {
        parent::__construct();
        $this->carts = new ArrayCollection();
    }

    /**
     * Set githubID
     *
     * @param string $githubID
     *
     * @return User
     */
    public function setGithubID($githubID)
    {
        $this->githubID = $githubID;

        return $this;
    }

    /**
     * Get githubID
     *
     * @return string
     */
    public function getGithubID()
    {
        return $this->githubID;
    }

    /**
     * Add cart
     *
     * @param \ProductBundle\Entity\Cart $cart
     *
     * @return User
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
