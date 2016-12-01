<?php
namespace AppBundle\Service;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class Sha512whirlpool implements PasswordEncoderInterface
{

    public function encodePassword($raw, $salt)
    {
       // return hash('sha256', $salt . $raw); // Custom function for password encrypt
        return hash('sha512', hash('whirlpool', $raw.$salt));
    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        return $encoded === $this->encodePassword($raw, $salt);
    }

}