<?php

namespace App\Card;

use App\Card\Card;

class Player
{
    public $hand = array();
    public $name;

    public function __construct($id)
    {
        $this->name = $id;
    }

    public function getHand($cards)
    {
        $this->hand = $cards;
    }

    public function addCard($card)
    {
        $this->hand[] = $card;
    }
}
