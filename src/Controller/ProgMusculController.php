<?php

namespace App\Controller;

use App\Entity\ProgMuscul;
use App\Form\ProgMusculType;
use App\Repository\ProgMusculRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prog/muscul")
 */
class ProgMusculController extends AbstractController
{
    /**
     * @Route("/", name="prog_muscul_index", methods={"GET"})
     */
    public function index(ProgMusculRepository $progMusculRepository): Response
    {
        return $this->render('prog_muscul/index.html.twig', [
            'prog_musculs' => $progMusculRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="prog_muscul_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $progMuscul = new ProgMuscul();
        $form = $this->createForm(ProgMusculType::class, $progMuscul);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($progMuscul);
            $entityManager->flush();

            return $this->redirectToRoute('prog_muscul_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prog_muscul/new.html.twig', [
            'prog_muscul' => $progMuscul,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prog_muscul_show", methods={"GET"})
     */
    public function show(ProgMuscul $progMuscul): Response
    {
        return $this->render('prog_muscul/show.html.twig', [
            'prog_muscul' => $progMuscul,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="prog_muscul_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ProgMuscul $progMuscul, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProgMusculType::class, $progMuscul);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('prog_muscul_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prog_muscul/edit.html.twig', [
            'prog_muscul' => $progMuscul,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prog_muscul_delete", methods={"POST"})
     */
    public function delete(Request $request, ProgMuscul $progMuscul, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$progMuscul->getId(), $request->request->get('_token'))) {
            $entityManager->remove($progMuscul);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prog_muscul_index', [], Response::HTTP_SEE_OTHER);
    }
}
