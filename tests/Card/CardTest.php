<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
     public function testCreateObject()
     {
         $card = new Card(0);
         $this->assertInstanceOf("\App\Card\Card", $card);

         $res = $card->getValue();
         $exp = 14;
         $this->assertEquals($exp, $res);
     }

}
