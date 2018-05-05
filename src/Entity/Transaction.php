<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Transaction
{
    use SoftDeleteableEntity;
    use TimestampableTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=16)
     * @Assert\NotBlank()
     */
    private $number;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $count;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     */
    private $value;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Auction", inversedBy="transactions")
     */
    private $auction;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="transactions")
     */
    private $client;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Message", orphanRemoval=true)
     */
    private $message;

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
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Transaction
     */
    public function setNumber(string $number): Transaction
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return Transaction
     */
    public function setCount(int $count): Transaction
    {
        $this->count = $count;

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
     * @return Transaction
     */
    public function setValue(float $value): Transaction
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return Transaction
     */
    public function setStatus(int $status): Transaction
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Auction
     */
    public function getAuction(): Auction
    {
        return $this->auction;
    }

    /**
     * @param Auction
     * @return Transaction
     */
    public function setAuction(Auction $auction): Transaction
    {
        $this->auction = $auction;

        return $this;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->collection;
    }

    /**
     * @param Client
     * @return Transaction
     */
    public function setClient(Client $client): Transaction
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }


}
