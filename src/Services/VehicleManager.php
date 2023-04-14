<?php

namespace App\Services;

use App\Entity\Car;
use App\Entity\Manufacturer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;
use Gedmo\Sluggable\Util\Urlizer;

class VehicleManager
{
    public function __construct(EntityManagerInterface $entityManager, $projectDir)
    {
        $this->entityManager = $entityManager;
        $this->projectDir = $projectDir;
    }

    public function persistAndFlushCar(Form $form, Car $car)
    {
        if(isset($form['imageFile']) && $form['imageFile']) {
            $uploadedFile = $form['imageFile']->getData();
            $destination = $this->projectDir.'/public/uploads';
            if($uploadedFile && $uploadedFile->getClientOriginalName()) {
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $car->setImageName($newFilename);
            }
        }
        $car->setIsActive(1);
        $this->entityManager->persist($car);
        $this->entityManager->flush();
    }

    public function deleteCar(Car $car)
    {
        $this->entityManager->remove($car);
        $this->entityManager->flush();
    }

    public function persistAndFlushManufacturer(Form $form, Manufacturer $manufacturer)
    {
        $this->entityManager->persist($manufacturer);
        $this->entityManager->flush();
    }

    public function deleteManufacturer(Manufacturer $manufacturer)
    {
        $this->entityManager->remove($manufacturer);
        $this->entityManager->flush();
    }
}
