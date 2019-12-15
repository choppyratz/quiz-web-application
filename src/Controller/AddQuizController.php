<?php

namespace App\Controller;

use App\Entity\Quiz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class AddQuizController extends AbstractController
{
    /**
     * @Route("/admin/addquiz", name="add_quiz")
     */
    public function index(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $data = json_decode($request->getContent());
            $quiz = new Quiz();
            $quiz->setQuizInfo($data->quiz_body);
            $quiz->setName($data->name);
            $quiz->setRegistrationTime(date("Y-m-d H:i:s"));
            $quiz->setisActive(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($quiz);
            $em->flush();
            return new JsonResponse($data);    
        }

        return $this->render('add_quiz/index.html.twig', [
            'controller_name' => 'AddQuizController',
        ]);
    }
}
