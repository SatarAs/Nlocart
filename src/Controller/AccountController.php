<?php

namespace App\Controller;

use App\Entity\Ordered;
use App\Form\EditAccountFormType;
use App\Repository\ArtworkRepository;
use App\Repository\CustomerRepository;
use App\Repository\OrderedRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    /**
     * @var ArtworkRepository
     */
    private ArtworkRepository $artworkRepository;
    /**
     * @var OrderedRepository
     */
    private OrderedRepository $orderedRepository;
    /**
     * @var CustomerRepository
     */
    private CustomerRepository $customerRepository;

    /**
     * AccountController constructor.
     * @param ArtworkRepository $artworkRepository
     * @param OrderedRepository $orderedRepository
     * @param CustomerRepository $customerRepository
     */
    public function __construct(
        ArtworkRepository $artworkRepository, OrderedRepository $orderedRepository,
         CustomerRepository $customerRepository)
    {
        $this->artworkRepository  = $artworkRepository;
        $this->orderedRepository  = $orderedRepository;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @Route({
     *     "fr" : "/mon-compte",
     *     "en" : "/account"
     * }, name="app_account", methods={"GET"})
     * @return Response
     * @throws Exception
     */
    public function account() : Response
    {
        $customer = $this->getUser();
        $orders = $customer->getOrders();
        $customerWaitingRes = $customerProcessedRes = $rentalArtworks = $selledArtworks = [];
        $nbrWaitRes = $nbrValidRes = $nbrRefuseRes = $nbrRentalRes = 0;
        $customerValidatedRes = $this->orderedRepository->findValidatedOrders();
        $customerRefusedRes = $this->orderedRepository->findRefusedOrders();

        /** @var Ordered $order */
        foreach ($orders as $order){
            if ($order->getOrderStatus() == 0){
                array_push($customerWaitingRes, $order);
                $nbrWaitRes++;
            }else{
                array_push($customerProcessedRes, $order);
            }
            if ($order->getOrderStatus() == 1 && $order->getDecision() == 1 ) {
                $nbrValidRes++;
            }elseif($order->getOrderStatus() == 1 && $order->getDecision() == 0 ){
                $nbrRefuseRes++;
            }
            # Oeuvres en location
            if ($order->getOrderRental() == 1 && $order->getOrderStatus() == 1 && $order->getOrderType() == 0){
                $endResDate = $order->getOrderReservationEndDate();
                $now = new \DateTime();
                if ($endResDate > $now){
                    array_push($rentalArtworks, $order);
                    $nbrRentalRes ++;
                }
            }
            if ($order->getOrderStatus() == 1 && $order->getOrderType() == 1 and $order->getDecision() == 0 ) array_push($selledArtworks, $order);
        }

        return $this->render('account/account.html.twig', [
            'route_name' => 'app_account',
            'customer' => $customer,
            'customerWaitingOrders' => $customerWaitingRes,
            'customerProcessedRes' => $customerProcessedRes,
            'customerValidatedRes' => $customerValidatedRes,
            'customerRefusedRes' => $customerRefusedRes,
            'customerRentalArtworks' => $rentalArtworks,
            'customerSelledArtworks' => $selledArtworks,
            'nbrWaitRes' => $nbrWaitRes,
            'nbrValidRes' => $nbrValidRes,
            'nbrRefuseRes' => $nbrRefuseRes,
            'nbrRentalRes' => $nbrRentalRes,
        ]);
    }

    /**
     * @Route({
     *     "fr" : "/editer-compte",
     *     "en" : "/edit-account"
     * }, name="app_edit_account", methods={"GET", "POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function edit(Request $request, UserPasswordEncoderInterface $encoder) : Response
    {
        $user = $this->getUser();

        $customer = $this->customerRepository->find($user->getId());
        $customerForm = $this->createForm(EditAccountFormType::class, $customer);
        $customerForm->handleRequest($request);
        $category = $this->getUser()->getCustomerCategory();

        if ($customerForm->isSubmitted() && $customerForm->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            $this->addFlash('success', 'Vos informations ont été mises à jour');

            return $this->redirectToRoute('app_account');
        }

        return $this->render('account/edit.html.twig', [
            'customer' => $user,
            'form' => $customerForm->createView(),
            'cat' => $category
        ]);
    }

}
