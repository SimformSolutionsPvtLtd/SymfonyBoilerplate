<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Car;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\ApiManager;

#[Route('/api')]
class ApiLoginController extends AbstractController
{
    #[Route('/generateToken', name: 'api_login', methods:["POST"])]
    public function generateToken(Request $request, ApiManager $apiManager)
    {
        $content = $request->getContent();
        $requestParams = json_decode($content, true);
        $response = $apiManager->generateToken($requestParams);
        return new JsonResponse($response);
    }

    #[Route('/car/list', name: 'api_check_auth', methods:["GET"])]
    public function getCars(EntityManagerInterface $entityManager)
    {
        $cars = $entityManager->getRepository(Car::class)->findAll();
        $carList = [];
        if (!empty($cars)) {
            foreach ($cars as $car) {
                $carList[] = [
                    'id' => $car->getId(),
                    'slug' => $car->getName(),
                    'title' => $car->getColor(),
                    'category' => $car->getManufacturer()->getCompanyName(),
                    'createdAt' => $car->getCreatedAt()->format('Y-m-d H:i:s'),
                ];
            }
        }
        $response = array('result' => 'success', 'message' => !empty($carList) ? 'Car List found' : 'Car list not found', 'data' => $carList);
        return new JsonResponse($response);
    }
}
