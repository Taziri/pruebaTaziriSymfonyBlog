<?php

namespace App\Entity;

use App\Models\Address;
use App\Models\Company;
use Symfony\Component\Validator\Constraints as Assert;

class Author
{
    protected ?int $id = null;

    #[Assert\NotNull]
    #[Assert\Length(min: 2, max: 50)]
    private ?string $name = '';

    #[Assert\NotNull]
    #[Assert\Length(min: 2, max: 50)]
    private ?string $username = '';

    #[Assert\NotNull]
    #[Assert\Length(min: 2, max: 50)]
    private ?string $email = '';

    #[Assert\NotNull]
    private ?string $phone = '';

    #[Assert\NotNull]
    private ?string $website = '';

    private ?Address $address;

    private ?Company $company;

    public function __constructor(): void
    {
        $this->address = new Address();
        $this->company = new Company();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): ?self
    {
        $this->id = $id;

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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): void
    {
        $this->website = $website;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): void
    {
        $this->address = $address;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): void
    {
        $this->company = $company;
    }
}
