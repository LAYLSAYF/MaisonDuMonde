<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity()
* @ORM\Table(name="users")
*/
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="string")
     */
    protected $userName;    

    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $enabled;

    protected $plainPassword;

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getRoles()
    {
        return [];
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->userName;
    }

    public function eraseCredentials()
    {
        // Suppression des données sensibles
        $this->plainPassword = null;
    }

    public function setEnabled($enabled){
        $this->enabled = $enabled;
    }
}