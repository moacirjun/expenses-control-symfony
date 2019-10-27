<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

/** 
 * @ORM\Entity
 * @ORM\Table(name="tb_expenses")
 */
class Expense
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="expense_id_seq", initialValue=1, allocationSize=1)
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(length=120)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(length=120, nullable=TRUE)
     */
    private $description;

    /**
     * @var float
     * @ORM\Column(type="decimal", precision=11, scale=2)
     */
    private $value;

    /**
     * Category
     * @var Category
     * @ManytoOne(targetEntity="Category")
     */
    private $category;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Expense
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Expense
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return Expense
     */
    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Expense
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Expense
     */
    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * get Expense's category
     *
     * @return Category|null
     */
    public function getCategory() : ?Category
    {
        return $this->category;
    }

    /**
     * set Expense's category
     *
     * @param Category $category
     * @return self
     */
    public function setCategory(Category $category) : self
    {
        $this->category = $category;
        return $this;
    }
}