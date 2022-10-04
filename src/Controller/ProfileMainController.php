<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserParams;
use App\Form\ProfileFillForm;
use App\Form\ProfileRemoveForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\Persistence\ManagerRegistry;

class ProfileMainController extends AbstractController
{
    #[Route('/Profil', name: 'app_profile_main')]
    public function profileMain(Request $request, ManagerRegistry $doctrine): Response
    {   

        if(!$this->getUser()->getUserParams()) {

            return $this->redirectToRoute('app_profile_main_make');

        } else {

            $user = $this->getUser();
            $userParams = $this->getUser()->getUserParams();

            $profileRemoveForm = $this->createForm(ProfileRemoveForm::class);
            $profileRemoveForm->handleRequest($request);

            if($profileRemoveForm->isSubmitted()) {
                return $this->redirectToRoute('app_profile_main_remove');
            }

            return $this->renderForm('ProfileMain/profile_main.html.twig', [
                'profileRemoveForm' => $profileRemoveForm,
                'user' => $user,
                'userParams' => $userParams,
            ]);
        }
    }

    #[Route('/Profil/Utwórz', name: 'app_profile_main_make')]
    public function profileMainMake(Request $request): Response
    {  
        $userParams = new UserParams();
        
        $makeProfileForm = $this->createFormBuilder()
            ->add('fillProfile', SubmitType::class, ['label' => 'Utwórz Profil'])
            ->getForm();

        $makeProfileForm->handleRequest($request);

        if($makeProfileForm->isSubmitted()) {
            
            return $this->redirectToRoute('app_profile_main_fill');
        }

        return $this->renderForm('ProfileMain/profile_main_make.html.twig', [
            'makeProfileForm' => $makeProfileForm,
        ]);
    }

    #[Route('/Profil/Wypełnij', name: 'app_profile_main_fill')]
    public function profileMainFill(Request $request, ManagerRegistry $doctrine): Response
    {  

        $userParams = new UserParams();

        $profileFillForm = $this->createForm(ProfileFillForm::class, $userParams);
        $profileFillForm->handleRequest($request);

        if($profileFillForm->isSubmitted()) {

            $userParams = $profileFillForm->getData();

            $em = $doctrine->getManager();
            $em->persist($userParams);
            $em->flush();

            $user = $this->getUser();
            $user->setUserParams($userParams);
            $em->flush();

            return $this->redirectToRoute('app_profile_main');

        } else {

            $userParams = $this->getUser()->getUserParams();
            
            $profileFillForm = $this->createForm(ProfileFillForm::class, $userParams);
            $profileFillForm->handleRequest($request);
        }

        return $this->renderForm('ProfileMain/profile_main_fill.html.twig', [
            'profileFillForm' => $profileFillForm,
        ]);
    }

    #[Route('/Profil/Usuń', name: 'app_profile_main_remove')]
    public function profileMainRemove(Request $request, ManagerRegistry $doctrine): Response
    {  

        $user = $this->getUser();
        $userParams = $user->getUserParams();

        $user->setUserParams(null);

        $em = $doctrine->getManager();
        $em->flush();

        $em->remove($userParams);
        $em->flush();

        return $this->redirectToRoute('app_home');
    }

    #[Route('/Profil/Test', name: 'app_profile_main_test')]
    public function profileMainTest(Request $request, ManagerRegistry $doctrine): Response
    {  

        $em = $doctrine->getManager();

        $userParams = $this->getUser()->getUserParams();
        
        $userParams->setSex($_POST['sex']);
        $userParams->setFirstname($_POST['firstname']);
        $userParams->setLastname($_POST['lastname']);
        $em->flush();

        return new Response("NO SIEMANO");
    }

    #[Route('/Profil/UploadImage', name: 'app_profile_main_upload_image')]
    public function profileUploadImage(Request $request, ManagerRegistry $doctrine): Response
    {  

        if(isset($_FILES['image'])) {
            $fileName = $_FILES['image']['name'];
            $fileTmp = $_FILES['image']['tmp_name'];
        }

        $projectRoot = $this->getParameter('kernel.project_dir');
        $move = "/gallery/26/";
        
        $path = $projectRoot.$move.$fileName;

        echo $projectRoot;

        // echo $webPath;
        echo "\n";
        echo $fileName;
        echo "\n";
        echo $fileTmp;

        echo "\n";
        echo "\n";
        echo "\n";
        

        move_uploaded_file($fileTmp, $path);

        // return new Response(implode(",", $_FILES['image']));
        return new Response("OK");
    }

}
