<?php

namespace App\Application\DTO;


use App\Application\Model\LancamentoFinanceiro;

class LancamentoFinanceiroAssembler
{
    public function readDTO(
        LancamentoFinanceiroDTO $DTO,
        ?LancamentoFinanceiro $lancamentoFinanceiro = null
    ): LancamentoFinanceiro {

        if (!$lancamentoFinanceiro) {
            $lancamentoFinanceiro = new LancamentoFinanceiro();
        }

        $lancamentoFinanceiro->setTitulo($DTO->getTitle());
        $lancamentoFinanceiro->setDescricao($DTO->getDescription());
        $lancamentoFinanceiro->setCusto($DTO->getValue());
        $lancamentoFinanceiro->setIdCategoria(1);
        $lancamentoFinanceiro->setCreatedAt(new \DateTime);

        return $lancamentoFinanceiro;
    }

    public function updateLancamentoFinanceiro(
        LancamentoFinanceiro $lancamentoFinanceiro,
        LancamentoFinanceiroDTO $DTO
    ): LancamentoFinanceiro {
        return $this->readDTO($DTO, $lancamentoFinanceiro);
    }

    public function createLancamentoFinanceiro(LancamentoFinanceiroDTO $DTO): LancamentoFinanceiro
    {
        return $this->readDTO($DTO);
    }

    public function writeDTO(LancamentoFinanceiro $lancamentoFinanceiro): LancamentoFinanceiroDTO
    {
        return new LancamentoFinanceiroDTO(
            $lancamentoFinanceiro->getTitulo(),
            $lancamentoFinanceiro->getDescricao(),
            $lancamentoFinanceiro->getCusto(),
            $lancamentoFinanceiro->getIdCategoria()
        );
    }
}