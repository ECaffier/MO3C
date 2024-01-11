<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact, [
            'attr' => ['id' => 'contactForm']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();

            $em->persist($contact);
            $em->flush();

            $email = (new Email())
                ->from($contact->getEmail())
                ->to('contact@mo3c.fr')
                ->subject($contact->getSubject())
                ->html($contact->getMessage());

            $mailer->send($email);

            $this->addFlash(
                'success',
                'Votre demande de contact a bien été prise en compte'
            );

            return $this->redirectToRoute('app_contact');
        };

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'page' => 'contact'
        ]);
    }
}


