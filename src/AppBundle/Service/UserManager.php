<?php
namespace AppBundle\Service;
use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Util\SecureRandomInterface;
class UserManager
{
    private $randomizer;
    private $encoder;
    private $entityManager;
    public function __construct(SecureRandomInterface $randomizer, UserPasswordEncoderInterface $encoder, ObjectManager $manager)
    {
        $this->randomizer = $randomizer;
        $this->encoder = $encoder;
        $this->entityManager = $manager;
    }
    public function updateUser(User $user)
    {
        if ($user->plainPassword) {
            $salt = sha1($this->randomizer->nextBytes(64));
            $user->setSalt($salt);
            $password = $this->encoder->encodePassword($user, $user->plainPassword);
            $user->setPassword($password);
        }
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}