<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="visiteurs")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VisiteursRepository")
 */
class Visiteurs
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private  $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Visiteurs", inversedBy="adressIP", cascade={"all"})
     * @ORM\Column(type="integer", name="adresse_ip")
     */
    private  $adressIP;

    /**
     *
     *@ORM\Column(type="datetime", name="date")
     *
     */
    private $date;

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
     * Set adressIP
     *
     * @param \AppBundle\Entity\Visiteurs $adressIP
     * @return Visiteurs
     */
    public function setAdressIP(\AppBundle\Entity\Visiteurs $adressIP = null)
    {
        $this->adressIP = $adressIP;

        return $this;
    }

    /**
     * Get adressIP
     *
     * @return \AppBundle\Entity\Visiteurs 
     */
    public function getAdressIP()
    {
        return $this->adressIP;
    }
}
