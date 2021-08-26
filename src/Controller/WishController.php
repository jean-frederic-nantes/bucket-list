<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function home(WishRepository $repo): Response
    {
        $wishes = $repo->findAll();
        return $this->render(
            'wish/home.html.twig',
            ['wishes' => $wishes]
        );
    }




    /**
     * @Route("/admin/ajouter", name="ajouter")
     */
    public function ajouter(Request $request, EntityManagerInterface  $em): Response
    {
        $wish = new Wish();
        $formWish = $this->createForm(WishType::class, $wish);
        $formWish->handleRequest($request); // hydrater $wish
        if ($formWish->isSubmitted()) {
            $wish->setIsPublished(true);
            $wish->setDateCreated(new \DateTime());
            $em->persist($wish);
            $em->flush();
            // a faire plus tard rediriger vers la home du BO /admin
            return $this->redirectToRoute('admin_home');
        }
        return $this->render(
            'wish/ajouter.html.twig',
            ['formWish' => $formWish->createView()]
        );
    }
    /**
     * @Route("/admin/quick-add", name="quick_add")
     */
    public function quick_add(Request $req, EntityManagerInterface  $em): Response
    {
        $wish = new Wish();
        $wish->setTitle($req->get('title'));
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTime());
        $em->persist($wish);
        $em->flush();
        return $this->redirectToRoute('admin_home');
    }



    /**
     * @Route("/admin/modifier/{id}", name="modifier")
     */
    public function modifier(Wish $wish, Request $request, EntityManagerInterface  $em): Response
    {

        $formWish = $this->createForm(WishType::class, $wish);
        $formWish->handleRequest($request); // hydrater $wish
        if ($formWish->isSubmitted()) {
            $wish->setIsPublished(true);
            $wish->setDateCreated(new \DateTime());
            $em->flush();
            return $this->redirectToRoute('admin_home');
        }
        return $this->render(
            'wish/modifier.html.twig',
            ['formWish' => $formWish->createView()]
        );
    }

    /**
     * @Route("/admin/delete/{id}", name="delete")
     */
    public function delete(Wish $wish, EntityManagerInterface  $em): Response
    {

        $em->remove($wish);
        $em->flush();
        return $this->redirectToRoute('admin_home');
    }
}
