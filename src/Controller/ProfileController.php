<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(EventRepository $eventRepository): Response
    {
        $user = $this->getUser();
        
        if (!$user) {
            throw new AccessDeniedException('Vous devez être connecté pour accéder à cette page.');
        }

        // Récupérer les événements auxquels l'utilisateur participe
        $participatingEvents = $eventRepository->findEventsByParticipant($user);

        // Récupérer les événements organisés par l'utilisateur
        $organizedEvents = $eventRepository->findEventsByOrganizer($user);

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'participating_events' => $participatingEvents,
            'organized_events' => $organizedEvents,
        ]);
    }
}
