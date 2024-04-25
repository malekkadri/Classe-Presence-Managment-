<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClasseRepository;
use App\Repository\PresenceRepository;
use App\Entity\Classe;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ClasseRepository $classeRepository): Response
    {
        // Fetch all classes from the database
        $classes = $classeRepository->findAll();

        return $this->render('home/index.html.twig', [
            'classes' => $classes,
        ]);
    }
    #[Route('/class/{id}/presences', name: 'class_presences')]
    public function classPresences(Classe $classe, PresenceRepository $presenceRepository): Response
    {
        $presences = $presenceRepository->findBy(['classe' => $classe]);
        return $this->render('home/presence.html.twig', [
            'presences' => $presences,
            'classe' => $classe,
        ]);
    }
}
