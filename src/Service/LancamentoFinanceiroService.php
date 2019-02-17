<?php

namespace App\Service;


use App\Application\DTO\LancamentoFinanceiroAssembler;
use App\Application\DTO\LancamentoFinanceiroDTO;
use App\Application\Model\LancamentoFinanceiro;
use App\Repository\LancamentoFinanceiroRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class LancamentoFinanceiroService
 * @package App\Service
 */
final class LancamentoFinanceiroService
{
    /**
     * @var LancamentoFinanceiroRepositoryInterface
     */
    private $lancamentoFinanceiroRepository;


    /**
     * @var LancamentoFinanceiroAssembler
     */
    private $lancamentoFinanceiroAssembler;

    /**
     * LancamentoFinanceiroService constructor.
     * @param LancamentoFinanceiroRepositoryInterface $lancamentoFinanceiroRepository
     */
    public function __construct(
        LancamentoFinanceiroRepositoryInterface $lancamentoFinanceiroRepository,
        LancamentoFinanceiroAssembler $lancamentoFinanceiroAssembler
    ) {
        $this->lancamentoFinanceiroRepository = $lancamentoFinanceiroRepository;
        $this->lancamentoFinanceiroAssembler = $lancamentoFinanceiroAssembler;
    }

    /**
     * @param int $lancamentoFinanceiroId
     * @return LancamentoFinanceiro|null
     * @throws EntityNotFoundException
     */
    public function getLancamentoFinanceiro(int $lancamentoFinanceiroId): ?LancamentoFinanceiro
    {
        $lancamentoFinanceiro = $this->lancamentoFinanceiroRepository->find($lancamentoFinanceiroId);

        if (!$lancamentoFinanceiro) {
            throw new EntityNotFoundException($this->defaultNotFoundMessage($lancamentoFinanceiroId));
        }

        return $lancamentoFinanceiro;
    }

    /**
     * @return array|null
     */
    public function getAllLancamentoFinanceiro(): ?array
    {
        return $this->lancamentoFinanceiroRepository->findAll();
    }

    /**
     * @param $titulo
     * @param $descricao
     * @param $custo
     * @return LancamentoFinanceiro|null
     * @throws \Exception
     */
    public function addLancamentoFinanceiro(LancamentoFinanceiroDTO $DTO): ?LancamentoFinanceiro
    {
        $lancamentoFinanceiro = $this->lancamentoFinanceiroAssembler->createLancamentoFinanceiro($DTO);

        $this->lancamentoFinanceiroRepository->save($lancamentoFinanceiro);

        return $lancamentoFinanceiro;
    }

    /**
     * @param int $lancamentoFinanceiroId
     * @param LancamentoFinanceiroDTO $DTO
     *
     * @return LancamentoFinanceiro|null
     *
     * @throws EntityNotFoundException
     */
    public function updateLancamentoFinanceiro(
        int $lancamentoFinanceiroId,
        LancamentoFinanceiroDTO $DTO
    ): ?LancamentoFinanceiro {

        $lancamentoFinanceiro = $this->lancamentoFinanceiroRepository->find($lancamentoFinanceiroId);

        if (!$lancamentoFinanceiro) {
            throw new EntityNotFoundException($this->defaultNotFoundMessage($lancamentoFinanceiroId));
        }

        $lancamentoFinanceiro = $this
            ->lancamentoFinanceiroAssembler
            ->updateLancamentoFinanceiro($lancamentoFinanceiro, $DTO);

        $this->lancamentoFinanceiroRepository->save($lancamentoFinanceiro);

        return $lancamentoFinanceiro;
    }

    /**
     * @param int $lancamentoFinanceiroId
     * @throws EntityNotFoundException
     */
    public function deleteLancamentoFinanceiro(int $lancamentoFinanceiroId): void
    {
        $lancamentoFinanceiro = $this->lancamentoFinanceiroRepository->find($lancamentoFinanceiroId);

        if (!$lancamentoFinanceiro) {
            throw new EntityNotFoundException($this->defaultNotFoundMessage($lancamentoFinanceiroId));
        }

        $this->lancamentoFinanceiroRepository->delete($lancamentoFinanceiro);
    }

    /**
     * @param int $resourceId
     * @return string
     */
    private function defaultNotFoundMessage(int $resourceId)
    {
        return sprintf('Lançamento Financeiro with id %s does not exist!', $resourceId);
    }
}