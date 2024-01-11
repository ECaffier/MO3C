<?php

namespace App\Controller;

use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceController extends AbstractController
{
    #[Route('/services', name: 'app_product')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {   
        $services = $em->getRepository(Service::class)->findAll();

        return $this->render('services/index.html.twig', [
            'controller_name' => 'ServiceController',
            'services' => $services,
            'page' => 'services'
        ]);
    }

    #[Route('/service/{id}', name: 'single_service')]
    public function oneService(Request $request, EntityManagerInterface $em, $id): Response
    {   
        $services = $em->getRepository(Service::class)->findById($id);

        if (!$services) {
            throw $this->createNotFoundException('Le service demandé n\'existe pas.');
        }

        return $this->render('services/single.html.twig', [
            'controller_name' => 'ServiceController',
            'services' => $services,
            'page' => 'services'
        ]);
    }
}
