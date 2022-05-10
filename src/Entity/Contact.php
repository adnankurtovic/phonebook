<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
#[
    ApiResource,
    ApiFilter(
        SearchFilter::class,
        properties: [
            'FirstName' => SearchFilter::STRATEGY_PARTIAL,
            'LastName' => SearchFilter::STRATEGY_PARTIAL
        ]
    )
]

class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /** The first name of the contact */
    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255)]
    private $FirstName;

    /** The last name of the contact */
    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255)]
    private $LastName;

    /** The address of the contact */
    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255)]
    private $Address;

    /** The phone number of the contact */
    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255)]
    private $PhoneNumber;

    /** The birthday of the contact */
    #[Assert\NotBlank]
    #[ORM\Column(type: 'date')]
    private $Birthday;

    /** The email address of the contact */
    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 255)]
    private $Email;

    /** The photo of the contact (optional) */
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Picture;

    /** A friends of the contact. Self referencing. ManyToMany relation */
    #[ORM\ManyToMany(targetEntity: self::class)]
    private $MyFriends;

    public function __construct()
    {
        $this->MyFriends = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber(string $PhoneNumber): self
    {
        $this->PhoneNumber = $PhoneNumber;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->Birthday;
    }

    public function setBirthday(\DateTimeInterface $Birthday): self
    {
        $this->Birthday = $Birthday;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->Picture;
    }

    public function setPicture(?string $Picture): self
    {
        $this->Picture = $Picture;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getMyFriends(): Collection
    {
        return $this->MyFriends;
    }

    public function addMyFriend(self $myFriend): self
    {
        if (!$this->MyFriends->contains($myFriend)) {
            $this->MyFriends[] = $myFriend;
        }

        return $this;
    }

    public function removeMyFriend(self $myFriend): self
    {
        $this->MyFriends->removeElement($myFriend);

        return $this;
    }
}
