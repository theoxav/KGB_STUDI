<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Timestampable;
use App\Repository\CountryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity(fields:['name'])]
class Country
{
    use Timestampable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank()]
    private $name;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Hideout::class, cascade:['persist','remove'])]
    private $hideouts;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Mission::class, cascade:['remove'])]
    private $missions;

    public function __construct()
    {
        $this->hideouts = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Hideout[]
     */
    public function getHideouts(): Collection
    {
        return $this->hideouts;
    }

    public function addHideout(Hideout $hideout): self
    {
        if (!$this->hideouts->contains($hideout)) {
            $this->hideouts[] = $hideout;
            $hideout->setCountry($this);
        }

        return $this;
    }

    public function removeHideout(Hideout $hideout): self
    {
        if ($this->hideouts->removeElement($hideout)) {
            // set the owning side to null (unless already changed)
            if ($hideout->getCountry() === $this) {
                $hideout->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mission[]
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->setCountry($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getCountry() === $this) {
                $mission->setCountry(null);
            }
        }

        return $this;
    }
}
