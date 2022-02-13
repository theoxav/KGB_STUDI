<?php

namespace App\Entity;

use App\Entity\Traits\Timestampable;
use App\Repository\HideoutRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HideoutRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Hideout
{
    use Timestampable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $code;

    #[ORM\Column(type: 'string', length: 255)]
    private $address;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'hideouts', cascade:['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private $country;

    #[ORM\ManyToOne(targetEntity: HideoutType::class, inversedBy: 'hideouts', cascade:['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getType(): ?HideoutType
    {
        return $this->type;
    }

    public function setType(?HideoutType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
