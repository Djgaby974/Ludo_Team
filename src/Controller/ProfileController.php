<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

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

    #[Route('/profile/edit', name: 'app_edit_profile')]
    public function editProfile(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createFormBuilder($user)
            ->add('email', null, ['label' => 'Email'])
            ->add('save', SubmitType::class, ['label' => 'Modifier'])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                try {
                    $entityManager->flush();
                    $this->addFlash('success', 'Votre profil a été mis à jour avec succès.');
                    return $this->redirectToRoute('app_profile');
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors de la mise à jour de votre profil.');
                }
            } else {
                $this->addFlash('error', 'Veuillez corriger les erreurs du formulaire.');
            }
        }

        return $this->render('profile/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/profile/change-password', name: 'app_change_password')]
    public function changePassword(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createFormBuilder()
            ->add('oldPassword', PasswordType::class, ['label' => 'Ancien mot de passe'])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent correspondre.',
                'required' => true,
                'first_options' => ['label' => 'Nouveau mot de passe'],
                'second_options' => ['label' => 'Confirmer le nouveau mot de passe'],
            ])
            ->add('save', SubmitType::class, ['label' => 'Modifier'])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $oldPassword = $form->get('oldPassword')->getData();
            $newPassword = $form->get('newPassword')->getData();

            // Vérifier l'ancien mot de passe
            if (!$passwordHasher->isPasswordValid($user, $oldPassword)) {
                $this->addFlash('error', 'L\'ancien mot de passe est incorrect.');
                return $this->redirectToRoute('app_change_password');
            }

            if ($form->isValid()) {
                try {
                    // Hacher le nouveau mot de passe
                    $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                    $user->setPassword($hashedPassword);
                    $entityManager->flush();

                    $this->addFlash('success', 'Votre mot de passe a été modifié avec succès.');
                    return $this->redirectToRoute('app_profile');
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors de la modification du mot de passe.');
                }
            } else {
                $this->addFlash('error', 'Veuillez corriger les erreurs du formulaire.');
            }
        }

        return $this->render('profile/change_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
