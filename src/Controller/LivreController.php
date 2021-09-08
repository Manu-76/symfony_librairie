<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Repository\LivreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivreController extends AbstractController
{
    /** La méthode index recoit une injection de dependance qui correspond à la repository des livres 
     *  puisque cette méthode est censée lister tous les livres
     */
    #[Route('/livre', name: 'livre')]
    public function index(LivreRepository $livreRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $livres = $livreRepository->findAll();
        $pagination = $paginator->paginate(
            $livres, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );
        
        // La méthode render attend 2 paramètres, la vue à renvoyer et dnas un tableau associatif la ou les variables utilisables par le twig et leurs valeurs
        return $this->render('livre/index.html.twig', [
            'livres' => $pagination,
        ]);
    }
    
    #[Route('/livre/search', name: 'search-livre', methods: ['GET'])]

    public function search(LivreRepository $livreRepository, PaginatorInterface $paginator, Request $request):Response
    {
        $value = $request->query->get("search-value"); // On cherche dans la requête (barre d'adresse) une variable nommée search-value issue d'un name d'input de formulaire
        // dd($value); //dd = dump and die

        // Recherche sans pagination
        // $livres = $livreRepository->search($value);
        // return $this->render('livre/search.html.twig', ["livres"=>$livres]);

        // Recherche avec paginator
        $livres = $livreRepository->searchForPaginator($value);
        $pagination = $paginator->paginate(
            $livres, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            1 /*limit per page*/
        );

        return $this->render('livre/index.html.twig', ["livres"=>$pagination]);
        // return new Response("coucou");
    }

    /**  La route déclarée est une route contenant une partie dynamique (slug) d'ou l'utilisation des {} *dans la déclaration. Il faut penser à donner un nom à la route. Pour connaitre les routes déjà *existantes on peut faire appel à php bin/console debug:router
    */
    #[Route('/livre/{slug}', name: 'livre-detail')]
    
    public function detail(LivreRepository $livreRepository, int $slug): Response
    {
        return $this->render('livre/detail.html.twig', ["livre" =>$livreRepository->find($slug)]);
    }
}
