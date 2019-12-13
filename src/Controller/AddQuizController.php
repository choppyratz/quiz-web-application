<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddQuizController extends AbstractController
{
    /**
     * @Route("/admin/addquiz", name="add_quiz")
     */
    public function index()
    {
        return $this->render('add_quiz/index.html.twig', [
            'controller_name' => 'AddQuizController',
        ]);
    }
}
