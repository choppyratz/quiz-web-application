<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserManagementController extends AbstractController
{
    /**
     * @Route("/admin/usermanage", name="user_management")
     */
    public function index()
    {
        return $this->render('user_management/index.html.twig', [
            'controller_name' => 'UserManagementController',
        ]);
    }
}
