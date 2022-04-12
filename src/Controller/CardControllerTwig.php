<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardControllerTwig extends AbstractController
{
    /**
     * @Route("/card", name="card")
     */
    public function card(): Response
    {
        $data = [
            'title' => "Card",
            'link_to_deck' => $this->generateUrl('deck'),
            'link_to_shuffle' => $this->generateUrl('shuffle'),
            'link_to_draw' => $this->generateUrl('draw'),
        ];
        return $this->render('/card/card.html.twig', $data);
    }

    /**
     * @Route("/deck", name="deck")
     */
    public function deck(): Response
    {
        $deck = new \App\Card\Deck();
        $title = "Deck";
        return $this->render('/card/deck.html.twig', [
            'title' => $title,
            'deck' => $deck,
        ]);
    }

    /**
     * @Route("/deck/shuffle", name="shuffle")
     */
    public function shuffle(): Response
    {
        session_name('card');
        session_start();
        $_SESSION['deck'] = new \App\Card\Deck();
        $deck = $_SESSION['deck'];
        $deck->shuffle();
        $title = "Deck";

        return $this->render('/card/shuffle.html.twig', [
            'title' => $title,
            'deck' => $deck,
        ]);
    }

    /**
     * @Route("/deck/draw", name="draw")
     */
    public function draw(): Response
    {
        session_name('card');
        session_start();
        if (!isset($_SESSION['deck'])) {
            $_SESSION['deck'] = new \App\Card\Deck();
        }
        $deck = $_SESSION['deck'];
        $card = $deck->draw();
        $length = $deck->length();
        $title = "Draw";
        $_SESSION['deck'] = $deck;
        return $this->render('/card/draw.html.twig', [
            'title' => $title,
            'card' => $card,
            'length' => $length,
        ]);
    }

    /**
     * @Route("/deck/draw/{numDraws}", name="num-draws")
     */
    public function drawCards(int $numDraws): Response
    {
        session_name('card');
        session_start();
        if (!isset($_SESSION['deck'])) {
            $_SESSION['deck'] = new \App\Card\Deck();
        }
        $deck = $_SESSION['deck'];
        $cards = $deck->draws($numDraws);
        $length = $deck->length();
        $title = "Draw cards";
        $_SESSION['deck'] = $deck;
        return $this->render('/card/draw-cards.html.twig', [
            'title' => $title,
            'cards' => $cards,
            'length' => $length,
        ]);
    }

    /**
     * @Route("/deck/deal/{numPlayers}/{numCards}", name="deal")
     */
    public function dealCards(int $numPlayers, int $numCards): Response
    {
        $deck = new \App\Card\Deck();
        for ($i=0; $i<$numPlayers; $i++) {
            $players[$i] = new \App\Card\Player($i);
            $players[$i]->getHand($deck->draws($numCards));
        }
        $length = $deck->length();
        $title = "Play cards";
        return $this->render('/card/play-cards.html.twig', [
            'title' => $title,
            'players' => $players,
            'length' => $length,
        ]);
    }

    /**
     * @Route("/deck2", name="deck2")
     */
    public function deck2(): Response
    {
        $deck = new \App\Card\Deck2();
        $title = "Deck2";
        return $this->render('/card/deck2.html.twig', [
            'title' => $title,
            'deck' => $deck,
        ]);
    }
}
