<?php

namespace App\Controller;

use App\Entity\ProgNutri;
use App\Form\ProgNutriType;
use App\Repository\ProgNutriRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prog/nutri")
 */
class ProgNutriController extends AbstractController
{
    /**
     * @Route("/", name="prog_nutri_index", methods={"GET"})
     */
    public function index(ProgNutriRepository $progNutriRepository): Response
    {
        return $this->render('prog_nutri/index.html.twig', [
            'prog_nutris' => $progNutriRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="prog_nutri_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $progNutri = new ProgNutri();
        $form = $this->createForm(ProgNutriType::class, $progNutri);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($progNutri);
            $entityManager->flush();

            return $this->redirectToRoute('prog_nutri_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prog_nutri/new.html.twig', [
            'prog_nutri' => $progNutri,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prog_nutri_show", methods={"GET"})
     */
    public function show(ProgNutri $progNutri): Response
    {
        return $this->render('prog_nutri/show.html.twig', [
            'prog_nutri' => $progNutri,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="prog_nutri_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ProgNutri $progNutri, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProgNutriType::class, $progNutri);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('prog_nutri_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prog_nutri/edit.html.twig', [
            'prog_nutri' => $progNutri,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prog_nutri_delete", methods={"POST"})
     */
    public function delete(Request $request, ProgNutri $progNutri, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$progNutri->getId(), $request->request->get('_token'))) {
            $entityManager->remove($progNutri);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prog_nutri_index', [], Response::HTTP_SEE_OTHER);
    }
}
