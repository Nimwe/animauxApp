<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\InscriptionType;

class UserController extends AbstractController
{
    #[Route('/profiluser', name: 'app_user')]
    public function user() : Response {
        return $this->render("user/profiluser.html.twig");
    }

    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request, UserPasswordHasherInterface $uphi, 
    EntityManagerInterface $em): Response
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class,$user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $pclair = $user->getPassword();
            $hp = $uphi->hashPassword($user,$pclair);
            $user->setPassword($hp);

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("app_login");
        }

        return $this->render('user/formuser.html.twig',[
            "form" => $form->createView()
        ]);
    }
    
}
