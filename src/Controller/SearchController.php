<?php

namespace App\Controller;

use App\Entity\BoardGame;
use App\Entity\CardGame;
use App\Entity\DuelGame;
use App\Form\SearchType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search/events', name: 'app_search_events')]
    public function searchEvents(Request $request, EventRepository $eventRepository): Response
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
        }

        return $this->render('search/events.html.twig', [
            'form' => $form->createView(),
            'events' => $events
        ]);
    }
}
