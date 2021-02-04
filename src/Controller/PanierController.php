<?php

namespace App\Controller;

use App\Entity\VideoGame;
use App\Repository\VideoGameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/add/{id}", name="addToCart", methods={"POST"})
     */
    public function add($id, Request $request, VideoGameRepository $videoGameRepository): Response
    {

        $session = $request->getSession();
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id] = $panier[$id] + 1;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);
        return $this->redirectToRoute('cart');
    }


    /**
     * @Route("/remove/{id}", name="removeToCart", methods={"POST"})
     */
    public function remove($id, Request $request, VideoGameRepository $videoGameRepository): Response
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        } else {
        }

        $session->set('panier', $panier);
        return $this->redirectToRoute('cart');
    }


    /**
     * @Route("/add-qty", name="addQty", methods={"POST"})
     */
    public function addQty(Request $request, VideoGameRepository $videoGameRepository): Response
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);
        $params = json_decode($request->getContent(), true);

        if ($params['qty'] == 1) {
            $panier[$params['id']] = $panier[$params['id']] + $params['qty'];
        } else if($params['qty'] == 0) {
            unset($panier[$params['id']]);
                $session->set('panier', $panier);
                return $this->json(['redirect'=> 1]);
        }
        else {
            $panier[$params['id']] = $params['qty'];
        }
        $game = $videoGameRepository->find($params['id']);
        $total = $game->getPrice() * $panier[$params['id']];
        $session->set('panier', $panier);


        return $this->json(['status' => 200, "message" => "La quantité a bien été modifiée", "qty" => $panier[$params['id']], "total" => $total], 200);
    }


    /**
     * @Route("/remove-qty", name="removeQty", methods={"POST"})
     */
    public function removeQty(Request $request, VideoGameRepository $videoGameRepository): Response
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);
        $params = json_decode($request->getContent(), true);

        if ($params['qty'] == 1) {
            if($panier[$params['id']] == 1){
                unset($panier[$params['id']]);
                $session->set('panier', $panier);
                return $this->json(['redirect'=> 1]);
            }
            else{
                $panier[$params['id']] = $panier[$params['id']] - $params['qty'];
            }
            
        }
        $game = $videoGameRepository->find($params['id']);
        $total = $game->getPrice() * $panier[$params['id']];
        $session->set('panier', $panier);


        return $this->json(['status'=> 200, "message" =>"La quantité a bien été modifiée", "qty"=>$panier[$params['id']], "total"=>$total], 200);
    }
}
