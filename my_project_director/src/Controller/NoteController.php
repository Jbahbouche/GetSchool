<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\Repository\NoteRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/note')]
class NoteController extends AbstractController
{
    #[Route('/', name: 'note_index', methods: ['GET'])]
    public function index(NoteRepository $noteRepository): Response
    {
        return $this->render('note/index.html.twig', [
            'notes' => $noteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'note_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserRepository $usersRepo): Response
    {
        

        $users= $usersRepo->findBy(['classe_id' => $this->getUser()->getClasseId()->getId()],['roles'=> 'DESC']);
        
        $note = new Note();
        $form = $this->createForm(NoteType::class, $note);
        
        $form->handleRequest($request);


        if (isset($_GET['etudiant']) && isset($_GET['score']) && isset($_GET['matiere']) && isset($_GET['commentaire'])) {
            
            $note->setProfId($this->getUser());
            $note->setEtudiantId($usersRepo->find(intval($_GET["etudiant"])));
            $note->setScore($_GET["score"]);
            $note->setMatiere($_GET["matiere"]);
            $note->setCommentaire($_GET["commentaire"]);
            $entityManager->persist($note);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Note Ajoutée'
            );
            return $this->redirectToRoute('note_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('note/new.html.twig', [
            'note' => $note,
            'form' => $form,
            'users' => $users
        ]);
    }

    #[Route('/{id}', name: 'note_show', methods: ['GET'])]
    public function show(Note $note): Response
    {
        return $this->render('note/show.html.twig', [
            'note' => $note,
        ]);
    }

    #[Route('/{id}/edit', name: 'note_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Note $note, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('note_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('note/edit.html.twig', [
            'note' => $note,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'note_delete', methods: ['POST'])]
    public function delete(Request $request, Note $note, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$note->getId(), $request->request->get('_token'))) {
            $entityManager->remove($note);
            $entityManager->flush();
        }

        return $this->redirectToRoute('note_index', [], Response::HTTP_SEE_OTHER);
    }
}
