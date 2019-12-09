<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        $session = new Session();
        $session->start();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'email' => $session->get('email')
        ]);
    }
}
