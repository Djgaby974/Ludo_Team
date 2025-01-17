<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api')]
class ApiController extends AbstractController
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    #[Route('/events', name: 'api_events_list', methods: ['GET'])]
    public function listEvents(EventRepository $eventRepository): JsonResponse
    {
        $events = $eventRepository->findAll();
        
        $data = $this->serializer->serialize($events, 'json', [
            'groups' => ['event_details']
        ]);

        return JsonResponse::fromJsonString($data);
    }

    #[Route('/games', name: 'api_games_list', methods: ['GET'])]
    public function listGames(GameRepository $gameRepository): JsonResponse
    {
        $games = $gameRepository->findAll();
        
        $data = $this->serializer->serialize($games, 'json', [
            'groups' => ['game_details']
        ]);

        return JsonResponse::fromJsonString($data);
    }

    #[Route('/users', name: 'api_users_list', methods: ['GET'])]
    public function listUsers(UserRepository $userRepository): JsonResponse
    {
        $users = $userRepository->findAll();
        
        $data = $this->serializer->serialize($users, 'json', [
            'groups' => ['user_details']
        ]);

        return JsonResponse::fromJsonString($data);
    }

    #[Route('/events/{id}', name: 'api_event_details', methods: ['GET'])]
    public function eventDetails(int $id, EventRepository $eventRepository): JsonResponse
    {
        $event = $eventRepository->find($id);
        
        if (!$event) {
            return $this->json(['error' => 'Événement non trouvé'], 404);
        }

        $data = $this->serializer->serialize($event, 'json', [
            'groups' => ['event_details', 'event_participants', 'event_games']
        ]);

        return JsonResponse::fromJsonString($data);
    }
}
