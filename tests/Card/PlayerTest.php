<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player.
 */
class PlayerTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
     public function testCreateObject()
     {
         $player = new Player(0);
         $this->assertInstanceOf("\App\Card\Player", $player);
     }

     /**
      * Tests that addCard has added a card to the player's hand and that it is the correct card.
      */
     public function testAddCard()
     {
         $player = new Player(0);
         $card = new Card(1);
         $player->addCard($card);
         $this->assertEquals(count($player->hand), 1);
         $this->assertEquals($player->hand[0]->value, $card->value);
     }

}
