<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Carsad", inversedBy="images")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameimage;

    public function __construct()
    {
        $this->name = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Carsad[]
     */
    public function getName(): Collection
    {
        return $this->name;
    }

    public function addName(Carsad $name): self
    {
        if (!$this->name->contains($name)) {
            $this->name[] = $name;
        }

        return $this;
    }

    public function removeName(Carsad $name): self
    {
        if ($this->name->contains($name)) {
            $this->name->removeElement($name);
        }

        return $this;
    }

    public function getNameimage(): ?string
    {
        return $this->nameimage;
    }

    public function setNameimage(string $nameimage): self
    {
        $this->nameimage = $nameimage;

        return $this;
    }

}
