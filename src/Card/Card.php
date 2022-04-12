<?php

namespace App\Card;

class Card
{
    protected $id;
    public $value;
    public $suite;
    private $suites = ["♠", "♥", "♦", "♣", "🂿"];
    private $values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];

    public function __construct($id)
    {
        $this->id = $id;
        $this->suite = $this->suites[floor($id / 13)];
        if ($id > 51) {
            $this->value = "Joker";
        }
        else {
            $this->value = $this->values[$id % 13];
        }
    }
}
