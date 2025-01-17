<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

//    /**
//     * @return Event[] Returns an array of Event objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Event
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findUpcomingEvents(int $limit = 3): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.dateEvent > :now')
            ->setParameter('now', new \DateTime())
            ->orderBy('e.dateEvent', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findEventsByParticipant($user): array
    {
        return $this->createQueryBuilder('e')
            ->innerJoin('e.participants', 'p')
            ->andWhere('p.id = :userId')
            ->setParameter('userId', $user->getId())
            ->orderBy('e.dateEvent', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findEventsByOrganizer($user): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.organisateur = :user')
            ->setParameter('user', $user)
            ->orderBy('e.dateEvent', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
