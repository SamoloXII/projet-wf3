<?php

namespace App\Repository;

use App\Entity\Medicaments;
use App\Entity\Users;
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

    public function search($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.nom LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->orderBy('m.nom', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findMedicamentByUser(Users $user)
    {
        return $this->createQueryBuilder('m')
            ->join('m.prescriptions', 'p')
            ->andWhere('p.users = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult()
            ;
    }

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
