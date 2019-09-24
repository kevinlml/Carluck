<?php

namespace App\Repository;

use App\Entity\Carmodels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Carmodels|null find($id, $lockMode = null, $lockVersion = null)
 * @method Carmodels|null findOneBy(array $criteria, array $orderBy = null)
 * @method Carmodels[]    findAll()
 * @method Carmodels[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarmodelsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Carmodels::class);
    }

    // /**
    //  * @return Carmodels[] Returns an array of Carmodels objects
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
    public function findOneBySomeField($value): ?Carmodels
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
