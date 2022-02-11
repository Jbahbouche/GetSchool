<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessageController extends AbstractController
{
    #[Route('/message', name: 'message')]
    public function index(): Response
    {
        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
        ]);
    }

    #[Route("/send", name:"send", methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {   dd(new \DateTimeImmutable('NOW'));
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $message->setCreatedAt(new \DateTimeImmutable('now'));
            
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('message', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render("message/send.html.twig", [
            "form" => $form->createView()
        ]);

        
    }
    // public function send(Request $request): Response
    // {

    //     $message = new Message;
    //     $form = $this->createForm(MessageType::class, $message);


    //     $form->handleRequest($request);

    //     if($form->isSubmitted() && $form->isValid()){
    //         $message->setEnvoiId($this->getUser());

            

    //         $this->addFlash("message", "Le message a été envoyé avec succès.");
    //         return $this->redirectToRoute("message");
    //     }

    

               


       
    
}
