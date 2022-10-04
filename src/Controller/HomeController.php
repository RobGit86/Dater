<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response
    {   

        $logged = $this->isGranted('IS_AUTHENTICATED_FULLY');
        $email = null;
        $nick = null;

        if($logged) {
            $user = $this->getUser();
            $email = $user->getEmail();
            $nick = $user->getNick();
        }

        return $this->render('/Home/home.html.twig', [
            'email' => $email,
            'nick' => $nick,
            'logged' => $logged,
        ]);
    }
}