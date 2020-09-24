<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrderBasketController extends AbstractController
{
    /**
     * @Route("/order/basket", name="order_basket")
     */
    public function index()
    {
        return $this->render('order_basket/index.html.twig', [
            'controller_name' => 'OrderBasketController',
        ]);
    }
}
