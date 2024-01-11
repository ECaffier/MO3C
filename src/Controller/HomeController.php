<?php

namespace App\Controller;

use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function services(Request $request, EntityManagerInterface $em): Response
    {   
        $services = $em->getRepository(Service::class)->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'ServiceController',
            'services' => $services,
            'page' => 'home'
        ]);
    }
}
