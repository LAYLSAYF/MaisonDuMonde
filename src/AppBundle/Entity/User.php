<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
    *
    *@ORM\Column(type="string", name="nom")
    *
    */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Visiteurs", mappedBy="adressIP", cascade={"all"})
     * @ORM\Column(type="integer", name="adresse_ip")
     */
    protected $addressIP;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addressIP = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add addressIP
     *
     * @param \AppBundle\Entity\Visiteurs $addressIP
     * @return User
     */
    public function addAddressIP(\AppBundle\Entity\Visiteurs $addressIP)
    {
        $this->addressIP[] = $addressIP;

        return $this;
    }

    /**
     * Remove addressIP
     *
     * @param \AppBundle\Entity\Visiteurs $addressIP
     */
    public function removeAddressIP(\AppBundle\Entity\Visiteurs $addressIP)
    {
        $this->addressIP->removeElement($addressIP);
    }

    /**
     * Get addressIP
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddressIP()
    {
        return $this->addressIP;
    }
}
