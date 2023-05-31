<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\CountryCode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        // Admin User create
        $user1 = new User();
        $user1->setEmail('admin@gmail.com');
        $user1->setRoles(['ROLE_ADMIN']);
        $password = $this->passwordHasher->hashPassword($user1, 'password');
        $user1->setPassword($password);
        $user1->setName('admin');
        $user1->setContactNumber('9876547698');
        $countryCode = $manager->getRepository(CountryCode::class)->findOneByCountry('India');
        $user1->setCountryCode($countryCode);
        $manager->persist($user1);

        $faker = Faker::create();
        $user2 = new User();
        $user2->setEmail($faker->email);
        $user2->setRoles(['ROLE_USER']);
        $password = $this->passwordHasher->hashPassword($user2, 'password');
        $user2->setPassword($password);
        $user2->setName('admin');
        $user2->setContactNumber($faker->phoneNumber);
        $countryCode = $manager->getRepository(CountryCode::class)->findOneByCountry('USA');
        $user2->setCountryCode($countryCode);
        $manager->persist($user2);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['user'];
    }
}
