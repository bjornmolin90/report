<?php

namespace App\Proj;

use PHPUnit\Framework\TestCase;
use App\Entity\Materialkonsumtion;
use App\Entity\Materialfotavtryck;
use App\Proj\ReadData;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\MaterialkonsumtionRepository;
use App\Repository\MaterialfotavtryckRepository;

/**
 * Test cases for class ReadData.
 */
class ReadDataTest extends TestCase
{
    /**
     * Tests that MaterialKonsumtion reads csv and sets values.
     */
     public function testMaterialKonsumtion()
     {
         $doctrine = new emMock();
         $file = "/../../var/data/test.csv";
         ReadData::materialKonsumtion($doctrine, $file);

         $this->assertEquals(emMock::$material->getArtal(), 1);

     }

     /**
      * Tests that MaterialFotavtryck reads csv and sets values.
      */
      public function testMaterialFotavtryck()
      {
          $doctrine = new emMock();
          $file = "/../../var/data/test.csv";
          ReadData::materialFotavtryck($doctrine, $file);

          $this->assertEquals(emMock::$material->getTotal(), 2);

      }

}

/**
 * Class that mocks manager registry.
 */
class emMock {
    public static $material;

    public static function getManager() {
        return new Manager;
    }

}

/**
 * Class that mocks entity manager's persist and flush.
 */
class Manager extends emMock {

    public function persist($material) {
        emMock::$material = $material;
    }

    public function flush() {

    }
}
