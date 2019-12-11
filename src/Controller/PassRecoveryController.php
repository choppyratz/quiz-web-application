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
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class PassRecoveryController extends AbstractController
{
    public function sendMessage(MailerInterface $mailer, string $message)
    {
        $email = (new Email())
            ->from('rfeg@gsd.gg')
            ->to('esg@grjglk.com')
            ->text($message);

        $mailer->send($email); 
    }

    /**
     * @Route("/recovery", name="pass_recovery")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        if ($this->isGranted('ROLE_USER')) {
            $response = new RedirectResponse('/');
			$response->prepare($request);
			return $response->send();
        }
        
        $user = new User();
        $form = $this->createForm(PassRecoveryType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $email = $user->getEmail();
            if ($this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(['email' => $email])) {
                $this->sendMessage($mailer, 'test2143t4');
                return $this->redirectToRoute('newp', [
                    'email' => $email
                ]);
            }
        }
            
        return $this->render('pass_recovery/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
