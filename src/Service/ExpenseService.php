<?php

namespace App\Service;


use App\Application\DTO\ExpenseAssembler;
use App\Application\DTO\ExpenseDTO;
use App\Application\Model\Expense;
use App\Repository\ExpenseRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class ExpenseService
 * @package App\Service
 */
final class ExpenseService
{
    /**
     * @var ExpenseRepositoryInterface
     */
    private $expenseRepository;

    /**
     * @var ExpenseAssembler
     */
    private $expenseAssembler;

    /**
     * ExpenseService constructor.
     * @param ExpenseRepositoryInterface $expenseRepository
     * @param ExpenseAssembler $expenseAssembler
     */
    public function __construct(ExpenseRepositoryInterface $expenseRepository, ExpenseAssembler $expenseAssembler)
    {
        $this->expenseRepository = $expenseRepository;
        $this->expenseAssembler = $expenseAssembler;
    }

    /**
     * @param int $expenseId
     * @return Expense|null
     * @throws EntityNotFoundException
     */
    public function getExpense(int $expenseId): ?Expense
    {
        $expense = $this->expenseRepository->find($expenseId);

        if (!$expense) {
            throw new EntityNotFoundException($this->defaultNotFoundMessage($expenseId));
        }

        return $expense;
    }

    /**
     * @return array|null
     */
    public function getAllExpense(): ?array
    {
        return $this->expenseRepository->findAll();
    }

    /**
     * @param ExpenseDTO $expenseDTO
     * @return Expense|null
     */
    public function addExpense(ExpenseDTO $expenseDTO): ?Expense
    {
        $expense = $this->expenseAssembler->createExpense($expenseDTO);
        $this->expenseRepository->save($expense);

        return $expense;
    }

    /**
     * @param int $expenseId
     * @param ExpenseDTO $expenseDTO
     * @param Expense $expense
     * @return Expense|null
     * @throws EntityNotFoundException
     */
    public function updateExpense(int $expenseId, ExpenseDTO $expenseDTO): ?Expense
    {
        $expense = $this->expenseRepository->find($expenseId);

        if (!$expense) {
            throw new EntityNotFoundException($this->defaultNotFoundMessage($expenseId));
        }

        $expense = $this->expenseAssembler->updateExpense($expense, $expenseDTO);

        $this->expenseRepository->save($expense);

        return $expense;
    }

    /**
     * @param int $expenseId
     * @throws EntityNotFoundException
     */
    public function deleteExpense(int $expenseId): void
    {
        $expense = $this->expenseRepository->find($expenseId);

        if (!$expense) {
            throw new EntityNotFoundException($this->defaultNotFoundMessage($expenseId));
        }

        $this->expenseRepository->delete($expense);
    }

    /**
     * @param int $resourceId
     * @return string
     */
    private function defaultNotFoundMessage(int $resourceId): string
    {
        return sprintf('Expense with id %s does not exist!', $resourceId);
    }
}