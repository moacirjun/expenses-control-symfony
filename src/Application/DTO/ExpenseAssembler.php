<?php

namespace App\Application\DTO;

use App\Entity\Expense;

class ExpenseAssembler
{
    /**
     * readDTO
     *
     * @param ExpenseDTO $expenseDTO
     * @param Expense|null $expense
     * @return Expense
     */
    public function readDTO(ExpenseDTO $expenseDTO, ?Expense $expense = null) : Expense
    {
        if (!$expense) {
            $expense = new Expense();
        }

        $expense->setTitle($expenseDTO->getTitle());
        $expense->setDescription($expenseDTO->getDescription());
        $expense->setValue($expenseDTO->getValue());
        $expense->setCreatedAt($expenseDTO->getCreatedAt());
        $expense->setUpdatedAt($expenseDTO->getUpdatedAt());

        return $expense;
    }

    /**
     * Crete a expenseDTO instance from a passed Expense instance
     *
     * @param Expense $expense
     * @return expenseDTO
     */
    public function writeDTO(Expense $expense) : expenseDTO
    {
        return new ExpenseDTO(
            $expense->getTitle(),
            $expense->getDescription(),
            $expense->getValue(),
            $expense->getCreatedAt(),
            $expense->getUpdatedAt()
        );
    }

    /**
     * Crete a Expense instance from a passed expenseDTO instance
     *
     * @param ExpenseDTO $expenseDTO
     * @return Expense
     */
    public function createExpense(ExpenseDTO $expenseDTO)  : Expense
    {
        return $this->readDTO($expenseDTO);
    }

    /**
     * ReadDTO and set Expense object with readed data
     *
     * @param Expense $expense
     * @param ExpenseDTO $expenseDTO
     * @return Expense
     */
    public function updateExpense(Expense $expense, ExpenseDTO $expenseDTO) : Expense
    {
        return $this->readDTO($expenseDTO, $expense);
    }
}