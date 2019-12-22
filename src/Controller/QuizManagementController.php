<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuizManagementController extends AbstractController
{
    /**
     * @Route("/admin/quizmanage", name="quiz_management")
     */
    public function index()
    {
        return $this->render('quiz_management/index.html.twig', [
            'controller_name' => 'QuizManagementController',
        ]);
    }
}
