<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LancamentoFinanceiroRepository")
 */
class LancamentoFinanceiro
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $descricao;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_categoria;

    /**
     * @ORM\Column(type="float")
     */
    private $custo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        if (strlen($titulo) < 5) {
            throw new \InvalidArgumentException('Title needs to have more than 5 characters');
        }

        $this->titulo = $titulo;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        if (strlen($descricao) < 5) {
            throw new \InvalidArgumentException('Description needs to have more than 5 characters');
        }

        $this->descricao = $descricao;

        return $this;
    }

    public function getIdCategoria(): ?int
    {
        return $this->id_categoria;
    }

    public function setIdCategoria(int $id_categoria): self
    {
        $this->id_categoria = $id_categoria;

        return $this;
    }

    public function getCusto(): ?float
    {
        return $this->custo;
    }

    public function setCusto(float $custo): self
    {
        if (!is_numeric($custo)) {
            throw new \InvalidArgumentException('Custo needs to be a numeric value');
        }

        $this->custo = $custo;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
