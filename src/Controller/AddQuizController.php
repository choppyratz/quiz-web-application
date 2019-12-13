<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AddQuizController extends AbstractController
{
    /**
     * @Route("/admin/addquiz", name="add_quiz")
     */
    public function index(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            
        }
        return $this->render('add_quiz/index.html.twig', [
            'controller_name' => 'AddQuizController',
        ]);
    }
}
