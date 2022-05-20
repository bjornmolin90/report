<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Deck.
 */
class DeckTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
     public function testCreateObject()
     {
         $deck = new Deck();
         $this->assertInstanceOf("\App\Card\Deck", $deck);
     }

     /**
      * Construct object and verify that the object has the expected
      * properties.
      */
      public function testCreateObjectDeck2()
      {
          $deck = new Deck2();
          $this->assertInstanceOf("\App\Card\Deck2", $deck);
      }

     /**
      * Tests that length method returns correct length of a deck object.
      */
     public function testLengthMethod()
     {
         $deck = new Deck();
         $this->assertEquals($deck->length(), 52);
     }

     /**
      * Tests that draw method draws a card by having one less returned in length method of a deck * object.
      */
     public function testDrawMethod()
     {
         $deck = new Deck();
         $deck->draw();
         $this->assertEquals($deck->length(), 51);
     }

     /**
      * Tests that draws method returns right amount of drawn cards.
      */
     public function testDrawsMethod()
     {
         $deck = new Deck();
         $this->assertEquals(count($deck->draws(3)), 3);
     }

}
