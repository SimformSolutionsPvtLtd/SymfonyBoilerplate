<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\Form;

class UserManager
{
    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    public function persistAndFlushUser(Form $form, User $user)
    {
        $data = $form->getData();
        if ($data->getPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $data->getPassword()
            );
            $user->setPassword($hashedPassword);
        }
        $user->setRoles($data->getRoles());
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
