<?php

namespace App\Security;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Psr\Log\LoggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class LoginFormAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private LoggerInterface $logger,
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $entityManager
    ) {
    }

    public function authenticate(Request $request): Passport
    {
        // Récupérer les données du formulaire directement depuis la requête
        $email = $request->request->get('email', '');
        $password = $request->request->get('password', '');
        
        // Log détaillé des données de la requête
        $this->logger->info('Login Request Details', [
            'request_method' => $request->getMethod(),
            'email_from_request' => $email,
            'password_length' => strlen($password),
            'request_content' => $request->getContent(),
            'request_query_params' => $request->query->all(),
            'request_request_params' => $request->request->all()
        ]);

        $request->getSession()->set('_security.last_username', $email);

        // Récupérer tous les utilisateurs
        $userRepository = $this->entityManager->getRepository(User::class);
        $allUsers = $userRepository->findAll();

        // Préparer les informations des utilisateurs pour le débogage
        $userDebugInfo = array_map(function($user) {
            return [
                'email' => $user->getEmail(),
                'id' => $user->getId()
            ];
        }, $allUsers);
        
        // Recherche insensible à la casse et sans espaces
        $email = trim(strtolower($email));
        $user = $userRepository->createQueryBuilder('u')
            ->where('LOWER(u.email) = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();

        // Ajouter un script JavaScript pour logger dans la console du navigateur
        $script = sprintf(
            "<script>
                console.group('Login Attempt');
                console.log('Original Email: %s');
                console.log('Cleaned Email: %s');
                console.log('User Found: %s');
                console.log('All Users: %s');
                console.log('User Email: %s');
                console.log('Hashed Password: %s');
                console.groupEnd();
            </script>",
            $request->request->get('email', ''),
            $email,
            $user ? 'Yes' : 'No',
            json_encode($userDebugInfo),
            $user ? $user->getEmail() : 'N/A',
            $user ? $user->getPassword() : 'N/A'
        );
        $request->getSession()->set('login_debug_script', $script);

        // Si l'utilisateur n'est pas trouvé, lever une exception
        if (!$user) {
            throw new \Symfony\Component\Security\Core\Exception\UserNotFoundException('Utilisateur non trouvé');
        }

        $this->logger->info('Login attempt', [
            'email' => $email,
            'password_length' => strlen($password),
            'all_users' => $userDebugInfo
        ]);

        if ($user) {
            $this->logger->info('User found', [
                'email' => $user->getEmail(),
                'hashed_password' => $user->getPassword()
            ]);
        } else {
            $this->logger->warning('No user found', [
                'email' => $email
            ]);
        }

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($password),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        // Rediriger vers la page d'accueil après connexion
        return new RedirectResponse($this->urlGenerator->generate('app_home'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
