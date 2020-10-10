<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\RegisterType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route({
     *     "fr" : "/inscription",
     *     "en" : "/register"
     * }, name="app_register", methods={"GET", "POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder) : Response
    {
        $customer = new Customer();

        $form = $this->createForm(RegisterType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $hash = $encoder->encodePassword($customer, $customer->getPassword());
            $customer->setPassword($hash);
            $manager->persist($customer);
            $manager->flush();

            $this->addFlash('success', 'Félicitations, votre inscription est effective. ; Vous pouvez maintenant vous connecter.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('register/register.html.twig', [
            'controller_name' => 'RegisterController',
            'form' => $form->createView(),
        ]);
    }
}
