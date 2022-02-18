<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\MappedSuperclass()]
/**
 * @Vich\Uploadable
 */
class Person
{
    
    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message:"please enter a firstName")]
    #[Assert\Length(min:4, max:50)]
    protected $firstName;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message:"please enter a lastName")]
    #[Assert\Length(min:4, max:50)]
    protected $lastName;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank()]
    #[Assert\Type('date')]
    protected $birthday;
    
    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message:"please enter a nationality")]
    #[Assert\Length(min:4, max:50)]
    protected $nationality;

/**
     * @Vich\UploadableField(mapping="profil_image", fileNameProperty="ImageName")
     * @var File
     */
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    protected $imageName;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFullName()
    {
        return $this->firstName.' '.$this->lastName;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdatedAt(new \DateTimeImmutable());
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
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

  
}
