<?php

namespace App\Controller;

use App\Entity\Artwork;
use App\Entity\TechArtwork;
use App\Repository\ArtworkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtworkController extends AbstractController
{
    /**
     * @Route({
     *     "fr" : "oeuvre/voir/{slug}",
     *     "en" : "artwork/show/{slug}"
     * }, name="app_artwork", methods={"GET"})
     * @param $slug
     * @param $art
     * @param ArtworkRepository $artworkRepository
     * @return Response
     */
    public function show($slug, Artwork $art, ArtworkRepository $artworkRepository) : Response
    {
        $artwork = $artworkRepository->findOneBySlug($slug);

        $technical = $this->getDoctrine()->getRepository(TechArtwork::class)
            ->findTechByArtwork($art->getId());

        $random = $this->getDoctrine()
            ->getRepository(Artwork::class)
            ->RandomArtworks(6);


        return $this->render('artwork/show.html.twig', [
            'route_name' => 'app_artwork',
            'artwork' => $artwork,
            'technical' => $technical,
            'random' => $random
        ]);
    }
}
