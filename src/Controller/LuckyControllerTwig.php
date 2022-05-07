<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerTwig extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function start(): Response
    {
        $number = random_int(0, 100);
        $title = "Home";

        return $this->render('start.html.twig', [
            'number' => $number,
            'title' => $title,
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        $title = "About";

        return $this->render('about.html.twig', [
            'title' => $title,
        ]);
    }

    /**
     * @Route("/report", name="report")
     */
    public function report(): Response
    {
        $title = "Report";

        return $this->render('report.html.twig', [
            'title' => $title,
        ]);
    }

    /**
     * @Route("/metrics", name="metrics")
     */
    public function metrics(): Response
    {
        $title = "Metrics";

        return $this->render('metrics.html.twig', [
            'title' => $title,
        ]);
    }
}
