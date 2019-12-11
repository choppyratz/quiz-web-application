<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LogoutController extends AbstractController
{
    /**
     * @Route("/logout", name="logout", methods={"GET"})
     */
    public function logout()
    {
		
    }
}