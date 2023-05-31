<?php

namespace App\Services;

use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

class ApiManager
{
    private $passwordHasher;

    private $jwtManager;

    private $entityManager;

    public function __construct(UserPasswordHasherInterface $passwordHasher, JWTTokenManagerInterface $jwtManager, EntityManagerInterface $entityManager)
    {
        $this->passwordHasher = $passwordHasher;
        $this->jwtManager = $jwtManager;
        $this->entityManager = $entityManager;
    }
    public function generateToken($requestParams)
    {
        $user = $this->entityManager->getRepository(User::class)
            ->findOneBy(['email' => $requestParams['email']]);
        if (!$user) {
            return array('result' => 'error', 'errors' => 'User not found!');
        }
        $isPasswordValid = $this->passwordHasher->isPasswordValid($user, $requestParams['password']);
        if (!$isPasswordValid) {
            return array('result' => 'error', 'errors' => 'Bad credentials !');
        }
        $token = $this->jwtManager->create($user);
        if(!$token) {
            return  array('result' => 'error', 'errors' => 'Something went wrong !');
        }
        return array('result' => 'success', 'token' => $token);
    }
}
