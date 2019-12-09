<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
    	$user = new User();
    	$form = $this->createForm(UserType::class, $user);

    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
    		$password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
    		$user->setPassword($password);

    		$em = $this->getDoctrine()->getManager();
    		$em->persist($user);
			$em->flush();

			$response = new RedirectResponse('/login');
			$response->prepare($request);
		
			return $response->send();
    	}

        return $this->render('registration/registration.html.twig', [
        		'form' => $form->createView()
        ]);
    }
}
