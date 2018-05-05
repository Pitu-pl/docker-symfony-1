<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MonitorRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Monitor
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
     * @ORM\Column(type="string", length=256)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $emailTitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $emailBody;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Collection", inversedBy="monitors")
     */
    private $collection;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Auction")
     * @ORM\JoinColumn(name="auction_id", referencedColumnName="id")
     */
    private $auction;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Monitor
     */
    public function setName(string $name): Monitor
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmailTitle(): ?string
    {
        return $this->emailTitle;
    }

    /**
     * @param string $emailTitle
     * @return Monitor
     */
    public function setEmailTitle(string $emailTitle): Monitor
    {
        $this->emailTitle = $emailTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmailBody(): ?string
    {
        return $this->emailBody;
    }

    /**
     * @param string $emailBody
     * @return Monitor
     */
    public function setEmailBody(string $emailBody): Monitor
    {
        $this->emailBody = $emailBody;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCollection(): ?Collection
    {
        return $this->collection;
    }

    /**
     * @param Collection
     * @return Monitor
     */
    public function setCollection(Collection $collection): Monitor
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * @return Auction
     */
    public function getAuction(): ?Auction
    {
        return $this->auction;
    }

    /**
     * @param Auction $auction
     * @return Monitor
     */
    public function setAuction(Auction $auction): Monitor
    {
        $this->auction = $auction;

        return $this;
    }


}
