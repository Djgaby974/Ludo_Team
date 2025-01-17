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
        // Si l'utilisateur n'est pas connecté, ajouter un message flash
        if (!$this->getUser()) {
            $this->addFlash('info', 'Connectez-vous pour accéder à toutes les fonctionnalités de LudoTeam !');
            return $this->redirectToRoute('app_login');
        }

        // Récupérer les événements à venir dans les 2 semaines
        $upcomingEvents = $eventRepository->findNearbyEvents(14);
        
        // Récupérer les jeux populaires
        $popularGames = $gameRepository->findPopularGames(4);

        return $this->render('home/index.html.twig', [
            'upcomingEvents' => $upcomingEvents,
            'popular_games' => $popularGames,
            'user' => $this->getUser(),
        ]);
    }
}
