<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuizListController extends AbstractController
{
    /**
     * @Route("/quizes", name="quiz_list")
     */
    public function index()
    {
        return $this->render('quiz_list/index.html.twig', [
            'controller_name' => 'QuizListController',
        ]);
    }
}
