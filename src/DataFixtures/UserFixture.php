<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    private $encoder;
    //public function __construct(UserPasswordEncoderInterface $encoder) {
    //    $this->encoder = $encoder;
    //}
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin@quiz.ru');
        $user->setPassword('000');
        $manager->persist($user);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
