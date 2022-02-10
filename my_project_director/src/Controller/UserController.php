<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\User1Type;
use App\Repository\UserRepository;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            /* 'users' => $userRepository->findAll(), */
            'users' => $userRepository->findBy([], ['roles'=> 'ASC'])
        ]);
    }

    #[Route('/new', name: 'user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mdp = $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($mdp);
            $user->setActif(true);
            $user->setRoles(["ROLE_GEST"]);
            
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager, ClasseRepository $classe): Response
    {
        
        if ($_GET) {
            
            if (isset($_GET['role']) && isset($_GET['classe'])){
                $role=[];
                $role=[$_GET['role']];
                $user->setRoles($role);
                $user->setClasseId($classe->find($_GET['classe']));
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
            }
            if (isset($_GET['actif'])){
                if ($_GET['actif'] == "false"){
                    $user->setActif(false);
                } else {
                    $user->setActif(true);
                }
                
                
                $entityManager->persist($user);
                $entityManager->flush();
    
                return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);  
            }
            
            
            
        }
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);
        
        /* if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        } */

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'classes' => $classe->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }


    /* #[Route('/affectation', name: 'user_affectation', methods: ['GET'])]
    public function affectation(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher): Response
    {
        

        return $this->renderForm('user/affectation.html.twig', );
    } */

}
