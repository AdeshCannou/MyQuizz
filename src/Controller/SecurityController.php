<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="security_registration")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordHasherInterface $encoder){
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            //$user->setPassword($hash);
            $manager-> persist($user);
            $manager->flush();
        }
        return $this->render('my_quiz/home.html.twig',[
            'form' => $form->createView()
        ]);

    }
}
