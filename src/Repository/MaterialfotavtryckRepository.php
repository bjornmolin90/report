<?php

namespace App\Repository;

use App\Entity\Materialfotavtryck;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Materialfotavtryck>
 *
 * @method Materialfotavtryck|null find($id, $lockMode = null, $lockVersion = null)
 * @method Materialfotavtryck|null findOneBy(array $criteria, array $orderBy = null)
 * @method Materialfotavtryck[]    findAll()
 * @method Materialfotavtryck[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterialfotavtryckRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Materialfotavtryck::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Materialfotavtryck $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Materialfotavtryck $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Materialfotavtryck[] Returns an array of Materialfotavtryck objects
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
    public function findOneBySomeField($value): ?Materialfotavtryck
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
