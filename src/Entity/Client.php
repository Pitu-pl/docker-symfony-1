<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Client
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
     * @ORM\Column(type="string", length=32)
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=32)
     * @Assert\NotBlank()
     */
    private $surName;

    /**
     * @ORM\Column(type="string", length=32)
     * @Assert\NotBlank()
     */
    private $nickName;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\Email(checkMX = true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="client")
     */
    private $transactions;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

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
     * @return Client
     */
    public function setNumber(string $number): Client
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Client
     */
    public function setFirstName(string $firstName): Client
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getSurName(): string
    {
        return $this->surName;
    }

    /**
     * @param string $surName
     * @return Client
     */
    public function setSurName(string $surName): Client
    {
        $this->surName = $surName;

        return $this;
    }

    /**
     * @return string
     */
    public function getNickName(): string
    {
        return $this->nickName;
    }

    /**
     * @param string $nickName
     * @return Client
     */
    public function setNickName(string $nickName): Client
    {
        $this->nickName = $nickName;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Client
     */
    public function setEmail(string $email): Client
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTransactions(): ?ArrayCollection
    {
        return $this->transactions;
    }
}
