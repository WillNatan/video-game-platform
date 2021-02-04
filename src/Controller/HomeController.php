<?php

namespace App\Controller;

use App\Entity\VideoGame;
use App\Repository\VideoGameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(VideoGameRepository $videoGameRepository): Response
    {
        return $this->render('home/index.html.twig', ['games' => $videoGameRepository->findAll()]);
    }

    /**
     * @Route("/jeu/{slug}", name="gameDetails")
     */
    public function gameDetails(VideoGame $videoGame): Response
    {
        return $this->render('home/details.html.twig', ['game' => $videoGame]);
    }

    /**
     * @Route("/tous-les-jeux", name="allGames")
     */
    public function allGames(VideoGameRepository $videoGameRepository): Response
    {
        return $this->render('home/allgames.html.twig', ['games' => $videoGameRepository->findAll()]);
    }

    /**
     * @Route("/panier", name="cart")
     */
    public function cart(): Response
    {
        return $this->render('home/cart.html.twig');
    }

    /**
     * @Route("/administration", name="admin_home")
     */
    public function adminHome(): Response
    {
        return $this->render('home/admin.html.twig');
    }
}
