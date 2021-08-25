<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BucketController extends AbstractController
{
    /**
     * @Route("/test/demo", name="home")
     */
    public function home(): Response
    {
        $wishes[] = 'Voyager en Corée du Sud';
        $wishes[] = 'Reprendre le sport';
        $wishes[] = 'Apprendre le japonais';
        $wishes[] = 'Arréter de fumer';
        
        return $this->render('bucket/home.html.twig', [
            'wishes' => $wishes
        ]);
    }
}
