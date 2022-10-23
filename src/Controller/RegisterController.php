<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterController extends AbstractController
{
    #[Route('/Rejestracja', name: "app_register")]
    public function register(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {   

        $newUser = new User();
        
        $registerForm = $this->createFormBuilder($newUser)
            ->add('nick', TextType::class)
            ->add('email', TextType::class)
            ->add('password', PasswordType::class)
            ->add('register', SubmitType::class, ['label' => 'ReeegisterAccount'])
            ->getForm();

        $registerForm->handleRequest($request);

        if($registerForm->isSubmitted()) {

            $newUser = $registerForm->getData();

            $passwordPlain = $newUser->getPassword();
            
            $hashedPassword = $passwordHasher->hashPassword(
                $newUser,
                $passwordPlain
            );
            $newUser->setPassword($hashedPassword);

            $em = $doctrine->getManager();
            $em->persist($newUser);
            $em->flush();
            
            return $this->render('Register/user_added.html.twig');
        }

        return $this->renderForm('/Register/register.html.twig', [
            'form' => $registerForm,
            'nick' => $newUser->getNick(),
        ]);
    }
}