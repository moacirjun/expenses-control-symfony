<?php

namespace App\Repository;

use App\Application\Model\Expense;

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
}
