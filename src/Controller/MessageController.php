<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\HttpException ;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="message")
     */
    public function index(string $flashy)
    {
        $flashy->success('Event created!','http://your-awesome-link.com');
        return $this->rediredtToRoute('about');
        
    }
     /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('message/about.html.twig');
    }
}
/* FlashyNotifier */