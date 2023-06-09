<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Manufacturer;

class ManufacturerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manufacturer1 = new Manufacturer();
        $manufacturer1->setCompanyName("Mahindra");
        $manufacturer1->setCity("Mumbai");
        $manager->persist($manufacturer1);

        $manufacturer2 = new Manufacturer();
        $manufacturer2->setCompanyName("BMW");
        $manufacturer2->setCity("Mumbai");
        $manufacturer2->setUpdatedAt(new \DateTimeImmutable());

        $manufacturer3 = new Manufacturer();
        $manufacturer3->setCompanyName("Land Rover");
        $manufacturer3->setCity("Delhi");
        $manufacturer3->setUpdatedAt(new \DateTimeImmutable());

        $manufacturer4 = new Manufacturer();
        $manufacturer4->setCompanyName("Ford");
        $manufacturer4->setCity("Berlin");
        $manufacturer4->setUpdatedAt(new \DateTimeImmutable());

        $manufacturer5 = new Manufacturer();
        $manufacturer5->setCompanyName("Suzuki");
        $manufacturer5->setCity("Tokyo");
        $manufacturer5->setUpdatedAt(new \DateTimeImmutable());

        $manager->flush();
    }
}
