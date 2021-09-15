<?php

namespace App\Controller;

use App\Form\UserProfileType;
use App\Repository\LivreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'profile')]
    public function index(Request $request, UserPasswordHasherInterface $uphi): Response
    {
        // Mise en place du formulaire permettant la modification des informations de l'utilisateur dans la vue de profile
        // 1. On récupère l'utilisateur connecté
        
        $user = $this->getUser();
        // 2. On instancie un objet (pas le rendu) de formulaire d'après un modèle de formulaire et on l'associe à l'utilisateur
        // Du coup le formulaire est associé aux données de l'utilisateur
        $profileForm = $this->createForm(UserProfileType::class, $user);
        //On vérifie la possibilité d'hydrater le formulaire avec les données se trouvant dans la requête
        $profileForm->handleRequest($request);
        //  Si on a pu hydrater le formulaire, on vérifie s'il est envoyé ET SURTOUT s'il est valide
        if($profileForm->isSubmitted() && $profileForm->isValid()){
            $plainPassword = $profileForm->getData()->getPlainPassword();
            if(!is_null($plainPassword)){
                $encodedPassword = $uphi->hashPassword($user, $plainPassword);
                $user->setPassword($encodedPassword);
                $this->addFlash('warning', "Votre mot de passe a bien été modifié.");
            }
            //  On récupère un entité manager pour pouvoir gérer la mise en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            // On met en place un flashMessage
            $this->addFlash('success', "Vos informations ont bien été mises à jour.");
            // On redirige sur la route profile (oui c'est la même page) ce qui permet à Symfony de supprimer les messages lorsqu'ils ont été affiché par le twig, sinon il reste en mémoire
            // ainsi que les informations du formulaires de l'utilisateur se trouvant dans la request de sorte que si l'on refresh la page, les modifs sont continuellement refaites et les alertes affichées.
            return $this->redirectToRoute("profile");
        }
        return $this->render('profile/index.html.twig', [
            "form"=>$profileForm->createView(),// On passe à la vue le rendu du formulaire
        ]);
    }

    #[Route('/profile/addfavori')]
    public function addFavori(Request $request, LivreRepository $livreRepository):Response
    {
        $livreId = $request->request->get("id"); // On récupère l'id du livre envoyé par ajax
        $livre = $livreRepository->find($livreId); // On récupère le livre
        $user = $this->getUser(); // On récupère le user connecté
        $user->addBookList($livre); // On ajoute la liste de l'utilisateur
        $em = $this->getDoctrine()->getManager();// On récupère un em pour faire un persist et un flush
        $em->persist($user);
        $em->flush();
        return new Response("ok"); // On retourne une réponse
    }

    #[Route('/profile/removefavori/{id}', name: 'deleteLivreListe')]
    public function removeFavori(int $id, LivreRepository $livreRepository):Response
    {
        $livre = $livreRepository->find($id); // On récupère le livre
        $user = $this->getUser(); // On récupère le user connecté
        $user->removeBookList($livre); // On supprime la liste de l'utilisateur
        $em = $this->getDoctrine()->getManager();// On récupère un em pour faire un persist et un flush
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute("profile", []);
    }
}
