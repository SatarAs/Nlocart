<?php

namespace App\Controller;

use App\Entity\Artwork;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    /**
     * @Route({
     *     "fr" : "/catalogue",
     *     "en" : "/catalog"
     * }, name="app_catalog", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function catalog(Request $request, PaginatorInterface $paginator) : Response
    {
        $repo = $this->getDoctrine()
            ->getRepository(Artwork::class)
            ->findBy([], ['artworkCreationDate' => 'desc']);

        $artworks = $paginator->paginate(
            $repo,
            $request->query->getInt('page', 1), 18
        );

        return $this->render('catalog/catalog.html.twig', [
            'route_name' => 'app_catalog',
            'artworks' => $artworks
        ]);
    }
}
