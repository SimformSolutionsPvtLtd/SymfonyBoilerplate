<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\VehicleManager;
use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use App\Services\DataTableManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

#[Route('/car')]
class CarController extends AbstractController
{
    #[Route('/', name: 'car_index', options: ['expose'=> true] )]
    public function index(Request $request, CarRepository $carRepository, PaginatorInterface $paginator, DataTableManager $dataTableManager)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->json($dataTableManager->renderDataTable($request, $carRepository, $paginator));
        }

        return $this->render('car/index.html.twig');
    }

    #[Route('/new', name: 'car_new', methods: ['GET', 'POST'] )]
    public function new(Request $request, VehicleManager $vehicleManager): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicleManager->persistAndFlushCar($form, $car);
        }
        return $this->render('car/new.html.twig', [
            'car' => $car,
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}/edit', name: 'car_edit', methods: ['GET', 'POST'], options: ['expose'=> true])]
    public function edit(Request $request, Car $car, VehicleManager $vehicleManager): Response
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vehicleManager->persistAndFlushCar($form, $car);
            return $this->redirectToRoute('car_index');
        }
        return $this->render('car/new.html.twig', [
            'car' => $car,
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'car_delete', methods: ['GET', 'POST'], options: ['expose'=> true])]
    public function delete(Request $request, Car $car, VehicleManager $vehicleManager): Response
    {
        if ($this->isCsrfTokenValid('delete-item', $request->request->get('_token'))) {
            $vehicleManager->deleteCar($car);
        }
        return $this->redirectToRoute('car_index');
    }
}
