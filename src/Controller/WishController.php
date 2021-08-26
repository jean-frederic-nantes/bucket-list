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
     * @Route("/admin/ajouter", name="ajouter")
     */
    public function ajouter(Request $request,EntityManagerInterface  $em): Response
    {
        $wish = new Wish();
        $formWish = $this->createForm(WishType::class,$wish);
        $formWish->handleRequest($request); // hydrater $wish
        if ($formWish->isSubmitted())
        {
            $wish->setIsPublished(true);
            $wish->setDateCreated(new \DateTime());
            $em->persist($wish);
            $em->flush();
            // a faire plus tard rediriger vers la home du BO /admin
            return $this->redirectToRoute('home');

        }
        return $this->render('wish/ajouter.html.twig',
        [ 'formWish' => $formWish->createView() ]);
    }


}
