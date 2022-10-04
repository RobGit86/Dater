<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserParams;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProfileMainFillController extends AbstractController
{
    #[Route('/Profil/Mój/Wypelnij', name: 'app_profile_main_fillas')]
    public function fillProfile(Request $request): Response
    {   

        $userParams = new UserParams();
        
        $fillProfileForm = $this->createFormBuilder($userParams)
            ->add('fillProfile', SubmitType::class, ['label' => 'Wypełnij Profil'])
            ->getForm();

        $fillProfileForm->handleRequest($request);

        if($fillProfileForm->isSubmitted()) {
            
            $dd = 34;

            return $this->redirectToRoute('app_homee', ['slug' => $dd]);

            return $this->render('ProfileMain/profile_main.html.twig', [
                'userParams' => $userParams,
            ]);
        }

        return $this->renderForm('ProfileMain/profile_main_fill.html.twig', [
            'fillProfileForm' => $fillProfileForm,
        ]);
    }
}
