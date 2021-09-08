<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/user')]
class AdminUserController extends AbstractController
{
    #[Route('/{role}', name: 'admin_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, string $role): Response
    {
        return $this->render('admin_user/index.html.twig', [
            'users' => $userRepository->getByRole($role),
            'title' => ($role == "user") ? 'utilisateurs' : 'administrateurs'
        ]);
    }

    #[Route('/new', name: 'admin_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('admin_user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request); // On hydrate le formulaire, donc le user avec les données contenues dans la requete, ca fonctionne que si on est dans le cas d'un formulaire posté.

        if ($form->isSubmitted() && $form->isValid()) {
            $userForData = $request->request->get("user"); //On récupère les données du formulaire posté dans un tableau
            $roleToCheck = $userForData["role"]; // On récupère la valeur du choiceType de la propriété $role dans le formulaire
            if($roleToCheck==="ROLE_ADMIN"){
                $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
            }else{
                $user->setRoles(["ROLE_USER"]);
            }
            // On flush pour mettre à jour la bdd
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_user_index', ["role"=>"user"], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
