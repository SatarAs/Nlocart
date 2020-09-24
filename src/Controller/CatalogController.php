<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    /**
     * @Route({
     *     "fr" : "/catalogue",
     *     "en" : "/catalog"
     * }, name="app_catalog", methods={"GET"})
     */
    public function catalog()
    {
        return $this->render('catalog/catalog.html.twig', [
            'route_name' => 'app_catalog',
        ]);
    }
}
