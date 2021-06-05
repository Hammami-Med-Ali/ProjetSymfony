<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PayementController extends AbstractController
{
    /**
     * @Route("/payement", name="payement")
     */
    public function index(): Response
    {
        return $this->render('payement/index.html.twig', [
            'controller_name' => 'PayementController',
        ]);
    }
     /**
     * @Route("/checkout", name="checkout")
     */
    public function checkout()
    {
        //recupération de clé privé
        \Stripe\Stripe::setApiKey('sk_test_51IwFOmADE3jmpw8FRLoKIRhrfWTH81QQIFJc4TOsFLUvOiR3BG4zVzXVYv9ybUmnMTQI7PwQuJONIR4erc2mYfVv00vnSp8Rxb');
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                  'name' => 'HP Computer',
                ],
                'unit_amount' => 2000,
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' =>'http://127.0.0.1:8000/success',
            'cancel_url' => 'http://127.0.0.1:8000/error',
          ]);
    }

    /**
     * @Route("/success", name="success")
     */
    public function success(): Response
    {
        return $this->render('payement/success.html.twig', [
            'controller_name' => 'PayementController',
        ]);
    }
    /**
     * @Route("/error", name="error")
     */
    public function error(): Response
    {
        return $this->render('payement/error.html.twig', [
            'controller_name' => 'PayementController',
        ]);
        return new JsonResponse(['id' => $session->id ]);
    }
}
