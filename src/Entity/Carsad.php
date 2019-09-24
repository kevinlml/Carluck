<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarsadRepository")
 */
class Carsad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Carmakers", inversedBy="maker")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manufacturer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Carmodels", inversedBy="models")
     * @ORM\JoinColumn(nullable=false)
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Carcategory", inversedBy="category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="integer")
     */
    private $engine;

    /**
     * @ORM\Column(type="decimal")
     */
    private $kilometres;

    /**
     * @ORM\Column(type="integer")
     */
    private $cylender;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $transmission;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $drivertrain;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $outcolour;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $incolour;

    /**
     * @ORM\Column(type="integer")
     */
    private $passengers;

    /**
     * @ORM\Column(type="integer")
     */
    private $doors;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $fueltype;

    /**
     * @ORM\Column(type="integer")
     */
    private $fueltank;

    /**
     * @ORM\Column(type="decimal")
     */
    private $price;

    /**
     * @ORM\Column(type="decimal")
     */
    private $oldprice;
    /**
     * @ORM\Column(type="text", length=2000)
     */
    private $features;
    /**
     * @ORM\Column(type="text", length=2000)
     */
    private $otherparams;
    /**
     * @ORM\Column(type="text", length=2000)
     */
    private $safety;
    /**
     * @ORM\Column(type="text", length=1000)
     */
    private $comfort;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text",)
     */
    private $description;

    /**
     *@ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Image", mappedBy="name")
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getManufacturer(): ?Carmakers
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Carmakers $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getModel(): ?Carmodels
    {
        return $this->model;
    }

    public function setModel(?Carmodels $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getCategory(): ?Carcategory
    {
        return $this->category;
    }

    public function setCategory(?Carcategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEngine(): ?int
    {
        return $this->engine;
    }

    public function setEngine(int $engine): self
    {
        $this->engine = $engine;

        return $this;
    }

    public function getKilometres()
    {
        return $this->kilometres;
    }

    public function setKilometres($kilometres): self
    {
        $this->kilometres = $kilometres;

        return $this;
    }

    public function getCylender(): ?int
    {
        return $this->cylender;
    }

    public function setCylender(int $cylender): self
    {
        $this->cylender = $cylender;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): self
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getDrivertrain(): ?string
    {
        return $this->drivertrain;
    }

    public function setDrivertrain(string $drivertrain): self
    {
        $this->drivertrain = $drivertrain;

        return $this;
    }

    public function getOutcolour(): ?string
    {
        return $this->outcolour;
    }

    public function setOutcolour(string $outcolour): self
    {
        $this->outcolour = $outcolour;

        return $this;
    }

    public function getIncolour(): ?string
    {
        return $this->incolour;
    }

    public function setIncolour(string $incolour): self
    {
        $this->incolour = $incolour;

        return $this;
    }

    public function getPassengers(): ?int
    {
        return $this->passengers;
    }

    public function setPassengers(int $passengers): self
    {
        $this->passengers = $passengers;

        return $this;
    }

    public function getDoors(): ?int
    {
        return $this->doors;
    }

    public function setDoors(int $doors): self
    {
        $this->doors = $doors;

        return $this;
    }

    public function getFueltype(): ?string
    {
        return $this->fueltype;
    }

    public function setFueltype(string $fueltype): self
    {
        $this->fueltype = $fueltype;

        return $this;
    }

    public function getFueltank()
    {
        return $this->fueltank;
    }

    public function setFueltank($fueltank): self
    {
        $this->fueltank = $fueltank;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getOldprice()
    {
        return $this->oldprice;
    }

    public function setOldprice($oldprice): self
    {
        $this->oldprice = $oldprice;

        return $this;
    }

    public function getFeatures(): ?string
    {
        return $this->features;
    }

    public function setFeatures(string $features): self
    {
        $this->features = $features;

        return $this;
    }

    public function getOtherparams(): ?string
    {
        return $this->otherparams;
    }

    public function setOtherparams(string $otherparams): self
    {
        $this->otherparams = $otherparams;

        return $this;
    }

    public function getSafety(): ?string
    {
        return $this->safety;
    }

    public function setSafety(string $safety): self
    {
        $this->safety = $safety;

        return $this;
    }

    public function getComfort(): ?string
    {
        return $this->comfort;
    }

    public function setComfort(string $comfort): self
    {
        $this->comfort = $comfort;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setimages(?Image $images): self
    {
        $this->categoryid = $images;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->addName($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            $image->removeName($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

}
