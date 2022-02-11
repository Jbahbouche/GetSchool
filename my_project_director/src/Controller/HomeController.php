<?php

namespace App\Controller;

use App\Repository\NoteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        if ($this->getUser()) {

            if(!$this->getUser()->getActif()){
                $this->addFlash(
                    'danger',
                    "Votre compte n'est pas activé"
                );
                return $this->redirectToRoute('app_logout');
            }  
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
}
