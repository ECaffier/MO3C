<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function registration(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $plaintextPassword = $form->get('password')->getData();

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );

            $user->setPassword($hashedPassword);

            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                'Votre demande de contact a bien été prise en compte'
            );

            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
            'page' => 'registration'
        ]);
    }
}

