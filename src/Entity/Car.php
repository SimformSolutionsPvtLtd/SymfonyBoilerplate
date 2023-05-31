<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    use TimestampableEntity;

    const carTypeChoices = [
        'car-type-one' => 'HATCHBACK',
        'car-type-two' => 'SEDAN',
        'car-type-three' => 'SUV',
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message: 'Name should not be blank'
    )]
    private ?string $name = null;

    #[ORM\Column(length: 12)]
    #[Assert\NotBlank(
        message: 'Color should not be blank'
    )]
    private ?string $color = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(
        message: 'Please select car type'
    )]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(
        message: 'Chasis number should not be blank'
    )]
    private ?string $chasisNumber = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\ManyToOne]
    #[Assert\NotBlank(
        message: 'Please select manufacurer'
    )]
    private ?Manufacturer $manufacturer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: CarOwner::class, cascade:["persist"])]
    private Collection $owner;

    public function __construct()
    {
        $this->owner = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getChasisNumber(): ?string
    {
        return $this->chasisNumber;
    }

    public function setChasisNumber(?string $chasisNumber): self
    {
        $this->chasisNumber = $chasisNumber;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Manufacturer $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return Collection<int, CarOwner>
     */
    public function getOwner(): Collection
    {
        return $this->owner;
    }

    public function addOwner(CarOwner $owner): self
    {
        if (!$this->owner->contains($owner)) {
            $this->owner->add($owner);
            $owner->setCar($this);
        }

        return $this;
    }

    public function removeOwner(CarOwner $owner): self
    {
        if ($this->owner->removeElement($owner)) {
            // set the owning side to null (unless already changed)
            if ($owner->getCar() === $this) {
                $owner->setCar(null);
            }
        }

        return $this;
    }
}
