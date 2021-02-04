<?php

namespace App\Controller;

use App\Entity\VideoGame;
use App\Repository\VideoGameRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, VideoGameRepository $videoGameRepository): Response
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        $cartCounter = 0;
        if(!is_null($panier)){
            $cartCounter = count($panier);
        }
        return $this->render('home/index.html.twig', ['games' => $videoGameRepository->findAll(), 'cartCounter' => $cartCounter]);
    }

    /**
     * @Route("/jeu/{slug}", name="gameDetails")
     */
    public function gameDetails(Request $request, VideoGame $videoGame): Response
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        $cartCounter = 0;
        if(!is_null($panier)){
            $cartCounter = count($panier);
        }
        return $this->render('home/details.html.twig', ['game' => $videoGame, 'cartCounter' => $cartCounter]);
    }

    /**
     * @Route("/tous-les-jeux", name="allGames")
     */
    public function allGames(Request $request, VideoGameRepository $videoGameRepository): Response
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        $cartCounter = 0;
        if(!is_null($panier)){
            $cartCounter = count($panier);
        }
        return $this->render('home/allgames.html.twig', ['games' => $videoGameRepository->findAll(), 'cartCounter' => $cartCounter]);
    }

    /**
     * @Route("/panier", name="cart")
     */
    public function cart(Request $request, VideoGameRepository $videoGameRepository): Response
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        $cartCounter = 0;
        if(!is_null($panier)){
            $cartCounter = count($panier);
        }
        $data = [];
        $games = [];
        $total = 0;
        foreach($panier as $key=>$value) {
            $game = $videoGameRepository->find($key);
            $total = $total + ($game->getPrice() * $value);
            $games[] = [
                "game" => $videoGameRepository->find($key),
                "qty" => $value,
                "total" => $total
            ];

        }
        return $this->render('home/cart.html.twig', ['cartCounter' => $cartCounter, 'games' => $games]);
    }

    /**
     * @Route("/administration", name="admin_home")
     */
    public function adminHome(): Response
    {
        return $this->render('home/admin.html.twig');
    }
}
