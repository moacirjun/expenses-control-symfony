<?php

namespace App\Application\Model;

/**
 * Class LancamentoFinanceiro
 * @package App\Application\Model
 */
class LancamentoFinanceiro
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $titulo;

    /**
     * @var string
     */
    private $descricao;

    /**
     * @var integer
     */
    private $id_categoria;

    /**
     * @var float
     */
    private $custo;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    /**
     * @param string $titulo
     * @return LancamentoFinanceiro
     */
    public function setTitulo(string $titulo): self
    {
        if (strlen($titulo) < 5) {
            throw new \InvalidArgumentException('Title needs to have more than 5 characters');
        }

        $this->titulo = $titulo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * @param string|null $descricao
     * @return LancamentoFinanceiro
     */
    public function setDescricao(?string $descricao): self
    {
        if (strlen($descricao) < 5) {
            throw new \InvalidArgumentException('Description needs to have more than 5 characters');
        }

        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getIdCategoria(): ?int
    {
        return $this->id_categoria;
    }

    /**
     * @param int $id_categoria
     * @return LancamentoFinanceiro
     */
    public function setIdCategoria(int $id_categoria): self
    {
        $this->id_categoria = $id_categoria;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getCusto(): ?float
    {
        return $this->custo;
    }

    /**
     * @param float $custo
     * @return LancamentoFinanceiro
     */
    public function setCusto(float $custo): self
    {
        if (!is_numeric($custo)) {
            throw new \InvalidArgumentException('Custo needs to be a numeric value');
        }

        $this->custo = $custo;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * @param \DateTimeInterface $created_at
     * @return LancamentoFinanceiro
     */
    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
