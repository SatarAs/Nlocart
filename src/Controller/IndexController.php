<?php

namespace App\Controller;

use App\Entity\Artwork;
use App\Entity\ArtworkSupport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route({
     *     "fr" : "/index",
     *     "en" : "/index"
     * }, name="app_index", methods={"GET"})
     */
    public function index() : Response
    {
        $repo = $this->getDoctrine()->getRepository(Artwork::class);
        $artworks = $repo->findXArtworks(4);

        if(!$artworks) {
            throw $this->createNotFoundException('Aucune oeuvre disponible !');
        }

        return $this->render('index/index.html.twig', [
            'route_name' => 'app_index',
            'artworks' => $artworks
        ]);
    }
}
