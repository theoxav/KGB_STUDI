<?php

namespace App\Entity;

use App\Entity\Target;
use App\Entity\Hideout;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MissionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: MissionRepository::class)]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank()]
    private $title;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank()]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank()]
    private $codeName;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: false)]
    private $country;

    #[ORM\ManyToOne(targetEntity: Skill::class, inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: false)]
    private $skills;

    #[ORM\ManyToOne(targetEntity: Hideout::class, inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: false)]
    private $hideout;

    #[ORM\Column(type: 'date')]
    private $startDate;

    #[ORM\Column(type: 'date')]
    private $endDate;

    #[ORM\ManyToMany(targetEntity: Agent::class, inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable:false, onDelete:'cascade')]
    private $agents;

    #[ORM\ManyToMany(targetEntity: Contact::class, inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: false, onDelete:'cascade')]
    private $contacts;

    #[ORM\ManyToMany(targetEntity: Target::class, inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: false, onDelete:'cascade')]
    private $targets;

    #[ORM\ManyToOne(targetEntity: MissionGender::class, inversedBy: 'missions')]
    #[ORM\JoinColumn(nullable: false)]
    private $missionGender;

    public function __construct()
    {
        $this->agents = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->targets = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCodeName(): ?string
    {
        return $this->codeName;
    }

    public function setCodeName(string $codeName): self
    {
        $this->codeName = $codeName;

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

    public function getSkills(): ?Skill
    {
        return $this->skills;
    }

    public function setSkills(?Skill $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getHideout(): ?Hideout
    {
        return $this->hideout;
    }

    public function setHideout(?Hideout $hideout): self
    {
        $this->hideout = $hideout;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgents(): Collection
    {
        return $this->agents;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        $this->agents->removeElement($agent);

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        $this->contacts->removeElement($contact);

        return $this;
    }

    /**
     * @return Collection|Target[]
     */
    public function getTargets(): Collection
    {
        return $this->targets;
    }

    public function addTarget(Target $target): self
    {
        if (!$this->targets->contains($target)) {
            $this->targets[] = $target;
        }

        return $this;
    }

    public function removeTarget(Target $target): self
    {
        $this->targets->removeElement($target);

        return $this;
    }

    public function getMissionGender(): ?MissionGender
    {
        return $this->missionGender;
    }

    public function setMissionGender(?MissionGender $missionGender): self
    {
        $this->missionGender = $missionGender;

        return $this;
    }
}
