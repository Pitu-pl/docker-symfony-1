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
 * @ORM\Entity(repositoryClass="App\Repository\AuctionRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Auction
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
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Monitor")
     */
    private $monitor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="auction")
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
     * @return Auction
     */
    public function setNumber(string $number): Auction
    {
        $this->number = $number;

        return $this;
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
     * @return Auction
     */
    public function setTitle(string $title): Auction
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Monitor
     */
    public function getMonitor(): ?Monitor
    {
        return $this->monitor;
    }

    /**
     * @return ArrayCollection
     */
    public function getTransactions(): ?ArrayCollection
    {
        return $this->transactions;
    }
}
