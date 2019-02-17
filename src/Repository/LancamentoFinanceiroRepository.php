<?php

namespace App\Repository;

use App\Entity\LancamentoFinanceiro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LancamentoFinanceiro|null find($id, $lockMode = null, $lockVersion = null)
 * @method LancamentoFinanceiro|null findOneBy(array $criteria, array $orderBy = null)
 * @method LancamentoFinanceiro[]    findAll()
 * @method LancamentoFinanceiro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LancamentoFinanceiroRepository extends ServiceEntityRepository implements LancamentoFinanceiroRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LancamentoFinanceiro::class);
    }

    /**
     * @param LancamentoFinanceiro $lancamentoFinanceiro
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(LancamentoFinanceiro $lancamentoFinanceiro): void
    {
        $this->_em->persist($lancamentoFinanceiro);
        $this->_em->flush($lancamentoFinanceiro);
    }

    /**
     * @param LancamentoFinanceiro $lancamentoFinanceiro
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(LancamentoFinanceiro $lancamentoFinanceiro): void
    {
        $this->_em->remove($lancamentoFinanceiro);
        $this->_em->flush($lancamentoFinanceiro);
    }

    // /**
    //  * @return LancamentoFinanceiro[] Returns an array of LancamentoFinanceiro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LancamentoFinanceiro
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
