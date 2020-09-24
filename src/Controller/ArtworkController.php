<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArtworkController extends AbstractController
{
    /**
     * @Route("/artwork", name="artwork")
     */
    public function index()
    {
        return $this->render('artwork/index.html.twig', [
            'controller_name' => 'ArtworkController',
        ]);
    }
}
