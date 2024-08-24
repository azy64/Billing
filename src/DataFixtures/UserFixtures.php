<?php

namespace App\DataFixtures;

use App\Entity\InvoiceStatus;
use App\Entity\PaymentType;
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
        $status= ["paid","unpaid yet", "paid in part"];
        $paymentType=["CB","cash", "bank check"];
        $password = "xxxxxx89";
        $user = new User();
        $user->setEmail("allysaidi64@gmail.com")->setNom("SAIDI")->setPrenom("Azaria")
        ->setPhoneNumber("07532001345")->setVerified(true);
        $hashed = $this->hashpassword->hashPassword($user,$password);
        $user->setPassword($hashed);
        // $manager->persist($product);
        foreach($status as $el){
            $invoiceStatus = new InvoiceStatus();
            $invoiceStatus->setDenomination($el);
            $manager->persist($invoiceStatus);
        }
        foreach($paymentType as $el){
            $payType = new PaymentType();
            $payType->setLabel($el);
            $manager->persist($payType);
        }
        $manager->persist($user);
        $manager->flush();
    }
}
