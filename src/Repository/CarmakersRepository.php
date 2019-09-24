<?php

namespace App\Repository;

use App\Entity\Carmakers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Carmakers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Carmakers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Carmakers[]    findAll()
 * @method Carmakers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarmakersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Carmakers::class);
    }

    // /**
    //  * @return Carmakers[] Returns an array of Carmakers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Carmakers
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
