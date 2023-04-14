<?php

namespace App\Controller;

use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Services\UserManager;
use App\Form\UserType;

class RegistrationController extends BaseController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserManager $userManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->persistAndFlushUser($form, $user);
            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/new.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
}
