<?php

namespace App\Card;

use App\Card\Card;

class Player
{
    public $hand;
    public $name;

    public function __construct($id)
    {
        $this->name = $id;
    }

    public function getHand($cards)
    {
        $this->hand = $cards;
    }

}
