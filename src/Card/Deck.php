<?php

namespace App\Card;

use App\Card\Card;

class Deck
{
    public $deck = [];

    public function __construct()
    {
        foreach (range(0,51) as $index) {
            $this->deck[$index] = new \App\Card\Card($index);
        }
    }

    public function shuffle()
    {
        shuffle($this->deck);
    }

    public function length()
    {
        return count($this->deck);
    }

    public function draw()
    {
        shuffle($this->deck);
        return array_pop($this->deck);
    }

    public function draws($num)
    {
        $drawnCards = array($num);
        shuffle($this->deck);
        for ($i=0; $i<$num; $i++) {
            $drawnCards[$i] = array_pop($this->deck);
        }
        return $drawnCards;
    }

}
