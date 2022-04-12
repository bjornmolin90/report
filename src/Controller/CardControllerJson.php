<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CardControllerJson
{
    private $deck;



    /**
     * @Route("/card/api/deck")
     */
    public function deck(): Response
    {
        $this->deck = new \App\Card\Deck();

        $data = [
            'Deck' => $this->deck
        ];

        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
