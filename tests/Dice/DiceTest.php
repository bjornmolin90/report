<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

function random_int($a, $b) {
    return 3;
}

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
     public function testCreateObject()
     {
         $dice = new Dice();
         $this->assertInstanceOf("\App\Dice\Dice", $dice);

     }

     public function testDieValue()
     {
         $dice = new Dice();
         $this->assertEquals(3, $dice->roll());

     }

     public function testgetAsString()
     {
         $dice = new Dice();
         $this->assertEquals("[3]", $dice->getAsString());

     }

}
