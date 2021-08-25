<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(WishRepository $repo): Response
    {
       $wishes = $repo->findBy(['isPublished'=> true],['dateCreated'=>'DESC']);
      // $wishes = $repo->findAll(['dateCreated'=>'DESC']);
        /*
        $wishes[] = 'Voyager en Corée du Sud';
        $wishes[] = 'Reprendre le sport';
        $wishes[] = 'Apprendre le japonais';
        $wishes[] = 'Arréter de fumer';
        */
        return $this->render('wish/home.html.twig', [
            'wishes' => $wishes
        ]);
    }

     /**
     * @Route("/ajouter", name="ajouter")
     */
    public function ajouter(EntityManagerInterface  $em): Response
    {
        $wish = new Wish();
        $wish->setTitle('Apprendre le Yoga');
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTime());
        $em->persist($wish);
        $em->flush();
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('wish/contact.html.twig');
    }
}
