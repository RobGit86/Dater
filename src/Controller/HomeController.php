<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response
    {   

        $logged = $this->isGranted('IS_AUTHENTICATED_FULLY');
        $logged ? $user = $this->getUser() : $user = null;

        return $this->render('/Home/home.html.twig', [
            'user' => $user,
            'logged' => $logged,
        ]);
    }
}