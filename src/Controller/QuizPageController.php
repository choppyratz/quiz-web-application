<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuizPageController extends AbstractController
{
    /**
     * @Route("/quiz/{id}", name="quiz_page")
     */
    public function index($id)
    {

        return $this->render('quiz_page/index.html.twig', [
            'controller_name' => 'QuizPageController',
            'id' => $id
        ]);
    }
}
