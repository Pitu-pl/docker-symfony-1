<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Message
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
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $body;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Code")
     * @ORM\JoinColumn(name="code_id", referencedColumnName="id")
     */
    private $code;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Transaction")
     * @ORM\JoinColumn(name="transaction_id", referencedColumnName="id")
     */
    private $transaction;

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
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Message
     */
    public function setValue(string $body): Message
    {
        $this->$body = $body;

        return $this;
    }

    /**
     * @return Code
     */
    public function getCode(): Code
    {
        return $this->code;
    }

    /**
     * @param Code
     * @return Message
     */
    public function setCode(Code $code): Message
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Transaction
     */
    public function getTransaction(): Transaction
    {
        return $this->transaction;
    }

    /**
     * @param Transaction
     * @return Message
     */
    public function setTransaction(Transaction $transaction): Message
    {
        $this->transaction = $transaction;

        return $this;
    }
}
