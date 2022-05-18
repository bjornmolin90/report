<?php

namespace App\Proj;

use App\Entity\Materialkonsumtion;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\MaterialkonsumtionRepository;
use App\Entity\Materialfotavtryck;
use App\Repository\MaterialfotavtryckRepository;

/**
 * Class to read csv data for the tables.
 */
class ReadData
{
    /**
     * Reads data for table materialkonsumtion.
     */
    public static function materialKonsumtion($doctrine)
    {
        $entityManager = $doctrine->getManager();
        $csv = fopen(dirname(__FILE__) . '/../../var/data/12.2.csv', 'r');
        while (!feof($csv)) {
            $material = new Materialkonsumtion();
            $line = fgetcsv($csv);
            $material->setArtal(intval($line[0]));
            $material->setInhemsk(intval($line[1]));
            $material->setImport(intval($line[2]));
            $material->setExport(intval($line[3]));
            $entityManager->persist($material);
        }
        fclose($csv);
        $entityManager->flush();
    }

    /**
     * Reads data for table materialfotavtryck.
     */
    public static function materialFotavtryck($doctrine)
    {
        $entityManager = $doctrine->getManager();
        $csv = fopen(dirname(__FILE__) . '/../../var/data/12.1.csv', 'r');
        while (!feof($csv)) {
            $material = new Materialfotavtryck();
            $line = fgetcsv($csv);
            $material->setArtal(intval($line[0]));
            $material->setTotal(intval($line[1]));
            $material->setPercapita(intval($line[2]));
            $material->setPerbnp(intval($line[3]));
            $entityManager->persist($material);
        }
        fclose($csv);
        $entityManager->flush();
    }
}
