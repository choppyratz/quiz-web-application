<?php

namespace App\Controller;

use App\Entity\Quiz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuizPageController extends AbstractController
{
    /**
     * @Route("/quiz/{id}", name="quiz_page")
     */
    public function index($id, Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $resultQuery = $this->getDoctrine()->getManager()->getRepository(Quiz::class)->find($id);
            $quiz = ['name' => $resultQuery->getName(), 'quiz_body' => $resultQuery->getQuizInfo()];
            return new JsonResponse($quiz);
        }else
            return $this->render('quiz_page/index.html.twig', [
                'controller_name' => 'QuizPageController',
                //'id' => $quiz,

            ]);
    }
}
