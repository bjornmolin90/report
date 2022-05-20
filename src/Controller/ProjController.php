<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Materialkonsumtion;
use App\Entity\Materialfotavtryck;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\MaterialkonsumtionRepository;
use App\Repository\MaterialfotavtryckRepository;
use App\Proj\ReadData;
use App\Proj\BarGraph;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Controller class for project.
 */
class ProjController extends AbstractController
{
    #[Route('/proj', name: 'proj')]
    public function index(
        ManagerRegistry $doctrine,
        MaterialkonsumtionRepository $materialkonsumtionRepository,
        MaterialfotavtryckRepository $materialfotavtryckRepository,
    ): Response {
        $mkfile = '/../../var/data/12.2.csv';
        $mffile = '/../../var/data/12.1.csv';
        if (empty($materialkonsumtionRepository->findAll())) {
            ReadData::materialKonsumtion($doctrine, $mkfile);
        }
        if (empty($materialfotavtryckRepository->findAll())) {
            ReadData::materialFotavtryck($doctrine, $mffile);
        }
        $materialkonsumtion = $materialkonsumtionRepository
            ->findAll();
        $materialfotavtryck = $materialfotavtryckRepository
            ->findAll();
        $graphDataMk = BarGraph::mkdata($materialkonsumtion);
        $graphDataMf = BarGraph::mfdata($materialfotavtryck);
        $graphmk = BarGraph::graph($graphDataMk, 1000, [100, 200, 300, 400]);
        $graphmf = BarGraph::graph($graphDataMf[0], 1000000, [100, 200, 300]);
        $graphmfc = BarGraph::graph($graphDataMf[1], 1, [10, 20, 30]);
        $title = "Projekt";
        return $this->render('proj/index.html.twig', [
            'materialk' => $materialkonsumtion,
            'materialf' => $materialfotavtryck,
            'title' => $title,
            'parmk' => $graphmk[0],
            'datamk' => $graphmk[1],
            'ticksmk' => $graphmk[2],
            'parmf' => $graphmf[0],
            'datamf' => $graphmf[1],
            'ticksmf' => $graphmf[2],
            'parmfc' => $graphmfc[0],
            'datamfc' => $graphmfc[1],
            'ticksmfc' => $graphmfc[2],
        ]);
    }

    /**
    * @Route("/proj/reset", name="reset", methods={"GET"})
    */
    public function resetData(): Response {
        $last_line = system('cp ../var/proj_reset.db ../var/proj.db', $retval);

        return $this->redirectToRoute('proj');
    }

    /**
    * @Route("/proj/about", name="proj-about", methods={"GET"})
    */
    public function about(): Response
    {
        $data = [
            'title' => "About",
            'link_to_reset' => $this->generateUrl('reset'),
            'link_to_cleancode' => $this->generateUrl('cleancode'),
        ];
        return $this->render('proj/about.html.twig', $data);
    }

    /**
    * @Route("/proj/cleancode", name="cleancode", methods={"GET"})
    */
    public function cleanCode(): Response
    {
        $data = [
            'title' => "Cleancode",
        ];
        return $this->render('proj/clean.html.twig', $data);
    }

}
