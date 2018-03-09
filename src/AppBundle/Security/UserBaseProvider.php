<?php

namespace AppBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserBaseProvider implements UserProviderInterface
{

    public function loadUserByUsername($username)
    {
        $user = new TbluserBase();
        $user->setUserName($username);
        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        return $user;
    }

    public function supportsClass($class)
    {
        return $class == 'AppBundle\Entity\User';
    }

}