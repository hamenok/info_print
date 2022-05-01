<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class UserProfileController extends AbstractController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/{_locale<%app.supported_locales%>}/user/profile/{id}', name: 'user_profile')]
    public function index($id): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $titlePage = 'VIEW PROFILE';
        $user = $this->userRepository->getOne($id);

        return $this->render('user_profile/index.html.twig', [
            'controller_name' => 'UserProfileController',
            'user' => $user,
            'titlePage' => $titlePage,
        ]);
    }
}
