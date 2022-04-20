<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class GameControllerTwig extends AbstractController
{
    /**
     * @Route("/game", name="game")
     */
    public function game(): Response
    {
        $data = [
            'title' => "Game",
            'link_to_doc' => $this->generateUrl('doc'),
            'link_to_play' => $this->generateUrl('play'),
        ];
        return $this->render('/game/game.html.twig', $data);
    }

    /**
     * @Route("/game/doc", name="doc")
     */
    public function doc(): Response
    {
        return $this->render('/game/doc.html.twig', [
            'title' => "Documentation",
        ]);
    }

    /**
     * @Route("/game/play",
     * name="play",
     * methods={"GET","HEAD"}
     *)
     */
    public function play(): Response
    {
        session_start();
        if (!isset($_SESSION['game'])) {
            $_SESSION['game'] = new \App\Game\Game();
        }
        $game = $_SESSION['game'];
        $title = "Game";
        return $this->render('/game/play.html.twig', [
            'title' => $title,
            'game' => $game,
        ]);
    }

    /**
     * @Route(
     *      "/game/play",
     *      name="form-play",
     *      methods={"POST"}
     * )
     */
    public function playProcess(Request $request): Response
    {
        $game = $_SESSION['game'];
        $draw  = $request->request->get('draw');
        $stop  = $request->request->get('stop');
        $restart  = $request->request->get('restart');
        if ($draw) {
            $game->drawCard();
            if ($game->playerscore == 21) {
                $game->bankCard();
            }
        } elseif ($stop) {
            $game->bankCard();
        } elseif ($restart) {
            session_destroy();
        }
        $_SESSION['game'] = $game;
        return $this->redirectToRoute('play');
    }
}
