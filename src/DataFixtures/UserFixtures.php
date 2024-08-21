<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hashpassword) {
        
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        $password = "xxxxxx89";
        $user = new User();
        $user->setEmail("allysaidi64@gmail.com")->setNom("SAIDI")->setPrenom("Azaria")
        ->setPhoneNumber("07532001345")->setVerified(true);
        $hashed = $this->hashpassword->hashPassword($user,$password);
        $user->setPassword($hashed);
        // $manager->persist($product);
        $manager->persist($user);
        $manager->flush();
    }
}
