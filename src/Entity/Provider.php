<?php

namespace App\Entity;

use App\Repository\ProviderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass=ProviderRepository::class)
 * @UniqueEntity("name")
 * @UniqueEntity("email")
 * @UniqueEntity("phone")
 */
class Provider
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Must have at least 3 characters.",
     *      maxMessage = "Must not have more than 255.",
     *      allowEmptyString = false
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Must not have more than 255.",
     *      allowEmptyString = false
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="integer", unique=true)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 9,
     *      max = 9,
     *      allowEmptyString = false
     * )
     */
    private $phone;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCreatedAt(): \Datetime {
        return $this->createdAt;
    }

    public function setCreatedAt(\Datetime $date): self {
        $this->createdAt = $date;

        return $this;
    }

    public function getUpdatedAt(): \Datetime {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\Datetime $date): self {
        $this->updatedAt = $date;

        return $this;
    }
}
