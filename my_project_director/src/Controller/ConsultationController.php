<?php

namespace App\Controller;

use App\Repository\NoteRepository;
use App\Repository\ParenteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConsultationController extends AbstractController
{
    #[Route('/consultation', name: 'consultation')]
    public function consultation(NoteRepository $noteRepo, ParenteRepository $parentRepo): Response
    {
        if($this->getUser()->getRoles()==["ROLE_ETU"]){
            $notes=$noteRepo->findBy(['etudiant_id' => $this->getUser()]);
            $etudiant = $this->getUser();
        }
        if($this->getUser()->getRoles()==["ROLE_PARENT"]){
            $etudiant = $parentRepo->findOneBy(['parent' => $this->getUser()])->getEnfant();
            
            $notes=$noteRepo->findBy(['etudiant_id' => $etudiant]);
        }
        
        return $this->render('consultation/index.html.twig', [
            'notes' => $notes,
            'etudiant' => $etudiant
        ]);
    }
}
