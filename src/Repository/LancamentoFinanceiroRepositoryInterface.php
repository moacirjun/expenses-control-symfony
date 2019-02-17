<?php

namespace App\Repository;


use App\Application\Model\LancamentoFinanceiro;
/**
 * Interface LancamentoFinanceiroRepositoryInterface
 * @package App\Repository
 *
 * @method LancamentoFinanceiro|null find($id, $lockMode = null, $lockVersion = null)
 * @method LancamentoFinanceiro|null findOneBy(array $criteria, array $orderBy = null)
 * @method LancamentoFinanceiro[]    findAll()
 * @method LancamentoFinanceiro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface LancamentoFinanceiroRepositoryInterface
{
    /**
     * @param LancamentoFinanceiro $lancamentoFinanceiro
     */
    public function save(LancamentoFinanceiro $lancamentoFinanceiro): void;

    /**
     * @param LancamentoFinanceiro $lancamentoFinanceiro
     */
    public function delete(LancamentoFinanceiro $lancamentoFinanceiro): void;
}