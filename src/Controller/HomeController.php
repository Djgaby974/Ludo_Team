<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EventRepository $eventRepository, GameRepository $gameRepository): Response
    {
        // Récupérer les événements à venir
        $upcomingEvents = $eventRepository->findUpcomingEvents(3);
        
        // Récupérer les jeux populaires
        $popularGames = $gameRepository->findPopularGames(4);

        return $this->render('home/index.html.twig', [
            'upcoming_events' => $upcomingEvents,
            'popular_games' => $popularGames,
            'user' => $this->getUser(),
        ]);
    }
}
