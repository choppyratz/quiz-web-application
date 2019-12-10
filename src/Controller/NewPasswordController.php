<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\NewPasswordType;
use Symfony\Component\HttpFoundation\Request;

class NewPasswordController extends AbstractController
{
    /**
     * @Route("/newp/{email}", name="new_password")
     */
    public function index($email, Request $request)
    {
    	$user = new User();
    	$entityManager = $this->getDoctrine()->getManager();
    	$record = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        $form = $this->createForm(NewPasswordType::class, $user); 
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $someRecord->setPassword($password);

            $entityManager->flush();
        }

        return $this->render('new_password/index.html.twig', [
        	'form' => $form->createView()
        ]);
    }
}
