<?php

namespace App\Game;

use App\Card\Deck;
use App\Card\Player;

/**
 * Class Game for the game 21.
 * Uses class Deck and Player for a functioning cardgame.
 */
class Game
{
    public $deck;
    public $player;
    public $bank;
    public $playerscore;
    public $bankscore;
    public $bankPlays;
    public $bankWins;
    public $playerWins;

    public function __construct()
    {
        $this->deck = new \App\Card\Deck();
        $this->player = new \App\Card\Player("Spelare");
        $this->bank = new \App\Card\Player("Bank");
        $this->deck->Shuffle();
        $this->playerscore = 0;
        $this->bankscore = 0;
        $this->bankPlays = false;
        $this->bankWins = false;
        $this->playerWins = false;
    }

    public function drawCard()
    {
        $this->player->addCard($this->deck->draw());
        $this->playerscore = $this->evaluateHand($this->player->hand);
        if ($this->playerscore > 21) {
            $this->bankWins = true;
        }
    }

    public function evaluateHand($hand)
    {
        $cards = array();
        foreach ($hand as $card) {
            $cards[] = $card->getValue();
        }

        while (in_array(14, $cards)) {
            if (array_sum($cards) > 21) {
                $index = array_search(14, $cards);
                $cards[$index] = 1;
            } else {
                break;
            }
        }
        return array_sum($cards);
    }

    public function bankCard()
    {
        $this->bankPlays = true;
        while ($this->bankscore < 17) {
            $this->bank->addCard($this->deck->draw());
            $this->bankscore = $this->evaluateHand($this->bank->hand);
        }
        if ($this->bankscore < 22 and $this->bankscore >= $this->playerscore) {
            $this->bankWins = true;
        } else {
            $this->playerWins = true;
        }
    }
}
