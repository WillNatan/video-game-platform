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
}
