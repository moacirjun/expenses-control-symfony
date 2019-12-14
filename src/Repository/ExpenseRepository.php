<?php

namespace App\Repository;

use App\Entity\Expense;
use DateInterval;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Service\Paginator;

/**
 * @method Expense|null find($id, $lockMode = null, $lockVersion = null)
 * @method Expense|null findOneBy(array $criteria, array $orderBy = null)
 * @method Expense[]    findAll()
 * @method Expense[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpenseRepository extends ServiceEntityRepository implements ExpenseRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Expense::class);
    }

    /**
     * @inheritDoc
     */
    public function getRecents(
        \DateTime $startDate = null,
        \DateTime $endDate = null,
        $page = 1,
        $limit = 15
    ) : Paginator {
        $formattedStartDate = $startDate instanceof \DateTime
            ? $startDate
            : (new DateTime())->sub(new DateInterval('P15D'));

        $formattedStartDate->setTime(0, 0);

        $query = $this->createQueryBuilder('expense')
            ->where('expense.createdAt >= :start')
            ->setParameter('start', $formattedStartDate);
        
        if ($endDate instanceof \DateTime) {
            $endDate->setTime(23, 59, 59, 99);

            $query
                ->andWhere('expense.createdAt <= :end')
                ->setParameter('end', $endDate);
        }

        return new Paginator($query, $page, $limit);
    }

    /**
     * @param Expense $expense
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Expense $expense): void
    {
        $this->_em->persist($expense);
        $this->_em->flush($expense);
    }

    /**
     * @param Expense $expense
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Expense $expense): void
    {
        $this->_em->remove($expense);
        $this->_em->flush($expense);
    }

    // /**
    //  * @return Expense[] Returns an array of Expense objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Expense
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
