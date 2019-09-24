<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarmakersRepository")
 */
class Carmakers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\carsad", mappedBy="manufacturer")
     */
    private $maker;

    public function __construct()
    {
        $this->maker = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|carsad[]
     */
    public function getMaker(): Collection
    {
        return $this->maker;
    }

    public function addMaker(carsad $maker): self
    {
        if (!$this->maker->contains($maker)) {
            $this->maker[] = $maker;
            $maker->setManufacturer($this);
        }

        return $this;
    }

    public function removeMaker(carsad $maker): self
    {
        if ($this->maker->contains($maker)) {
            $this->maker->removeElement($maker);
            // set the owning side to null (unless already changed)
            if ($maker->getManufacturer() === $this) {
                $maker->setManufacturer(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
