<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Dice;

/**
 * Test cases for class Dice.
 */
class DiceHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
     public function testCreateObject()
     {
         $dicehand = new DiceHand();
         $this->assertInstanceOf("\App\Dice\DiceHand", $dicehand);

     }

     public function testAddAndGetNumberDices()
     {
         $dicehand = new DiceHand();
         $die = new Dice();
         $dicehand->add($die);
         $die = new Dice();
         $dicehand->add($die);
         $this->assertEquals(2, $dicehand->getNumberDices());

     }

     public function testRollAndGetAsString()
     {
         $dicehand = new DiceHand();
         $die = new Dice();
         $dicehand->add($die);
         $die = new Dice();
         $dicehand->add($die);
         $dicehand->roll();
         $this->assertEquals("[3][3]", $dicehand->getAsString());

     }


}
