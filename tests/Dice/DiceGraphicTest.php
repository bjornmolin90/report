<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use App\Dice\Dice;

/**
 * Test cases for class Dice.
 */
class DiceGraphicTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
     public function testCreateObject()
     {
         $dice = new DiceGraphic();
         $this->assertInstanceOf("\App\Dice\DiceGraphic", $dice);

     }

     public function testgetAsString()
     {
         $dice = new DiceGraphic();
         $this->assertEquals("⚂", $dice->getAsString());

     }

}
