<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
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
            $data = json_decode($request->getContent());
            if (!empty($data)) {
                $em = $this->getDoctrine()->getManager();
                $updQuizInfo = $em->getRepository(User::class)->findOneBy(['email' => 'choppyratz@gmail.com']);
                $quizesInfo = $updQuizInfo->getQuizesInfo();
                if (!isset($quizesInfo[$data[2]])) {
                    for ($i = 0; $i < $data[3] + 1; $i++) {
                        $quizesInfo[$data[2]][0][$i] = "not";
                    }
                }
                $quizesInfo[$data[2]][0][$data[1]] = $data[0];
                $updQuizInfo->setQuizesInfo($quizesInfo);
                $em->persist($updQuizInfo);
                $em->flush();
                return new JsonResponse($data[2][0]);    
            }
            $em = $this->getDoctrine()->getManager();
            $resultQuery = $em->getRepository(Quiz::class)->find($id);
            $UserQuizInfo = $em->getRepository(User::class)->findOneBy(['email' => 'choppyratz@gmail.com']);
            if (!isset($UserQuizInfo->getQuizesInfo()[$id])) {
                $QuizInfo = $resultQuery->getQuizInfo();
                $OldInfo = $UserQuizInfo->getQuizesInfo();
                //$OldInfo[$id] = [[],[]];
                $narr = [];
                for ($i = 0; $i < count($QuizInfo); $i++) {
                    $narr[$i] = "not";
                }
                $OldInfo[$id][0] = $narr;

                $UserQuizInfo->setQuizesInfo($OldInfo);
                $em->persist($UserQuizInfo);
                $em->flush();
            }
            $quiz = ['name' => $resultQuery->getName(), 'quiz_body' => $resultQuery->getQuizInfo(), 'curr_res' => $UserQuizInfo->getQuizesInfo()[$id]];
            return new JsonResponse($quiz);
        }else
            return $this->render('quiz_page/index.html.twig', [
                'controller_name' => 'QuizPageController',

            ]);
    }
}
