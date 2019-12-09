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
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\RawMessage;

class PassRecoveryController extends AbstractController
{
    /**
     * @Route("/recovery", name="pass_recovery")
     */
    public function index(Request $request, MailerInterface $mailer, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(PassRecoveryType::class, $user);

        $isInDB = "out";
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $email = $user->getEmail(); 
            $em = $this->getDoctrine()->getManager();
            if (($handle = $em->getRepository(User::class)->findOneBy(['email' => $email]))) {
                $password = $passwordEncoder->encodePassword($user, uniqid());
                $handle->setPassword($password);
                $em->persist($handle);
                $em->flush();
                
                $message = new \Swift_Message('Test email');
                $message->setFrom('nauyokas.bsuir@gmail.com');
                $message->setTo('nauyokas.bsuir@gmail.com');
                $message->setBody('test');

                $mailer->send(new RawMessage('content'));
                //$mailer->send($email);
            }
        }

        return $this->render('pass_recovery/index.html.twig', [
            'form' => $form->createView(),
            'answer' => $isInDB
        ]);
    }
}
