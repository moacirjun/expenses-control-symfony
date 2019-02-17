<?php

namespace App\Infrastructure\Http\Rest\Controller;

use App\Application\DTO\LancamentoFinanceiroDTO;
use App\Service\LancamentoFinanceiroService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class LancamentoFinanceiroController extends AbstractFOSRestController
{
    /**
     * @var LancamentoFinanceiroService
     */
    private $lancamentoFinanceiroService;

    public function __construct(LancamentoFinanceiroService $lancamentoFinanceiroService)
    {
        $this->lancamentoFinanceiroService = $lancamentoFinanceiroService;
    }

    /**
     * @Rest\Post("/lancamento-financeiro")
     *
     * @param LancamentoFinanceiroDTO $DTO
     * @return View
     *
     * @throws \Exception
     * @ParamConverter("DTO", class="App\Application\DTO\LancamentoFinanceiroDTO", converter="fos_rest.request_body")
     */
    public function postLancamento(LancamentoFinanceiroDTO $DTO)
    {
        $lancamentoFinanceiro = $this->lancamentoFinanceiroService->addLancamentoFinanceiro($DTO);

        return View::create($lancamentoFinanceiro, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Get("/lancamento-financeiro/{lancamentoId}")
     *
     * @param int $lancamentoId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function getLancamentoFinanceiro(int $lancamentoId) : View
    {
        $lancamentoFinanceiro = $this->lancamentoFinanceiroService->getLancamentoFinanceiro($lancamentoId);

        return View::create($lancamentoFinanceiro, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("/lancamento-financeiro")
     *
     * @return View
     */
    public function getLancamentosFinanceiros() : View
    {
        $lancamentosFinanceiros = $this->lancamentoFinanceiroService->getAllLancamentoFinanceiro();

        return View::create($lancamentosFinanceiros, Response::HTTP_OK);
    }

    /**
     * Edit a Lancamento Financeiro
     *
     * @Rest\Put("/lancamento-financeiro/{lancamentoFinanceiroId}")
     *
     * @param int $lancamentoFinanceiroId
     * @param LancamentoFinanceiroDTO $DTO
     * @ParamConverter("DTO", class="App\Application\DTO\LancamentoFinanceiroDTO", converter="fos_rest.request_body")
     *
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function putLancamentoFinanceiro(int $lancamentoFinanceiroId, LancamentoFinanceiroDTO $DTO) : View
    {
        $lancamentoFinanceiro = $this->lancamentoFinanceiroService->updateLancamentoFinanceiro(
            $lancamentoFinanceiroId,
            $DTO
        );

        return View::create($lancamentoFinanceiro, Response::HTTP_OK);
    }

    /**
     * Delete a lancamento Financeiro
     *
     * @Rest\Delete("/lancamento-financeiro/{lancamentoFinanceiroId}")
     *
     * @param int $lancamentoFinanceiroId
     * @return View
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function deleteLancamentoFinanceiro(int $lancamentoFinanceiroId) : View
    {
        $this->lancamentoFinanceiroService->deleteLancamentoFinanceiro($lancamentoFinanceiroId);

        return View::create([], Response::HTTP_NO_CONTENT);
    }
}