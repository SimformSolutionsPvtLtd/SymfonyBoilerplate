<?php

namespace App\DataFixtures;

use App\Entity\Setting;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class SettingFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $setting = new Setting();
        $setting->setAppName('Symfony Boiler Plate');
        $setting->setPageSize(10);
        $manager->persist($setting);
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['setting'];
    }
}
