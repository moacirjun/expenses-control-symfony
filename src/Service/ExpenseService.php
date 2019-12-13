<?php

namespace App\Service;


use App\Application\DTO\ExpenseAssembler;
use App\Application\DTO\ExpenseDTO;
use App\Entity\Expense;
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
    public function getAllExpense(array $params)
    {
        $startDate = isset($params['start_date']) ? new \DateTime($params['start_date']) : null;
        $endDate = isset($params['end_date']) ? new \DateTime($params['end_date']) : null;
        $offset = isset($params['offset']) && is_numeric($params['offset']) ? $params['offset'] : 0;
        $limit = isset($params['limit']) && is_numeric($params['limit']) ? $params['limit'] : 15;

        return $this->expenseRepository->getRecents($startDate, $endDate, $offset, $limit);
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