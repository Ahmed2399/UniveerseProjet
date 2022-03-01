<?php

namespace App\Controller;

use App\Entity\Exc;
use App\Form\Exc1Type;
use App\Repository\ExcRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/exc")
 */
class ExcController extends AbstractController
{
    /**
     * @Route("/", name="exc_index", methods={"GET"})
     */
    public function index(ExcRepository $excRepository): Response
    {
        return $this->render('exc/index.html.twig', [
            'excs' => $excRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="exc_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $exc = new Exc();
        $form = $this->createForm(Exc1Type::class, $exc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($exc);
            $entityManager->flush();

            return $this->redirectToRoute('exc_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exc/new.html.twig', [
            'exc' => $exc,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exc_show", methods={"GET"})
     */
    public function show(Exc $exc): Response
    {
        return $this->render('exc/show.html.twig', [
            'exc' => $exc,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="exc_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Exc $exc, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Exc1Type::class, $exc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('exc_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exc/edit.html.twig', [
            'exc' => $exc,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exc_delete", methods={"POST"})
     */
    public function delete(Request $request, Exc $exc, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exc->getId(), $request->request->get('_token'))) {
            $entityManager->remove($exc);
            $entityManager->flush();
        }

        return $this->redirectToRoute('exc_index', [], Response::HTTP_SEE_OTHER);
    }
}
