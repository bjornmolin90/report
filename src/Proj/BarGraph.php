<?php

namespace App\Proj;

use App\Entity\Materialkonsumtion;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\MaterialkonsumtionRepository;
use App\Entity\Materialfotavtryck;
use App\Repository\MaterialfotavtryckRepository;

/**
 * Class to build bar graphs.
 */
class BarGraph
{
    /**
     * Returns data regarding material consumtion formatted for building graph.
     */
    public static function mkdata($data)
    {
        $graphData = array();
        foreach ($data as $item) {
            $total = $item->getInhemsk() + $item->getImport() + $item->getExport();
            $graphData[$item->getArtal()] = $total;
        }

        return $graphData;
    }

    /**
     * Returns data regarding material footprint formatted for building graphs of total and per capita.
     */
    public static function mfdata($data)
    {
        $graphData = array();
        foreach ($data as $item) {
            $graphDatamf[$item->getArtal()] = $item->getTotal();
            $graphDatamfc[$item->getArtal()] = $item->getPercapita();
        }

        return [$graphDatamf, $graphDatamfc];
    }

    /**
     * Returns bar graph data structure.
     */
    public static function graph($dbdata, $factor, $tickarray)
    {
        $data = array();
        $ticks = array();
        $par = array();

        $len = count($dbdata);
        $max = max($dbdata);
        $scale = 400 / $max;
        $offset = 50;

        $par = array(
        "chartheight" => "450",
        "chartwidth" => "800",
        "chartmargin" => "20",
        "barwidth" => "40",
        "titleadjust" => "0",
        "tickswidth" => "950",
        "ticksadjust" => "50",
        "tickmarksadjust" => "-50",);

        $i = 0;
        foreach ($dbdata as $key => $val) {
            array_push($data, ['title' => $key, 'value' => round($val / $factor),
            'offset' => $offset * $i, 'height' => $val * $scale]);
            $i++;
        }

        foreach ($tickarray as $item) {
            array_push($ticks, ['height' => round($item * $factor * $scale), 'value' => $item]);
        }
        array_push($ticks, ['height' => 0, 'value' => ""]);

        return array($par, $data, $ticks);
    }
}
