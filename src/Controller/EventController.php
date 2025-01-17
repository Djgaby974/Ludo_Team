<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Form\SearchType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/', name: 'app_event_index', methods: ['GET'])]
    public function index(Request $request, EventRepository $eventRepository): Response
    {
        $form = $this->createForm(SearchType::class);
        
        // Pré-remplir le formulaire avec les paramètres de l'URL
        $form->handleRequest($request);

        $events = [];
        // Vérifier si le formulaire est soumis ou si des paramètres sont présents dans l'URL
        if ($form->isSubmitted() && $form->isValid() || $request->query->count() > 0) {
            $searchData = $form->getData() ?? [
                'dateFrom' => null,
                'dateTo' => null,
                'gameType' => $request->query->get('gameType'),
                'minParticipants' => $request->query->getInt('minParticipants'),
                'gameName' => $request->query->get('gameName'),
                'games' => null
            ];

            // Création du QueryBuilder personnalisé
            $queryBuilder = $eventRepository->createQueryBuilder('e')
                ->leftJoin('e.games', 'g');

            // Filtres de date
            if ($searchData['dateFrom']) {
                $queryBuilder->andWhere('e.dateEvent >= :dateFrom')
                    ->setParameter('dateFrom', $searchData['dateFrom']);
            }
            if ($searchData['dateTo']) {
                $queryBuilder->andWhere('e.dateEvent <= :dateTo')
                    ->setParameter('dateTo', $searchData['dateTo']);
            }

            // Filtre de type de jeu
            if ($searchData['gameType']) {
                $queryBuilder->andWhere('g.type = :gameType')
                    ->setParameter('gameType', $searchData['gameType']);
            }

            // Filtre de nombre de participants
            if ($searchData['minParticipants']) {
                $queryBuilder->andWhere('e.maxParticipants >= :minParticipants')
                    ->setParameter('minParticipants', $searchData['minParticipants']);
            }

            // Filtre de nom de jeu
            if ($searchData['gameName']) {
                $queryBuilder->andWhere('LOWER(g.name) LIKE :gameName')
                    ->setParameter('gameName', '%' . strtolower($searchData['gameName']) . '%');
            }

            // Filtre de jeux spécifiques
            if ($searchData['games']) {
                // Convertir la collection en tableau d'ID
                $gameIds = $searchData['games'] instanceof \Doctrine\Common\Collections\Collection 
                    ? $searchData['games']->map(fn($game) => $game->getId())->toArray()
                    : $searchData['games'];
                
                $queryBuilder->andWhere('g.id IN (:gameIds)')
                    ->setParameter('gameIds', $gameIds);
            }

            $events = $queryBuilder->getQuery()->getResult();
        } else {
            // Si aucun filtre n'est appliqué, afficher tous les événements
            $events = $eventRepository->findAll();
        }

        return $this->render('event/index.html.twig', [
            'events' => $events,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'app_event_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Vérifier que l'utilisateur est connecté
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour créer un événement.');
            return $this->redirectToRoute('app_login');
        }

        $event = new Event();
        // Définir l'organisateur avant de créer le formulaire
        $event->setOrganisateur($user);

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Ajouter l'organisateur comme participant s'il n'est pas déjà dans la liste
            if (!$event->getParticipants()->contains($user)) {
                $event->addParticipant($user);
            }
            
            // Ajouter les participants sélectionnés
            $selectedParticipants = $form->get('participants')->getData();
            foreach ($selectedParticipants as $participant) {
                if (!$event->getParticipants()->contains($participant)) {
                    $event->addParticipant($participant);
                }
            }
            
            $entityManager->persist($event);
            $entityManager->flush();

            $this->addFlash('success', 'Votre événement a été créé avec succès.');
            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event/new.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_event_show', methods: ['GET'])]
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/{id}/details', name: 'app_event_details', methods: ['GET'])]
    public function details(Event $event): Response
    {
        return $this->render('event/details.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_event_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        // Vérifier que l'utilisateur connecté est l'organisateur
        if ($event->getOrganisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas modifier cet événement.');
        }

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event/edit.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_event_delete', methods: ['POST'])]
    public function delete(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        // Vérifier que l'utilisateur connecté est l'organisateur
        if ($event->getOrganisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas supprimer cet événement.');
        }

        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/join', name: 'app_event_join', methods: ['GET'])]
    public function join(Event $event, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour rejoindre un événement.');
            return $this->redirectToRoute('app_login');
        }

        if ($event->getParticipants()->contains($user)) {
            $this->addFlash('warning', 'Vous participez déjà à cet événement.');
            return $this->redirectToRoute('app_event_details', ['id' => $event->getId()]);
        }

        if ($event->getParticipants()->count() >= $event->getMaxParticipants()) {
            $this->addFlash('error', 'Cet événement est complet.');
            return $this->redirectToRoute('app_event_details', ['id' => $event->getId()]);
        }

        $event->addParticipant($user);
        $entityManager->persist($event);
        $entityManager->flush();

        $this->addFlash('success', 'Vous avez rejoint l\'événement avec succès !');
        return $this->redirectToRoute('app_event_details', ['id' => $event->getId()]);
    }

    #[Route('/api/events', name: 'app_api_events', methods: ['GET'])]
    public function apiEvents(EventRepository $eventRepository, SerializerInterface $serializer): JsonResponse
    {
        $events = $eventRepository->findAll();
        
        $eventsData = [];
        foreach ($events as $event) {
            $eventData = [
                'id' => $event->getId(),
                'name' => $event->getName(),
                'description' => $event->getDescription(),
                'dateEvent' => $event->getDateEvent()->format('Y-m-d H:i:s'),
                'location' => $event->getLocation(),
                'maxParticipants' => $event->getMaxParticipants(),
                'participants' => [],
                'games' => []
            ];

            // Ajouter les participants
            foreach ($event->getParticipants() as $participant) {
                $eventData['participants'][] = [
                    'id' => $participant->getId(),
                    'email' => $participant->getEmail(),
                    'prenom' => $participant->getPrenom()
                ];
            }

            // Ajouter les jeux
            foreach ($event->getGames() as $game) {
                $eventData['games'][] = [
                    'id' => $game->getId(),
                    'name' => $game->getName(),
                    'type' => $game->getGameType()
                ];
            }

            $eventsData[] = $eventData;
        }

        return new JsonResponse($eventsData, JsonResponse::HTTP_OK, [], false);
    }
}
