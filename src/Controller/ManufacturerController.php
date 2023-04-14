<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\VehicleManager;
use App\Entity\Manufacturer;
use App\Form\ManufacturerType;
use App\Repository\ManufacturerRepository;
use App\Services\DataTableManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

#[Route('/manufacturer')]
class ManufacturerController extends AbstractController
{
    #[Route('/', name: 'manufacturer_index', options: ['expose'=> true] )]
    public function index(Request $request, ManufacturerRepository $manufacturerRepository, PaginatorInterface $paginator, DataTableManager $dataTableManager)
    {
        if ($request->isXmlHttpRequest()) {
            return $this->json($dataTableManager->renderDataTable($request, $manufacturerRepository, $paginator));
        }
        return $this->render('manufacturer/index.html.twig');
    }

    #[Route('/new', name: 'manufacturer_new', methods: ['GET', 'POST'] )]
    public function new(Request $request, VehicleManager $vehicleManager): Response
    {
        $manufacturer = new Manufacturer();
        $form = $this->createForm(ManufacturerType::class, $manufacturer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicleManager->persistAndFlushManufacturer($form, $manufacturer);
        }
        return $this->render('manufacturer/new.html.twig', [
            'manufacturer' => $manufacturer,
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}/edit', name: 'manufacturer_edit', methods: ['GET', 'POST'], options: ['expose'=> true])]
    public function edit(Request $request, manufacturer $manufacturer, VehicleManager $vehicleManager): Response
    {
        $form = $this->createForm(ManufacturerType::class, $manufacturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vehicleManager->persistAndFlushmanufacturer($form, $manufacturer);
            return $this->redirectToRoute('manufacturer_index');
        }

        return $this->render('manufacturer/new.html.twig', [
            'manufacturer' => $manufacturer,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'manufacturer_delete', methods: ['GET', 'POST'], options: ['expose'=> true])]
    public function delete(Request $request, manufacturer $manufacturer, VehicleManager $vehicleManager): Response
    {
        if ($this->isCsrfTokenValid('delete-item', $request->request->get('_token'))) {
            $vehicleManager->deletemanufacturer($manufacturer);
        }

        return $this->redirectToRoute('manufacturer_index');
    }
}
