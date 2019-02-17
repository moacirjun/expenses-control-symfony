<?php

namespace App\Service;


use App\Entity\LancamentoFinanceiro;
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
     * LancamentoFinanceiroService constructor.
     * @param LancamentoFinanceiroRepositoryInterface $lancamentoFinanceiroRepository
     */
    public function __construct(LancamentoFinanceiroRepositoryInterface $lancamentoFinanceiroRepository)
    {
        $this->lancamentoFinanceiroRepository = $lancamentoFinanceiroRepository;
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
    public function addLancamentoFinanceiro($titulo, $descricao, $custo): ?LancamentoFinanceiro
    {
        $lancamentoFinanceiro = new LancamentoFinanceiro();
        $lancamentoFinanceiro->setTitulo($titulo);
        $lancamentoFinanceiro->setDescricao($descricao);
        $lancamentoFinanceiro->setCusto($custo);
        $lancamentoFinanceiro->setIdCategoria(1);
        $lancamentoFinanceiro->setCreatedAt(new \DateTime());

        $this->lancamentoFinanceiroRepository->save($lancamentoFinanceiro);

        return $lancamentoFinanceiro;
    }

    /**
     * @param int $lancamentoFinanceiroId
     * @param $titulo
     * @param $descricao
     * @param $custo
     * @return LancamentoFinanceiro|null
     * @throws EntityNotFoundException
     */
    public function updateLancamentoFinanceiro(
        int $lancamentoFinanceiroId,
        $titulo,
        $descricao,
        $custo
    ): ?LancamentoFinanceiro {

        $lancamentoFinanceiro = $this->lancamentoFinanceiroRepository->find($lancamentoFinanceiroId);

        if (!$lancamentoFinanceiro) {
            throw new EntityNotFoundException($this->defaultNotFoundMessage($lancamentoFinanceiroId));
        }

        $lancamentoFinanceiro->setTitulo($titulo);
        $lancamentoFinanceiro->setDescricao($descricao);
        $lancamentoFinanceiro->setCusto($custo);
        $lancamentoFinanceiro->setIdCategoria(1);
        $lancamentoFinanceiro->setCreatedAt(new \DateTime());

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