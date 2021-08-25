<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {

        $wishes[] = 'Voyager en Corée du Sud';
        $wishes[] = 'Reprendre le sport';
        $wishes[] = 'Apprendre le japonais';
        $wishes[] = 'Arréter de fumer';
        
        return $this->render('wish/home.html.twig', [
            'wishes' => $wishes
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('wish/contact.html.twig');
    }
}
