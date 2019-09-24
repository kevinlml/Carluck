<?php

namespace App\Repository;

use App\Entity\Carsad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Carsad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Carsad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Carsad[]    findAll()
 * @method Carsad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarsadRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Carsad::class);
    }

    // /**
    //  * @return Carsad[] Returns an array of Carsad objects
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
    public function findOneBySomeField($value): ?Carsad
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
