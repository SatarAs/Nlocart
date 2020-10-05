<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route({
     *     "fr": "/connexion",
     *     "en": "/login"
     * }, name="app_login", methods={"GET", "POST"})
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_index');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastEmail = $authenticationUtils->getLastUsername();

        return $this->render('security/index.html.twig', [
            'lastEmail' => $lastEmail,
            'error' => $error
        ]);
    }

    /**
     * @Route({
     *     "fr": "/déconnexion",
     *     "en": "/logout"
     * }, name="app_logout", methods={"GET", "POST"})
     * @throws Exception
     */
    public function logout() : Response
    {
        throw new Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

}
