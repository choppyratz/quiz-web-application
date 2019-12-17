<?php

namespace App\Controller;

use App\Entity\Quiz;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class QuizListController extends AbstractController
{
    /**
     * @Route("/quizes", name="quiz_list")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $appointRepository = $em->getRepository(Quiz::class);
        $appointmentsQuery = $appointRepository->createQueryBuilder('p')
            ->addOrderBy('p.id','DESC')
            ->getQuery(); 
        $appointments = $paginator->paginate($appointmentsQuery, $request->query->getInt('page', 1), 2);
        return $this->render('quiz_list/index.html.twig', [
            'controller_name' => 'AddQuizController',
            'list' => $appointments,
        ]);
    }
}