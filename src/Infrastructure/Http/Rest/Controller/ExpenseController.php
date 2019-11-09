<?php

namespace App\Infrastructure\Http\Rest\Controller;

use App\Application\DTO\ExpenseDTO;
use App\Service\ExpenseService;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class ExpenseController
 * @package App\Infrastructure\Http\Rest\Controller
 */
class ExpenseController
{
    /**
     * @var ExpenseService
     */
    private $expenseService;

    /**
     * ExpenseController constructor.
     * @param ExpenseService $expenseService
     */
    public function __construct(ExpenseService $expenseService)
    {
        $this->expenseService = $expenseService;
    }

    /**
     * @Rest\Post("/expense")
     *
     * @param ExpenseDTO $expenseDTO
     * @return View
     *
     * @ParamConverter("expenseDTO", class="App\Application\DTO\ExpenseDTO", converter="fos_rest.request_body")
     */
    public function postExpense(ExpenseDTO $expenseDTO): View
    {
        $expense = $this->expenseService->addExpense($expenseDTO);

        return View::create($expense, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Get("/expense/{expenseId}")
     *
     * @param int $expenseId
     * @return View
     * @throws EntityNotFoundException
     */
    public function getOneExpense(int $expenseId): View
    {
        $expense = $this->expenseService->getExpense($expenseId);

        return View::create($expense, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/expense")
     *
     * @return View
     */
    public function getAllExpense(): View
    {
        $expenses = $this->expenseService->getAllExpense();

        return View::create($expenses, Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/expense/{expenseId}")
     *
     * @param int $expenseId
     * @param ExpenseDTO $expenseDTO
     * @return View
     *
     * @ParamConverter("expenseDTO", class="App\Application\DTO\ExpenseDTO", converter="fos_rest.request_body")
     *
     * @throws EntityNotFoundException
     */
    public function putExpense(int $expenseId, ExpenseDTO $expenseDTO): View
    {
        $expense = $this->expenseService->updateExpense($expenseId, $expenseDTO);

        return View::create($expense, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/expense/{expenseId}")
     *
     * @param int $expenseId
     * @return View
     * @throws EntityNotFoundException
     */
    public function deleteExpense(int $expenseId): View
    {
        $this->expenseService->deleteExpense($expenseId);

        return View::create([], Response::HTTP_NO_CONTENT);
    }
}