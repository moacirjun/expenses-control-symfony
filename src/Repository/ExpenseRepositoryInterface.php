<?php

namespace App\Repository;

use App\Entity\Expense;
use App\Service\Paginator;

/**
 * @method Expense|null find($id, $lockMode = null, $lockVersion = null)
 * @method Expense|null findOneBy(array $criteria, array $orderBy = null)
 * @method Expense[]    findAll()
 * @method Expense[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface ExpenseRepositoryInterface
{
    /**
     * @param Expense $expense
     */
    public function save(Expense $expense): void;

    /**
     * @param Expense $expense
     */
    public function delete(Expense $expense): void;

    /**
     * Find recents expenses. If called without params the expenses of the last 15 days will be returned
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param integer $offset
     * @param integer $limit
     * @return Paginator
     */
    public function getRecents(
        \DateTime $startDate = null,
        \DateTime $endDate = null,
        $page = 1,
        $limit = 15
    ): Paginator;
}
