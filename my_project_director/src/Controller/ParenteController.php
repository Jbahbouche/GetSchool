<?php

namespace App\Controller;

use App\Entity\Parente;
use App\Form\ParenteType;
use App\Repository\ParenteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/parente')]
class ParenteController extends AbstractController
{
    #[Route('/', name: 'parente_index', methods: ['GET'])]
    public function index(ParenteRepository $parenteRepository): Response
    {
        return $this->render('parente/index.html.twig', [
            'parentes' => $parenteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'parente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $parente = new Parente();
        $form = $this->createForm(ParenteType::class, $parente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($parente);
            $entityManager->flush();

            return $this->redirectToRoute('parente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parente/new.html.twig', [
            'parente' => $parente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'parente_show', methods: ['GET'])]
    public function show(Parente $parente): Response
    {
        return $this->render('parente/show.html.twig', [
            'parente' => $parente,
        ]);
    }

    #[Route('/{id}/edit', name: 'parente_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Parente $parente, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParenteType::class, $parente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('parente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parente/edit.html.twig', [
            'parente' => $parente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'parente_delete', methods: ['POST'])]
    public function delete(Request $request, Parente $parente, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parente->getId(), $request->request->get('_token'))) {
            $entityManager->remove($parente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parente_index', [], Response::HTTP_SEE_OTHER);
    }
}
