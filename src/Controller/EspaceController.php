<?php

namespace App\Controller;

use App\Entity\Espace;
use App\Form\Espace1Type;
use App\Repository\EspaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/espace")
 */
class EspaceController extends AbstractController
{
    /**
     * @Route("/", name="espace_index", methods={"GET"})
     */
    public function index(EspaceRepository $espaceRepository): Response
    {
        return $this->render('espace/index.html.twig', [
            'espaces' => $espaceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="espace_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $espace = new Espace();
        $form = $this->createForm(Espace1Type::class, $espace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($espace);
            $entityManager->flush();

            return $this->redirectToRoute('espace_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('espace/new.html.twig', [
            'espace' => $espace,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="espace_show", methods={"GET"})
     */
    public function show(Espace $espace): Response
    {
        return $this->render('espace/show.html.twig', [
            'espace' => $espace,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="espace_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Espace $espace, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Espace1Type::class, $espace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('espace_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('espace/edit.html.twig', [
            'espace' => $espace,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="espace_delete", methods={"POST"})
     */
    public function delete(Request $request, Espace $espace, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$espace->getId(), $request->request->get('_token'))) {
            $entityManager->remove($espace);
            $entityManager->flush();
        }

        return $this->redirectToRoute('espace_index', [], Response::HTTP_SEE_OTHER);
    }
}
