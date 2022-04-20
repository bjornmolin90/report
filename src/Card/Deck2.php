<?php

namespace App\Card;

use App\Card\Card;

class Deck2 extends Deck
{
    public function __construct()
    {
        foreach (range(0, 53) as $index) {
            $this->deck[$index] = new \App\Card\Card($index);
        }
    }
}
