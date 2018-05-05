<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection as BaseCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CollectionRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Collection
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
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Monitor", mappedBy="collection")
     */
    private $monitors;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Code", mappedBy="collection", cascade={"persist"})
     */
    private $codes;

    public function __construct()
    {
        $this->monitors = new ArrayCollection();
        $this->codes = new ArrayCollection();
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Collection
     */
    public function setName(string $name): Collection
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCodes(): ?BaseCollection
    {
        return $this->codes;
    }

    public function setCodes(BaseCollection $codes): Collection
    {
        $this->codes[] = $codes;

        return $this;
    }

    /**
     * @param Code $code
     * @return Collection
     */
    public function addCode(Code $code): Collection
    {
        $code->setCollection($this);

        $this->codes->add($code);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getMonitors(): ?BaseCollection
    {
        return $this->monitors;
    }

    public function getNameWithCodesCount()
    {
        return $this->getName(). ' (' . $this->getCodes()->count() . ')';
    }
}
