<?php

namespace App\Controller;

use App\Entity\GameKey;
use App\Form\GameKey1Type;
use App\Form\GameKeyType;
use App\Repository\GameKeyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration/cle-cd")
 */
class GameKeyController extends AbstractController
{
    /**
     * @Route("/", name="game_key_index", methods={"GET"})
     */
    public function index(GameKeyRepository $gameKeyRepository): Response
    {
        return $this->render('game_key/index.html.twig', [
            'game_keys' => $gameKeyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="game_key_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $gameKey = new GameKey();
        $form = $this->createForm(GameKeyType::class, $gameKey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($gameKey);
            $entityManager->flush();

            return $this->redirectToRoute('game_key_index');
        }

        return $this->render('game_key/new.html.twig', [
            'game_key' => $gameKey,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="game_key_show", methods={"GET"})
     */
    public function show(GameKey $gameKey): Response
    {
        return $this->render('game_key/show.html.twig', [
            'game_key' => $gameKey,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="game_key_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GameKey $gameKey): Response
    {
        $form = $this->createForm(GameKeyType::class, $gameKey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('game_key_index');
        }

        return $this->render('game_key/edit.html.twig', [
            'game_key' => $gameKey,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="game_key_delete", methods={"DELETE"})
     */
    public function delete(Request $request, GameKey $gameKey): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gameKey->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($gameKey);
            $entityManager->flush();
        }

        return $this->redirectToRoute('game_key_index');
    }
}
