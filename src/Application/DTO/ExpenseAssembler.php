<?php

namespace App\Application\DTO;


use App\Application\Model\Expense;

class ExpenseAssembler
{
    public function readDTO(ExpenseDTO $expenseDTO, ?Expense $expense = null)
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

    public function writeDTO(Expense $expense)
    {
        return new ExpenseDTO(
            $expense->getTitle(),
            $expense->getDescription(),
            $expense->getValue(),
            $expense->getCreatedAt(),
            $expense->getUpdatedAt()
        );
    }

    public function createExpense(ExpenseDTO $expenseDTO)
    {
        return $this->readDTO($expenseDTO);
    }

    public function updateExpense(Expense $expense, ExpenseDTO $expenseDTO)
    {
        return $this->readDTO($expenseDTO, $expense);
    }
}