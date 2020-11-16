<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 */
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_from;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_to;

    /**
     * @ORM\Column(type="integer")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getUserFrom(): ?int
    {
        return $this->user_from;
    }

    public function setUserFrom(int $user_from): self
    {
        $this->user_from = $user_from;

        return $this;
    }

    public function getUserTo(): ?int
    {
        return $this->user_to;
    }

    public function setUserTo(int $user_to): self
    {
        $this->user_to = $user_to;

        return $this;
    }

    public function getDate(): ?int
    {
        return $this->date;
    }

    public function setDate(int $date): self
    {
        $this->date = $date;

        return $this;
    }
}
