<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MentionsLégalesController extends AbstractController
{
    #[Route('/mentions', name: 'app_mentions')]
    public function index(): Response
    {
        return $this->render('mentions_légales/index.html.twig', [
            'controller_name' => 'MentionsLégalesController',
        ]);
    }
}
