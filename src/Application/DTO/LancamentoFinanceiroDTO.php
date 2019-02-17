<?php

namespace App\Application\DTO;


class LancamentoFinanceiroDTO
{
    private $titulo;

    private $descricao;

    private $custo;

    private $idCategoria;

    /**
     * LancamentoFinanceiroDTO constructor.
     * @param string $titulo
     * @param string $descricao
     * @param float $custo
     * @param int $idCategoria
     */
    public function __construct(string $titulo, string  $descricao, float $custo, int $idCategoria)
    {
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->custo = $custo;
        $this->idCategoria = $idCategoria;
    }

    /**
     * @return string
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @return float
     */
    public function getCusto(): float
    {
        return $this->custo;
    }

    /**
     * @return int
     */
    public function getIdCategoria(): int
    {
        return $this->idCategoria;
    }
}