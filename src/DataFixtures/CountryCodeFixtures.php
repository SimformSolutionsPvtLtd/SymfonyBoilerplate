<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\CountryCode;

class CountryCodeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $countryCode1 = new CountryCode();
        $countryCode1->setCountry("India");
        $countryCode1->setCode(91);
        $manager->persist($countryCode1);

        $countryCode2 = new CountryCode();
        $countryCode2->setCountry("USA");
        $countryCode2->setCode(1);
        $manager->persist($countryCode2);

        $countryCode3 = new CountryCode();
        $countryCode3->setCountry("Germany");
        $countryCode3->setCode(49);
        $manager->persist($countryCode3);

        $countryCode4 = new CountryCode();
        $countryCode4->setCountry("France");
        $countryCode4->setCode(33);
        $manager->persist($countryCode4);

        $countryCode5 = new CountryCode();
        $countryCode5->setCountry("China");
        $countryCode5->setCode(86);
        $manager->persist($countryCode5);

        $countryCode6 = new CountryCode();
        $countryCode6->setCountry("Japan");
        $countryCode6->setCode(81);
        $manager->persist($countryCode6);

        $countryCode7 = new CountryCode();
        $countryCode7->setCountry("Australia");
        $countryCode7->setCode(61);
        $manager->persist($countryCode7);

        $countryCode8 = new CountryCode();
        $countryCode8->setCountry("Brazil");
        $countryCode8->setCode(55);
        $manager->persist($countryCode8);

        $countryCode9 = new CountryCode();
        $countryCode9->setCountry("United Kingdom");
        $countryCode9->setCode(44);
        $manager->persist($countryCode9);

        $countryCode10 = new CountryCode();
        $countryCode10->setCountry("Kenya");
        $countryCode10->setCode(254);
        $manager->persist($countryCode10);

        $manager->flush();
    }
}
