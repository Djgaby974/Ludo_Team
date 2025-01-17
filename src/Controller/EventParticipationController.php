<?php

namespace App\Controller;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EventParticipationController extends AbstractController
{
    #[Route('/event/{id}/register', name: 'app_event_register', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function register(Event $event, EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $this->getUser();

        // Vérifier si l'utilisateur peut s'inscrire
        if ($event->getParticipants()->count() >= $event->getMaxParticipants()) {
            $this->addFlash('error', 'Cet événement a atteint le nombre maximum de participants.');
            return $this->redirectToRoute('app_event_show', ['id' => $event->getId()]);
        }

        // Vérifier si l'utilisateur est déjà inscrit
        if ($event->isParticipant($user)) {
            $this->addFlash('error', 'Vous êtes déjà inscrit à cet événement.');
            return $this->redirectToRoute('app_event_show', ['id' => $event->getId()]);
        }

        // Ajouter l'utilisateur aux participants
        $event->addParticipant($user);
        $entityManager->persist($event);
        $entityManager->flush();

        $this->addFlash('success', 'Vous êtes maintenant inscrit à l\'événement.');
        return $this->redirectToRoute('app_event_show', ['id' => $event->getId()]);
    }

    #[Route('/event/{id}/unregister', name: 'app_event_unregister', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function unregister(Event $event, EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $this->getUser();

        // Vérifier si l'utilisateur est inscrit
        if (!$event->isParticipant($user)) {
            $this->addFlash('error', 'Vous n\'êtes pas inscrit à cet événement.');
            return $this->redirectToRoute('app_event_show', ['id' => $event->getId()]);
        }

        // Retirer l'utilisateur des participants
        $event->removeParticipant($user);
        $entityManager->persist($event);
        $entityManager->flush();

        $this->addFlash('success', 'Vous avez été désinscrit de l\'événement.');
        return $this->redirectToRoute('app_event_show', ['id' => $event->getId()]);
    }
}
