<?php

namespace App\Application\DTO;


class ExpenseDTO
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var double
     */
    private $value;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * ExpenseDTO constructor.
     *
     * @param string $title
     * @param string $description
     * @param float $value
     * @param \DateTime $createdAt
     * @param \DateTime $updatedAt
     */
    public function __construct(
        string $title,
        string $description,
        float $value,
        \DateTime $createdAt,
        \DateTime $updatedAt
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->value = $value;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string | null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return float | null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * @return \DateTime | null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime | null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }
}