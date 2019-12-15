<?php

namespace App\Repository;

use App\Entity\Medicaments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Medicaments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medicaments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medicaments[]    findAll()
 * @method Medicaments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicamentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medicaments::class);
    }

//    public function findEntitiesByString($str)
//    {
//        return $this->getEntityManager()
//            ->createQuery(
//                'SELECT m
//                    FROM medicaments m
//                    WHERE m.nom LIKE :str'
//            )
//            ->setParameter('str', '%'.$str.'%')
//            ->getResult();
//    }

    // /**
    //  * @return Medicaments[] Returns an array of Medicaments objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Medicaments
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
