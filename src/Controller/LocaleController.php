<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;

class LocaleController extends AbstractController
{
    #[Route('/lang/{loc}', name: 'lang')]
    public function index($loc, Request $request): Response
    {
        $response = new Response();
        $cookie = new Cookie('userLocale', $loc ,time() + (3 * 24 * 60 * 60));
        $response->headers->setCookie($cookie);
        $response->sendHeaders();

        return $this->redirectToRoute('home', [
            '_locale' => $loc
        ]);
    }
}
