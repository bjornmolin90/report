<?php

namespace App\Proj;

use PHPUnit\Framework\TestCase;
use App\Entity\Materialkonsumtion;
use App\Entity\Materialfotavtryck;
use App\Proj\BarGraph;

/**
 * Test cases for class BarGraph.
 */
class BarGraphTest extends TestCase
{
    /**
     * Tests that mkData returns year as key and sum of inhemsk, import and export as value.
     *
     */
     public function testMkData()
     {
         $mk = new Materialkonsumtion();
         $mk->setArtal(1980);
         $mk->setInhemsk(500);
         $mk->setImport(150);
         $mk->setExport(100);
         $mkData = BarGraph::mkdata([$mk]);

         $this->assertEquals($mkData[1980], 750);

     }

     /**
      * Tests that mfData returns array with 2 items cotaining year as key and total as value plus year as key with per capita as value.
      *
      */
      public function testMfData()
      {
          $mf = new Materialfotavtryck();
          $mf->setArtal(1990);
          $mf->setTotal(3000);
          $mf->setPercapita(40);
          $mfData = BarGraph::mfdata([$mf]);

          $this->assertEquals($mfData[0][1990], 3000);
          $this->assertEquals($mfData[1][1990], 40);

      }

      /**
       * Tests that graph returns array with 3 items where each item is an array and that title is set to $data key and value is set to value of $data.
       *
       */
       public function testGraph()
       {
           $data = array();
           $data[1970] = 100;
           $factor = 1;
           $tickarray = [1];
           $graph = BarGraph::graph($data, $factor, $tickarray);

           foreach ($graph as $item) {
               $this->assertTrue(is_array($item));
           }
           $this->assertEquals(count($graph), 3);
           $this->assertEquals($graph[1][0]["title"], 1970);
           $this->assertEquals($graph[1][0]["value"], 100);

       }

}
