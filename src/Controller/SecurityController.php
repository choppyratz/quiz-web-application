<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login", methods={"GET", "POST"})
     */
    public function login(Request $request, AuthenticationUtils $utils): Response
    {
        //if ($this->isGranted('ROLE_USER')) {
        //    $response = new RedirectResponse('/');
		//	$response->prepare($request);
		//	return $response->send();
        //}
        $error = $utils->getLastAuthenticationError();

        $lastUserName = $utils->getLastUsername();


        return $this->render('security/login.html.twig', [
            'error' => $error,
            'lastUserName' => $lastUserName
        ]);
    }
}
