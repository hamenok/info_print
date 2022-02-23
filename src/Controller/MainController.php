<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route('/')]
    public function indexNoLocale(Request $request): Response
    {
        if ($request->cookies->get('userLocale')){
            $cookie = $request->cookies->get('userLocale');
        } else {
            $cookie = 'en';
        }
        return $this->redirectToRoute('home', ['_locale' => $cookie]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/', name: 'home')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
