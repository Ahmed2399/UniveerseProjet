<?php

namespace App\Controller;
use App\Entity\Utilisateur;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
   


    public function admin()
    {
        

        $users = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll();

        return $this->render('admin/index.html.twig', [
                 'users' => $users
        ]);
    }

}
