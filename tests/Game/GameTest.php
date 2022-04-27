<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player.
 */
class GameTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
     public function testCreateObject()
     {
         $game = new Game();
         $this->assertInstanceOf("\App\Game\Game", $game);
     }

     /**
      * Tests that drawCard method has added a card to the player's hand.
      */
     public function testDrawCard()
     {
         $game = new Game();
         $game->drawCard();
         $this->assertEquals(count($game->player->hand), 1);
     }

     /**
      * Tests that evaluateHand method changes value of ace if 14 would make the player bust
      * and doesn't if the value should stay 14.
      */
     public function testEvaluateHand()
     {
         $game = new Game();
         $card1 = new \App\Card\Card(0);
         $card2 = new \App\Card\Card(12);
         $cards = [$card1, $card2];
         $this->assertEquals($game->evaluateHand($cards), 14);
         $this->assertEquals($game->evaluateHand([$card1]), 14);
     }

     /**
      * Tests that bankCard method make bank winner if bank's hand is better than player's and the
      * other way around and that player wins if bank is bust.
      */
     public function testBankCard()
     {
         $game = new Game();
         $game->bankscore = 20;
         $game->playerscore = 19;
         $game->bankCard();
         $this->assertTrue($game->bankWins);
         $game->playerscore = 21;
         $game->bankCard();
         $this->assertTrue($game->playerWins);
         $game->playerWins = False;
         $game->bankscore = 23;
         $game->bankCard();
         $this->assertTrue($game->playerWins);

     }
}
