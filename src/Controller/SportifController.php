<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SportifController extends AbstractController
{
    /**
     * @Route("/sportif", name="sportif")
     */
    public function index(): Response
    {
        return $this->render('sportif/index.html.twig', [
            'controller_name' => 'SportifController',
        ]);
    }
}
