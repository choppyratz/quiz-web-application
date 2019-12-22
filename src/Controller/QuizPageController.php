<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;


class QuizPageController extends AbstractController
{
    /**
     * @Route("/quiz/{id}", name="quiz_page")
     */
    public function index($id, Request $request, Security $security)
    {
        $user = $security->getUser();
        if ($request->isXmlHttpRequest()) {
            $data = json_decode($request->getContent());
            if (!empty($data)) {
                $em = $this->getDoctrine()->getManager();
                $updQuizInfo = $em->getRepository(User::class)->findOneBy(['email' => $user->getUsername()]);
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

                if (isset($data[4])) {
                    $TrueAnsCount = 0;
                    $RatingArr = [];
                    for ($i = 0; $i < count($quizesInfo[$data[2]][0]); $i++) 
                        if ($quizesInfo[$data[2]][0][$i] == "true") 
                            $TrueAnsCount++;
                    
                    $RatingArr[0] = $TrueAnsCount;
                    //$em = $this->getDoctrine()->getManager();
                    $Quiz = $em->getRepository(Quiz::class)->find($id);
                    $Rating = $Quiz->getRating();
                    if (!isset($Rating[$user->getUsername()])){
                        $Rating[$user->getUsername()] = []; 
                        $Rating[$user->getUsername()][0] = $TrueAnsCount;   
                    }
                    $Quiz->setRating($Rating);
                    $em->persist($updQuizInfo);
                    $em->flush();
                    return new JsonResponse($Rating);
                }
                return new JsonResponse($data[3]);    
            }

            $em = $this->getDoctrine()->getManager();
            $resultQuery = $em->getRepository(Quiz::class)->find($id);
            $UserQuizInfo = $em->getRepository(User::class)->findOneBy(['email' => $user->getUsername()]);
            if (!isset($UserQuizInfo->getQuizesInfo()[$id])) {
                $QuizInfo = $resultQuery->getQuizInfo();
                $OldInfo = $UserQuizInfo->getQuizesInfo();
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
