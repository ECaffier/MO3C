<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Form\BlogpostType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BlogPostController extends AbstractController
{
    #[Route('/blogpost', name: 'app_blogpost')]
    public function index(EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
        // $blogposts = $em->getRepository(BlogPost::class)->findBy(array(), array('createdAt' => 'DESC'));
        $lastPosts = $em->getRepository(BlogPost::class)->findLastBlogPosts();

        $blogposts = $paginator->paginate(
            $em->getRepository(BlogPost::class)->findBy(array(), array('createdAt' => 'DESC')), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );

        return $this->render('blogpost/index.html.twig', [
            'blogposts' => $blogposts,
            'page' => 'blog',
            'lastPosts' => $lastPosts
        ]);
    }

    #[Route('/blogpost/writer', name: 'app_blogpost_writer')]
    public function postEdit(EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
        $blogposts = $paginator->paginate(
            $em->getRepository(BlogPost::class)->findBy(array(), array('createdAt' => 'DESC')),
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );

        return $this->render('blogpost/writer.html.twig', [
            'blogposts' => $blogposts,
            'page' => 'blogpostWriter'
        ]);
    }

    #[Route('/blogpost/new', name: 'app_blogpost_new')]
    public function new(Request $request, EntityManagerInterface $em) : Response
    {

        $blogpost = new BlogPost();
        $blogpost->setAuthor($this->getUser());

        $form = $this->createForm(BlogpostType::class, $blogpost);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $blogpost = $form->getData();

            $em->persist($blogpost);
            $em->flush();

            $this->addFlash(
                'success',
                'Le post a bien été créé'
            );

            return $this->redirectToRoute('app_blogpost_new');
        }

        return $this->render('blogPost/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/blogpost/update/{id}', name: 'app_blogpost_update')]
    public function update(BlogPost $blogpost, Request $request, EntityManagerInterface $em) : Response
    {
        $form = $this->createForm(BlogpostType::class, $blogpost);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $blogpost = $form->getData();

            $em->persist($blogpost);
            $em->flush();

            $this->addFlash(
                'success',
                'Le post a bien été modifié'
            );

            return $this->redirectToRoute('app_blogpost_update', ['id' => $blogpost->getId()]);
        }

        return $this->render('blogPost/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/blogpost/delete/{id}', name: 'app_blogpost_delete')]
    public function delete(BlogPost $blogpost, EntityManagerInterface $em) : Response
    {
        $em->remove($blogpost);
        $em->flush();

        $this->addFlash(
            'success',
            'Le post a bien été supprimé'
        );

        return $this->redirectToRoute('app_blogpost_writer');
    }
}
