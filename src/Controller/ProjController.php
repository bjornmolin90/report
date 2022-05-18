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
        if (empty($materialkonsumtionRepository->findAll())) {
            ReadData::materialKonsumtion($doctrine);
        }
        if (empty($materialfotavtryckRepository->findAll())) {
            ReadData::materialFotavtryck($doctrine);
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
    public function resetData(
        ManagerRegistry $doctrine,
        MaterialkonsumtionRepository $materialkonsumtionRepository,
        MaterialfotavtryckRepository $materialfotavtryckRepository,
    ): Response {
            $entityManager = $doctrine->getManager();
            $clear = $materialkonsumtionRepository->findAll();
        foreach ($clear as $item) {
            $entityManager->remove($item);
        }
            $clear = $materialfotavtryckRepository->findAll();
        foreach ($clear as $item) {
            $entityManager->remove($item);
        }
            $entityManager->flush();

            return $this->redirectToRoute('proj');
    }

    /**
    * @Route("/proj/about", name="proj-about", methods={"GET"})
    */
    public function about(): Response
    {
        $data = [
            'title' => "About",
            'link_to_deck' => $this->generateUrl('deck'),
            'link_to_shuffle' => $this->generateUrl('shuffle'),
            'link_to_draw' => $this->generateUrl('draw'),
            'link_to_draws' => $this->generateUrl('num-draws', [
            'numDraws' => 1,
            ]),
            'link_to_deal' => $this->generateUrl('deal', [
            'numPlayers' => 1,
            'numCards' => 1,
            ]),
            'link_to_json' => $this->generateUrl('json'),
        ];
        return $this->render('proj/about.html.twig', $data);
    }
}
