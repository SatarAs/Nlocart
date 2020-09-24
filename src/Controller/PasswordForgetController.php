<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PasswordForgetController extends AbstractController
{
    /**
     * @Route({
     *     "fr" : "/mot-de-passe-oublie",
     *     "en" : "/forget-password"
     * }, name="app_forget_password", methods={"GET"})
     */
    public function forget()
    {
        return $this->render('password_forget/forget.html.twig', [
            'route_name' => 'app_forget_password',
        ]);
    }
}
