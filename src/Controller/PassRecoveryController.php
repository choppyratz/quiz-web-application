<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\PassRecoveryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PassRecoveryController extends AbstractController
{
    /**
     * @Route("/recovery", name="pass_recovery")
     */
    public function index(Request $request): Response
    {
        $user = new User();
        $ema = 'no';
        $form = $this->createForm(PassRecoveryType::class, $user);
        $form->handleRequest($request);
        $email;

        $em = null;
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $task = $form->getData();

            $qb = $user->createQueryBuilder('p')
            ->andWhere('p.price > :task')
            ->setParameter('task', $task)
            ->getQuery();
            $em = $qb->execute();

            //$em = $this->getDoctrine()->getManager();
            //$email = $task->getEmail();

            //$query = $em->createQuery("SELECT id FROM App\Entity\User  WHERE email = '{$task['email']}'");
            //$users = $query->getResult(); 
            //$repository->find();
            //$response = new RedirectResponse('/');
			//$response->prepare($request);
		//
			//return $response->send();
            

        }

        return $this->render('pass_recovery/index.html.twig', [
            'form' => $form->createView(),
            'task' => $em
        ]);
    }
}
